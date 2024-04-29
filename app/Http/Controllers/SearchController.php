<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang; // Model untuk jenis barang

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $stock = $request->input('stock');
        $type = $request->input('type');

        $barangs = StokBarang::query();

        if (!empty($query)) {
            $barangs->where('nama_barang', 'like', '%' . $query . '%');
        }

        if ($stock === 'high') {
            $barangs->where('stok', '>', 20);
        }

        if (!empty($type)) {
            $barangs->where('jenis_barang', $type);
        }

        $barangs = $barangs->paginate(9);

        // Ambil 3 jenis barang acak yang berbeda
        $types = StokBarang::select('jenis_barang')->distinct()->inRandomOrder()->take(3)->get();

        return view('welcome', compact('barangs', 'types'));
    }
}