<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang; // Model untuk jenis barang

class SearchStok extends Controller
{
    public function index(Request $request)
    {
        $roleId = $request->session()->get('role_id');
        $query = $request->input('search');

        $barangs = StokBarang::query();

        if (!empty($query)) {
            $barangs->where('nama_barang', 'like', '%' . $query . '%');
        }

        $barangs = $barangs->paginate(9);
        if ($roleId=='0') {
            return view('stok.index', compact('barangs'));
        }
        return view('dashboard', compact('barangs'));
    }
}