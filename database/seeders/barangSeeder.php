<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class barangSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $nama_barang = $faker->word;
            $ukuran = $faker->randomElement(['500ml', '750ml', '1000ml']);
            $jenis_tutup = $faker->randomElement(['tinggi', 'rendah']);
            $bal = $faker->numberBetween(1, 20);

            $id = '';
            if (strlen($nama_barang) >= 3) {
                $id .= strtoupper(substr($nama_barang, 0, 2)); // 2 huruf depan
                $id .= strtoupper(substr($nama_barang, -1)); // 1 huruf belakang
            } else {
                $id .= strtoupper(substr($nama_barang, 0, 1)); // 1 huruf depan jika nama kurang dari 3 huruf
            }

            $id .= preg_replace('/\D/', '', $ukuran); // Hanya angka dari ukuran
            $id .= $jenis_tutup == 'tinggi' ? 'H' : 'L';
            $id .= $bal;

            DB::table('stok_barangs')->insert([
                'id_barang' => $id,
                'nama_barang' => $nama_barang,
                'bal'=> $bal,
                'stok' => $faker->numberBetween(10, 100),
                'harga_beli' => $faker->numberBetween(1000, 10000),
                'harga_jual' => $faker->numberBetween(10000, 20000),
                'jenis_tutup' => $jenis_tutup,
                'ukuran' => $ukuran,
                'pathImg1' => '',
                'pathImg2' => '',
                'fileName1' => '',
                'fileName2' => '',
            ]);
        }
    }
}