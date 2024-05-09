<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\Laporan;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function index()
    {
        //nak kene lek pengen modif2 ge ngirim data nak view
        //show option
        $options = StokBarang::orderBy("nama_barang","asc")->get();
        $options2 = StokBarang::orderBy("nama_barang","asc")->get();

        return view("pelaporan", compact('options', 'options2'));
    }
    public function laporanPost(Request $request)
    {
        $data = [];

        for ($i = 1; $i <= $request->line; $i++) {
            $data[] = [
                'reportDate' => $request->input('reportDate' . $i),
                'itemName' => $request->input('itemName' . $i),
                'itemQuantity' => $request->input('itemQuantity' . $i)
            ];

            $validator = Validator::make($data[$i - 1], [
                // 'reportDate' => 'required|date|before_or_equal:' . Carbon::now()->toDateString() . '|after_or_equal:' . Carbon::now()->subWeek()->toDateString(),
                'itemName' => 'required|integer',
                'itemQuantity' => 'required|integer',
            ], [
                'required' => 'Data tidak boleh kosong',
                'integer' => 'Data harus angka',
                'before_or_equal' => 'Tanggal harus seminggu - tanggal sekarang',
                'after_or_equal' => 'Tanggal harus seminggu - tanggal sekarang',
            ]);

            if ($validator->fails()) {
                return redirect('/pelaporan')->with('messages', $validator->errors()->first())->with('error', 'true');
            }
        }

        // Jika semua data valid, lanjutkan ke penyimpanan
        foreach ($data as $item) {
            $namabarang = StokBarang::where('id', $item['itemName'])->first();

            $laporan = new Laporan();
            $laporan->nama_barang = $namabarang->nama_barang;
            $laporan->tanggal_laporan = now();
            $laporan->harga_barang = $namabarang->harga_jual;
            $laporan->jumlah_barang = abs($item['itemQuantity']);
            $laporan->total = intval($namabarang->harga_jual) * intval($item['itemQuantity']);
            $laporan->id_barang = $item['itemName'];
            $laporan->save();

            $riwayat = new Riwayat();
            $riwayat->nama_barang = $namabarang->nama_barang;
            $riwayat->jenis_riwayat = 'keluar';
            $riwayat->jumlah = abs($item['itemQuantity']);
            $riwayat->tanggal = now();
            $riwayat->id_barang = $item['itemName'];
            $riwayat->save();

            $namabarang->stok -= abs($item['itemQuantity']);
            $namabarang->save();
        }

        return redirect('/pelaporan')->with('messages', 'Data berhasil disimpan')->with('error', 'false');
    }


}
