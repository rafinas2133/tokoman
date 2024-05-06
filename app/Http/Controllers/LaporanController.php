<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\Laporan;

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
        // Validasi input jika diperlukan

        // Simpan data yang diterima dari formulir ke dalam database
        // $laporan = new Laporan();
        // $laporan->nama_barang = $request->itemName1; // Ganti itemName1 dengan nama input yang sesuai
        // $laporan->tanggal_laporan = $request->reportDate1; // Ganti reportDate1 dengan nama input yang sesuai
        // $laporan->harga_barang = $request->itemPrice1; // Ganti itemPrice1 dengan nama input yang sesuai
        // $laporan->jumlah_barang = $request->itemQuantity1; // Ganti itemQuantity1 dengan nama input yang sesuai
        // $laporan->total = $request->itemPrice1 * $request->itemQuantity1; // Hitung total
        // $laporan->id_barang = $request->itemName1; // Ganti itemName1 dengan nama input yang sesuai
        // $laporan->save(); // Simpan ke database

        // Jika Anda memiliki multiple lines, Anda bisa menggunakan loop untuk menyimpan data dari setiap line
        // Contohnya:
        
        for ($i = 1; $i <= $request->line; $i++) {

            $namabarang = StokBarang::where('id_barang', ${"itemName".$i})->first();
            $laporan = new Laporan();
            $laporan->nama_barang = $request->{$namabarang};
            $laporan->tanggal_laporan = $request->{"reportDate".$i};
            $laporan->harga_barang = $request->{"itemPrice".$i};
            $laporan->jumlah_barang = $request->{"itemQuantity".$i};
            $laporan->total = $request->{"itemPrice".$i} * $request->{"itemQuantity".$i};
            $laporan->id_barang = $request->{"itemName".$i};
            $laporan->save();
        }
        

        // Redirect atau lakukan tindakan lain setelah menyimpan data

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

}
