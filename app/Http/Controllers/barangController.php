<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\StokBarang;

class barangController extends Controller
{
    public function index(){
        $types = StokBarang::select('jenis_barang')->distinct()->inRandomOrder()->take(3)->get();
        $barang = StokBarang::paginate(9);
        return view("welcome", ["barangs" => $barang],compact('types'));
    }
    public function employeeIndex(){
        $barang = StokBarang::paginate(9);
        return view("stok.index", ["barang" => $barang]);
    }

    public function add(){
        return view("stok.add");
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'nama' => 'required',
            'stok' => 'required|integer',
            'desc' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect('/stok')->withErrors($validator)->withInput();
        }

        $barang = new StokBarang();
        $barang->jenis_barang = $request->jenis;
        $barang->nama_barang = $request->nama;
        $barang->stok = $request->stok;
        $barang->deskripsi = $request->desc;
        $barang->save();

        return redirect('/stok')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id) {
        $barang = StokBarang::find($id);
        return view("stok.edit", ["brg" => $barang]);
    }

    public function editSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'nama' => 'required',
            'stok' => 'required|integer',
            'desc' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect('/stok/edit/'.$id)->withErrors($validator)->withInput();
        }

        $barang = StokBarang::find($id);
        $barang->jenis_barang = $request->jenis;
        $barang->nama_barang = $request->nama;
        $barang->stok = $request->stok;
        $barang->deskripsi = $request->desc;
        $barang->save();

        return redirect('/stok')->with('success', 'Barang berhasil diperbarui!');
    }

    public function delete($id){
        StokBarang::destroy($id);
        return redirect('/stok')->with('success', 'Barang berhasil dihapus!');
    }
    public function deleteAll(){
        StokBarang::delete();
        return redirect('/stok')->with('success', 'Barang berhasil dihapus!');
    }
}