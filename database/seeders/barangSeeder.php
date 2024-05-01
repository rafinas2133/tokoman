<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class barangSeeder extends Seeder
{
    public function run()
    {
        DB::table('stok_barangs')->insert([
            [
                'id_barang' => 1,
                'nama_barang' => 'Barang 1',
                'stok' => 10,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'jenis_tutup' => 'tinggi',
                'ukuran' => 'M',
                'pathImg1' => '',
                'pathImg2' => '',
            ],
            [
                'id_barang' => 2,
                'nama_barang' => 'Barang 2',
                'stok' => 100,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'jenis_tutup' => 'tinggi',
                'ukuran' => 'M',
                'pathImg1' => '',
                'pathImg2' => '',
            ],
            [
                'id_barang' => 3,
                'nama_barang' => 'Barang 3',
                'stok' => 15,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'jenis_tutup' => 'rendah',
                'ukuran' => 'M',
                'pathImg1' => '',
                'pathImg2' => '',
            ],
            [
                'id_barang' => 4,
                'nama_barang' => 'Barang 4',
                'stok' => 30,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'jenis_tutup' => 'rendah',
                'ukuran' => 'M',
                'pathImg1' => '',
                'pathImg2' => '',
            ],
            [
                'id_barang' => 5,
                'nama_barang' => 'Barang 5',
                'stok' => 100,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'jenis_tutup' => 'tinggi',
                'ukuran' => 'M',
                'pathImg1' => '',
                'pathImg2' => '',
            ]
        ]);
    }
}