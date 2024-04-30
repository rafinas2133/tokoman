<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\StokBarang;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class barangController extends Controller
{
    public function index(){
        $types = StokBarang::select('jenis_tutup')->distinct()->inRandomOrder()->get();
        $barang = StokBarang::paginate(9);
        return view("welcome", ["barangs" => $barang],compact('types'));
    }
    public function employeeIndex(){
        $barang = StokBarang::paginate(9);
        return view("dashboard", ["barangs" => $barang]);
    }
    public function adminIndex(){
        $barang = StokBarang::paginate(9);
        return view("stok.index", ["barangs" => $barang]);
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
            'buy'=> 'required',
            'sell'=> 'required',
            'ukuran'=> 'required',
            'gambar1'=>'required',
            'gambar2'=>'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('/stok')->withErrors($validator)->withInput();
        }
        
        $id = '';
        $nama_barang = $request->nama;;
        $ukuran = preg_replace('/\D/', '', $request->ukuran); // Mengambil angka dari ukuran
        $jenis_tutup = $request->jenis == 'tinggi' ? 'H' : 'L'; // Mengambil jenis tutup

        if (strlen($nama_barang) >= 3) {
            $id .= strtoupper(substr($nama_barang, 0, 2)); // Mengambil 2 huruf depan
            $id .= strtoupper(substr($nama_barang, -1)); // Mengambil 1 huruf belakang
        } else {
            $id .= strtoupper(substr($nama_barang, 0, 1)); // Mengambil 1 huruf depan
        }

        $id .= $ukuran;
        $id .= $jenis_tutup;
        $id .= $request->stok;
        $path1='';
        $path2='';
        $fileName1='';
        $fileName2= '';
        if($request->file('gambar1') != null){
            $imageName = time().'.'.$request->file('gambar1')->getClientOriginalExtension();
            $request->file('gambar1')->move(public_path(), $imageName);
            $path1='/'.$fileName1;
        }
        if($request->file('gambar2')!= null){
            $imageName = time().'.'.$request->file('gambar2')->getClientOriginalExtension();
            $request->file('gambar2')->move(public_path(), $imageName);
            $path1='/'.$fileName1;
        }
        
        $barang = new StokBarang();
        $barang->id_barang = $id;
        $barang->nama_barang = $request->nama;
        $barang->stok = $request->stok;
        $barang->jenis_tutup = $request->jenis;
        $barang->harga_beli = $request->buy;
        $barang->harga_jual = $request->sell;
        $barang->ukuran = $request->ukuran;
        $barang->pathImg1 = $path1;
        $barang->pathImg2 = $path2;
        $barang->fileName1 = $fileName1;
        $barang->fileName2 = $fileName2;
        $barang->save();

        return redirect('/stok')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id) {
        $barang = StokBarang::where('id_barang', $id)->first();
        return view("stok.edit", ["brg" => $barang]);
    }
    public function deleteImg($id){
        $barang = StokBarang::where('id_barang',$id)->first();
        $barang->pathImg2 ='';
        $fileName = $barang->fileName2;
        $barang->fileName2 ='';
        unlink('/'.$fileName);
        $barang->save();
        return redirect('/stok')->with('success','');
    }
    function timpaGambar1($id){
        $barang=StokBarang::where('id_barang', $id)->first();
        $pathImg1 = $barang->pathImg1;
        if($pathImg1!=''){
            unlink('/'.$barang->fileName1);
        }
        
    }
    function timpaGambar2($id){
        $barang=StokBarang::where('id_barang', $id)->first();
        $pathImg2 = $barang->pathImg2;
        if($pathImg2!=''){
            unlink('/'.$barang->fileName2);
        } 
    }
    public function editSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'nama' => 'required',
            'stok' => 'required|integer',
            'buy'=> 'required',
            'sell'=> 'required',
            'ukuran'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/stok')->withErrors($validator)->withInput();
        }
        $barang = StokBarang::where('id_barang', $id)->first();
        $path1=$barang->pathImg1;
        $path2=$barang->pathImg2;;
        $fileName1=$barang->fileName1;
        $fileName2=$barang->fileName2;
        if($request->file('gambar1') != null){
            $imageName = time().'.'.$request->file('gambar1')->getClientOriginalExtension();
            $request->file('gambar1')->move(public_path(), $imageName);
            $path1='/'.$fileName1;
        }
        if($request->file('gambar2')!= null){
            $imageName = time().'.'.$request->file('gambar2')->getClientOriginalExtension();
            $request->file('gambar2')->move(public_path(), $imageName);
            $path1='/'.$fileName1;
        }
        
        
        $barang->nama_barang = $request->nama;
        $barang->stok = $request->stok;
        $barang->jenis_tutup = $request->jenis;
        $barang->harga_beli = $request->buy;
        $barang->harga_jual = $request->sell;
        $barang->ukuran = $request->ukuran;
        $barang->pathImg1 = $path1;
        $barang->pathImg2 = $path2;
        $barang->fileName1 = $fileName1;
        $barang->fileName2 = $fileName2;
        $barang->save();

        return redirect('/stok')->with('success', 'Barang berhasil ditambahkan!');
    }
    
    public function delete($id){
        $barang=StokBarang::where('id', $id)->first();
        $pathImg2 = $barang->pathImg2;
        if($pathImg2!=''){
            unlink('/'.$barang->fileName2);
        }
        unlink('/'.$barang->fileName1);
        StokBarang::destroy($id);
        return redirect('/stok')->with('success', 'Barang berhasil dihapus!');
    }
    public function deleteAll(){
        $barang=StokBarang::all();
        
        foreach($barang as $value){
        $pathImg2 = $value->pathImg2;
            if($pathImg2!=''){
                unlink('/'.$value->fileName2);
            }
            unlink('/'.$value->fileName1);
        }
        StokBarang::truncate();
        
        return redirect('/stok')->with('success', 'Barang berhasil dihapus!');
    }
}