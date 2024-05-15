<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\SearchStok;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\riwayatController;

// Route untuk user terAuth()
Route::middleware(['auth', 'verified', 'noback'])->group(function () {
    Route::post('/export-profit', [dashboardController::class, 'exportPDF'])->name('exportProfit');
    Route::post('/export-pdf', [riwayatController::class, 'exportPDF'])->name('exportPDF');
    //Route Semua Role User
    Route::prefix('riwayat')->group(function () {
        Route::get('/', [riwayatController::class, 'tampilkan'])->name('riwayat');
        Route::get('/filter', [riwayatController::class, 'filterResults'])->name('riwayatFilter');
    });
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    //laporan dan profit
    Route::get('/pelaporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/hitungProfit', [ProfitController::class, 'index'])->name('profit.index');
    Route::post('/pelaporan', [LaporanController::class, 'laporanPost'])->name('pelaporan.postData');
    //Manipulasi Stok
    Route::prefix('stok')->group(function () {
        Route::get('/', [barangController::class, 'adminIndex'])->name('stokIndex');
        Route::get('/search', [SearchStok::class, 'index'])->name('searchStokadmin');
        Route::get('/add', [barangController::class, 'add'])->name('tambahBarang');
        Route::post('/addsave', [barangController::class, 'addsave'])->name('stokSave');
        Route::get('/edit/{id}', [barangController::class, 'edit'])->name('editStok');
        Route::post('/editsave/{id}', [barangController::class, 'editsave'])->name('editSave');
        Route::post('/delete/{id}', [barangController::class, 'delete'])->name('deleteStok');
        Route::post('/deleteAll', [barangController::class, 'deleteAll'])->name('deleteStokAll');
        Route::get('/addsave', function () {
            return redirect()->route('stokBarang');
        });
        Route::get('/editsave/{id}', function () {
            return redirect()->route('stokBarang');
        });
        Route::get('/delete/{id}', function () {
            return redirect()->route('stokBarang');
        });
        Route::get('/deleteAll', function () {
            return redirect()->route('stokBarang');
        });

    });
    Route::post('/tambahstok/{id}', [barangController::class, 'tambahStok'])->name('tambahStok');
    Route::post('/deleteImg/{id}', [barangController::class, 'deleteImg'])->name('deletegambar');

    //Mentalin Request Post saat direquest Get
    Route::get('/tambahstok/{id}', function () {
        return redirect()->route('stokBarang');
    });
    Route::get('/deleteImg/{id}', function () {
        return redirect()->route('stokBarang');
    });
    //Khusus Admin
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/', [pegawaiController::class, 'index'])->name('Manajemen.Admin');
        Route::get('/add', [pegawaiController::class, 'add'])->name('Tambah.Pegawai');
        Route::post('/addsave', [pegawaiController::class, 'addSave'])->name('Tambahkan.Pegawai');
        Route::get('/edit/{id}', [pegawaiController::class, 'edit'])->name('Edit.Pegawai');
        Route::post('/editsave/{id}', [pegawaiController::class, 'editsave'])->name('Editkan.Pegawai');
        Route::post('/delete/{id}', [pegawaiController::class, 'delete'])->name('Hapus.Pegawai');
        Route::post('/deleteAll', [pegawaiController::class, 'deleteAll'])->name('Hapus.AllPegawai');
        //Mentalin Request Post saat direquest Get
        Route::get('/editsave/{id}', function () {
            return redirect()->route('Manajemen.Admin');
        });
        Route::get('/delete/{id}', function () {
            return redirect()->route('Manajemen.Admin');
        });
        Route::get('/deleteAll', function () {
            return redirect()->route('Manajemen.Admin');
        });
        Route::get('/addsave', function () {
            return redirect()->route('Manajemen.Admin');
        });
    });
});
//Route Guest unAuth()
Route::get('/', [barangController::class, 'index'])->middleware('noback')->name('stokBarang');
Route::get('/wa/{id}', [barangController::class, 'reqWa']);
//RouteSearch
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware(['auth', 'noback'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
