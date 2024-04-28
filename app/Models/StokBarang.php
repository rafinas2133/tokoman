<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barangs'; // Nama tabel di database

    protected $fillable = [
        'jenis_barang', 'nama_barang', 'stok', 'deskripsi'
    ];
}