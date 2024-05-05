<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;

class riwayatController extends Controller
{
    
    public function index(){
        $riwayatTerbaru = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("stok_barangs.harga_beli * riwayat.jumlah as total_harga")
        ])
        ->join('stok_barangs', 'stok_barangs.id', '=', 'riwayat.id_barang')
        ->orderBy('riwayat.created_at', 'desc')
        ->take(5)
        ->get();
    
        return view("dashboard", ['riwayatTerbaru' => $riwayatTerbaru]);
    }
}
