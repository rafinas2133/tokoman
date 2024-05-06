<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\Laporan;
use App\Models\Riwayat;

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
    
            // Ambil data barang berdasarkan id_barang
            $namabarang = StokBarang::where('id', $request->{"itemName".$i})->first();
    
            // Buat instance model Laporan
            $laporan = new Laporan();
            $laporan->nama_barang = $namabarang->nama_barang;
            $laporan->tanggal_laporan = $request->{"reportDate".$i};
            $laporan->harga_barang = $request->{"itemPrice".$i};
            $laporan->jumlah_barang = abs($request->{"itemQuantity".$i});
            $laporan->total = intval($request->{"itemPrice".$i}) * intval($request->{"itemQuantity".$i});
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
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
    

}
