<?php

use App\Http\Controllers\agentsController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\mitraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\SearchStok;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\riwayatController;
use Illuminate\Support\Facades\Route;

// Route::post("/testingAPI123", [barangController::class, 'apiSeeder'])->name('testingAPI');
// Route untuk user terAuth()


Route::middleware(['auth','auth.session','verifypls','noback','verifyEdit'])->group(function () {
    //Agents Mitra
    Route::get('/permissionAPI/{id}', [barangController::class, 'channelRecieve'])->name('APIPermission');
    Route::get('/getAuthID', [pegawaiController::class, 'getAuthID'])->name('getAuthID');
    Route::get('/agents', [agentsController::class, 'index'])->name('agents');
    Route::get('/mitra', [mitraController::class, 'index'])->name('mitra');

    Route::post('/export-profit', [dashboardController::class, 'exportPDF'])->name('exportProfit');
    Route::post('/export-pdf', [riwayatController::class, 'exportPDF'])->name('exportPDF');

    // Route Semua Role User
    Route::prefix('riwayat')->group(function () {
        Route::get('/', [riwayatController::class, 'tampilkan'])->name('riwayat');
        Route::get('/filter', [riwayatController::class, 'filterResults'])->name('riwayatFilter');
    });

    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // Laporan dan profit
    Route::get('/pelaporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/hitungProfit', [ProfitController::class, 'index'])->name('profit.index');
    Route::post('/pelaporan', [LaporanController::class, 'laporanPost'])->name('pelaporan.postData');

    // Manipulasi Stok
    Route::prefix('stok')->group(function () {
        Route::get('/', [barangController::class, 'adminIndex'])->name('stokIndex');
        Route::get('/search', [SearchStok::class, 'index'])->name('searchStokadmin');
        Route::get('/add', [barangController::class, 'add'])->name('tambahBarang');
        Route::post('/addsave', [barangController::class, 'addsave'])->name('stokSave');
        Route::get('/edit/{id}', [barangController::class, 'edit'])->name('editStok');
        Route::put('/editsave/{id}', [barangController::class, 'editsave'])->name('editSave');
        Route::delete('/delete/{id}', [barangController::class, 'delete'])->name('deleteStok');

        Route::get('/addsave', function () {
            return redirect()->route('stokBarang');
        });
        Route::get('/editsave/{id}', function () {
            return redirect()->route('stokBarang');
        });
        Route::get('/delete/{id}', function () {
            return redirect()->route('stokBarang');
        });
    });

    Route::put('/tambahstok/{id}', [barangController::class, 'tambahStok'])->name('tambahStok');
    Route::delete('/deleteImg/{id}', [barangController::class, 'deleteImg'])->name('deletegambar');

    // Mentalin Request Post saat direquest Get
    Route::get('/tambahstok/{id}', function () {
        return redirect()->route('stokBarang');
    });
    Route::get('/deleteImg/{id}', function () {
        return redirect()->route('stokBarang');
    });

    // Khusus Admin
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/', [pegawaiController::class, 'index'])->name('Manajemen.Admin');
        Route::get('/add', [pegawaiController::class, 'add'])->name('Tambah.Pegawai');
        Route::post('/addsave', [pegawaiController::class, 'addSave'])->name('Tambahkan.Pegawai');
        Route::get('/edit/{id}', [pegawaiController::class, 'edit'])->name('Edit.Pegawai');
        Route::put('/editsave/{id}', [pegawaiController::class, 'editsave'])->name('Editkan.Pegawai');
        Route::delete('/delete/{id}', [pegawaiController::class, 'delete'])->name('Hapus.Pegawai');

        Route::get('/editsave/{id}', function () {
            return redirect()->route('Manajemen.Admin');
        });
        Route::get('/delete/{id}', function () {
            return redirect()->route('Manajemen.Admin');
        });
        Route::get('/addsave', function () {
            return redirect()->route('Manajemen.Admin');
        });
    });
});

// Route Guest unAuth()
Route::get('/', [barangController::class, 'index'])->middleware(['noback','verifyEdit'])->name('stokBarang');
Route::get('/wa/{id}', [barangController::class, 'reqWa']);
Route::get('/theAPI', [barangController::class, 'apiRecieve'])->middleware('auth')->name('theAPI');
// RouteSearch
Route::get('/search', [SearchController::class, 'index'])->name('search')->middleware('verifyEdit');

Route::middleware(['auth','auth.session', 'noback','verifyEdit'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
