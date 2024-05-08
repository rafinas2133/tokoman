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
    public function index(){
        //nak kene lek pengen modif2 ge ngirim data nak view
        //show option
        $options = StokBarang::all();
        $options2 = StokBarang::all();

        return view("pelaporan", compact('options', 'options2'));
    }
    public function laporanPost(Request $request){

        for ($i = 1; $i <= $request->line; $i++) {
            $validator = Validator::make($request->all(), [
                'reportDate'.$i => 'required|date|before_or_equal:' . Carbon::now()->toDateString().
                '|after_or_equal:' . Carbon::now()->subWeek()->toDateString(),
                'itemName'.$i => 'required|integer',
                'itemQuantity'.$i => 'required|integer',
            ],
            [
                'required' => 'Data tidak boleh kosong',
                'integer' => 'Data harus angka',
                'before_or_equal' => 'Tanggal harus seminggu - tanggal sekarang',
                'after_or_equal' => 'Tanggal harus seminggu - tanggal sekarang',
            ]);
            
            if ($validator->fails()) {
                return redirect('/pelaporan')->with('messages', $validator->errors()->first())->with('error', 'true');
            }
            // Ambil data barang berdasarkan id_barang
            $namabarang = StokBarang::where('id', $request->{"itemName".$i})->first();
    
            // Buat instance model Laporan
            $laporan = new Laporan();
            $laporan->nama_barang = $namabarang->nama_barang;
            $laporan->tanggal_laporan = $request->{"reportDate".$i};
            $laporan->harga_barang = $namabarang->harga_jual;
            $laporan->jumlah_barang = abs($request->{"itemQuantity".$i});
            $laporan->total = intval($namabarang->harga_jual) * intval($request->{"itemQuantity".$i});
            $laporan->id_barang = $request->{"itemName".$i};
            $laporan->save();

            $riwayat=new Riwayat();
            $riwayat->nama_barang = $namabarang->nama_barang;
            $riwayat->jenis_riwayat='keluar';
            $riwayat->jumlah=abs($request->{"itemQuantity".$i});
            $riwayat->tanggal=now();
            $riwayat->id_barang=$request->{"itemName".$i};
            $riwayat->save();

            $namabarang->stok-=abs($request->{"itemQuantity".$i});
            $namabarang->save();
        }
        
        // Redirect atau lakukan tindakan lain setelah menyimpan data
        return redirect('/pelaporan')->with('messages', 'Data berhasil disimpan')->with('error', 'false');
    }
    

}
