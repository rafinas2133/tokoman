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
                'jenis_barang' => 'Elektronik',
                'nama_barang' => 'Laptop',
                'stok' => 15,
                'deskripsi' => 'Laptop terbaru dengan spesifikasi tinggi.'
            ],
            [
                'jenis_barang' => 'Pakaian',
                'nama_barang' => 'Jaket',
                'stok' => 30,
                'deskripsi' => 'Jaket hangat untuk musim dingin.'
            ],
            [
                'jenis_barang' => 'Makanan',
                'nama_barang' => 'Cokelat',
                'stok' => 50,
                'deskripsi' => 'Cokelat belgia asli.'
            ]
        ]);
    }
}