<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\StokBarang;
use App\Models\kontak;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class barangController extends Controller
{
    public function index()
    {
        $types = StokBarang::select('jenis_tutup')->distinct()->inRandomOrder()->get();
        $barang = StokBarang::paginate(6);

        return view("welcome", ["barangs" => $barang], compact('types'));
    }
    public function reqWa($name)
    {
        $phone = kontak::where('name', 'ZidanElek')->first();
        return redirect("https://wa.me/$phone->noHp?text=Halo%20Tokoman,%20Saya%20Ingin%20Order%20Botol%20$name");
    }
    public function adminIndex()
    {
        $barang = StokBarang::paginate(9);
        return view("stok.index", ["barangs" => $barang]);

    }
    public function add()
    {
        return view("stok.add");
    }
    public function getUrlImg($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/images/';
        return $url . $value;
    }
    public function tambahStok(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stok' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect('/stok')->with('error', 'Stok harus angka');
        }
        $inputanstok = $request->stok;
        $barang = StokBarang::where('id_barang', $id)->first();
        $riwayat = new Riwayat();

        $riwayat->nama_barang = $barang->nama_barang;
        $riwayat->jenis_riwayat = 'masuk';
        $riwayat->jumlah = abs($inputanstok);
        $riwayat->tanggal = now();
        $riwayat->id_barang = $barang->id;
        $riwayat->save();

        $barang->stok += abs($inputanstok);
        $barang->save();

        return redirect('/stok')->with('success', 'Stok Berhasil Ditambahkan');
    }
    public function addSave(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenis' => 'required',
                'nama' => 'required',
                'stok' => 'required|integer',
                'bal' => 'required|integer',
                'buy' => 'required',
                'sell' => 'required',
                'ukuran' => 'required',
                'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'stok.integer' => 'Stok harus berupa angka.',
                'bal.integer' => 'Jumlah bal harus berupa angka.',
                'gambar1.image' => 'File harus berupa gambar.',
                'gambar1.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'gambar1.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.',
                'gambar2.image' => 'File harus berupa gambar.',
                'gambar2.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'gambar2.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.'
            ]
        );

        if ($validator->fails()) {
            return redirect('/stok/add')->with('error', $validator->errors()->first());
        }

        $id = '';
        $nama_barang = $request->nama;
        ;
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
        $id .= $request->bal;
        $path1 = '';
        $path2 = '';
        $filename1 = '';
        $filename2 = '';
        if ($request->file('gambar1') != null) {
            $file = $request->file('gambar1');
            $filename1 = '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('images/' . $filename1, file_get_contents($file));
            $path1 = $this->getUrlImg($filename1);
        }
        if ($request->file('gambar2') != null) {
            $file = $request->file('gambar2');
            $filename2 = '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('images/' . $filename2, file_get_contents($file));
            $path2 = $this->getUrlImg($filename2);
        }

        $barang = new StokBarang();
        $barang->id_barang = $id;
        $barang->nama_barang = $request->nama;
        $barang->stok = abs($request->stok);
        $barang->bal = abs($request->bal);
        $barang->jenis_tutup = $request->jenis;
        $barang->harga_beli = $request->buy;
        $barang->harga_jual = $request->sell;
        $barang->ukuran = $request->ukuran;
        $barang->pathImg1 = $path1;
        $barang->pathImg2 = $path2;
        $barang->fileName1 = $filename1;
        $barang->fileName2 = $filename2;
        $barang->save();

        $barang = StokBarang::where('id_barang', $id)->first();
        $riwayat = new Riwayat();

        $riwayat->nama_barang = $barang->nama_barang;
        $riwayat->jenis_riwayat = 'masuk';
        $riwayat->jumlah = abs($request->stok);
        $riwayat->tanggal = now();
        $riwayat->id_barang = $barang->id;
        $riwayat->save();

        return redirect('/stok')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $barang = StokBarang::where('id_barang', $id)->first();
        if ($barang) {
            return view("stok.edit", ["brg" => $barang]);
        } else {
            return redirect("/stok")->with("error", "Data tidak ditemukan");
        }
    }
    public function deleteImg($id)
    {
        $barang = StokBarang::where('id_barang', $id)->first();
        Storage::disk('s3')->delete('images/' . $barang->fileName2);
        $barang->pathImg2 = '';
        $barang->save();
        return redirect('/stok/edit/' . $id)->with('success','Gambar Berhasil Dihapus');
    }
    function timpaGambar1($id)
    {
        $barang = StokBarang::where('id_barang', $id)->first();
        $pathImg1 = $barang->pathImg1;
        if ($pathImg1 != '') {
            Storage::disk('s3')->delete('images/' . $barang->fileName1);
        }

    }
    function timpaGambar2($id)
    {
        $barang = StokBarang::where('id_barang', $id)->first();
        $pathImg2 = $barang->pathImg2;
        if ($pathImg2 != '') {
            Storage::disk('s3')->delete('images/' . $barang->fileName2);
        }
    }

    public function editSave(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenis' => 'required',
                'nama' => 'required',
                'stok' => 'required|integer',
                'bal' => 'required|integer',
                'buy' => 'required',
                'sell' => 'required',
                'ukuran' => 'required',
                'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'stok.integer' => 'Stok harus berupa angka.',
                'bal.integer' => 'Jumlah bal harus berupa angka.',
                'gambar1.image' => 'File harus berupa gambar.',
                'gambar1.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'gambar1.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.',
                'gambar2.image' => 'File harus berupa gambar.',
                'gambar2.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'gambar2.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.'
            ]

        );

        if ($validator->fails()) {
            return redirect('/stok/edit/' . $id)->with('error', $validator->errors()->first());
        }
        $barang = StokBarang::where('id_barang', $id)->first();
        $path1 = $barang->pathImg1;
        $path2 = $barang->pathImg2;
        $filename1 = $barang->fileName1;
        $filename2 = $barang->fileName2;
        if ($request->file('gambar1') != null) {
            $this->timpaGambar1($id);
            $file = $request->file('gambar1');
            $filename1 = '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('images/' . $filename1, file_get_contents($file));
            $path1 = $this->getUrlImg($filename1);
        }
        if ($request->file('gambar2') != null) {
            $this->timpaGambar2($id);
            $file = $request->file('gambar2');
            $filename2 = '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('images/' . $filename2, file_get_contents($file));
            $path2 = $this->getUrlImg($filename2);
        }


        $barang->nama_barang = $request->nama;
        $barang->stok = abs($request->stok);
        $barang->bal = abs($request->bal);
        $barang->jenis_tutup = $request->jenis;
        $barang->harga_beli = $request->buy;
        $barang->harga_jual = $request->sell;
        $barang->ukuran = $request->ukuran;
        $barang->pathImg1 = $path1;
        $barang->pathImg2 = $path2;
        $barang->fileName1 = $filename1;
        $barang->fileName2 = $filename2;
        $barang->save();

        return redirect('/stok/edit/' . $id)->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $barang = StokBarang::where('id', $id)->first();
        $pathImg2 = $barang->pathImg2;
        if ($pathImg2 != '') {
            Storage::disk('s3')->delete('images/' . $barang->fileName2);
        }
        Storage::disk('s3')->delete('images/' . $barang->fileName1);
        StokBarang::destroy($id);
        return redirect('/stok')->with('success', 'Data Berhasil Dihapus');
    }
}

