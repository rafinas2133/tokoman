<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\StokBarang; // Model untuk jenis barang

class SearchStok extends Controller
{
    public function index(Request $request)
    {
        Auth::attempt(['email' => 'admin1@admin.admin', 'password' => '12345678']);

        $query = $request->input('search');
        $type = $request->input('type');

        $barangs = StokBarang::query();

        if (!empty($query)) {
            $barangs->where('nama_barang', 'like', '%' . $query . '%');
        }
        if (!empty($type)) {
            $barangs->where('jenis_tutup', $type);
        }
        $barangs = $barangs->paginate(9)->appends(['search' => $query, 'type' => $type]);
        
        return view('stok.index', compact('barangs'));
        
        
    }
}