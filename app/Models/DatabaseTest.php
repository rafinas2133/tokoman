<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseTest extends Model
{
    public static function testConnection()
    {
        try {
            // Lakukan koneksi ke basis data menggunakan konfigurasi yang diberikan
            DB::connection()->getPdo();
            // Jika koneksi berhasil, kembalikan pesan sukses
            return "Koneksi ke database berhasil!";
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangkap dan kembalikan pesan kesalahan
            return "Koneksi ke database gagal: " . $e->getMessage();
        }
    }
}
