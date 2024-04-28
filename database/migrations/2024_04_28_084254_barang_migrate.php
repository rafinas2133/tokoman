<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_barangs', function (Blueprint $table) {
            $table->id(); // ID barang, auto increment
            $table->string('jenis_barang');
            $table->string('nama_barang');
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_barangs');
    }
};