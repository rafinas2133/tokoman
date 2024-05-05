<?php

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
Route::middleware(['auth','verified','noback'])->group(function () {
    //Route Semua Role User
        //laporan dan profit
        Route::get('/pelaporan', [LaporanController::class,'index'])->name('laporan');
        Route::get('/hitungProfit', [ProfitController::class,'index'])->name('profit');
        Route::post('/pelaporan', [LaporanController::class,'store'])->name('pelaporan.store');
        //Manipulasi Stok
        Route::get('/stok', [barangController::class,'adminIndex'])->name('stokIndex');
        Route::get('/stok/search', [SearchStok::class,'index'])->name('searchStokadmin');
        Route::post('/tambahstok/{id}', [barangController::class,'tambahStok'])->name('tambahStok');
        Route::post('/deleteImg/{id}', [barangController::class,'deleteImg'])->name('deletegambar');
        Route::get('/stok/add', [barangController::class,'add'])->name('tambahBarang');
        Route::post('/stok/addsave', [barangController::class,'addsave'])->name('stokSave');
        Route::get('/stok/edit/{id}', [barangController::class,'edit'])->name('editStok');
        Route::post('/stok/editsave/{id}', [barangController::class,'editsave'])->name('editSave');
        Route::post('/stok/delete/{id}', [barangController::class,'delete'])->name('deleteStok');
        Route::post('/stok/deleteAll', [barangController::class,'deleteAll'])->name('deleteStokAll');
            //Mentalin Request Post saat direquest Get
            Route::get('/tambahstok/{id}', function () {return redirect()->route('stokBarang');});
            Route::get('/deleteImg/{id}', function () {return redirect()->route('stokBarang');});
            Route::get('/stok/addsave', function () {return redirect()->route('stokBarang');});
            Route::get('/stok/editsave/{id}', function () {return redirect()->route('stokBarang');});
            Route::get('/stok/delete/{id}', function () {return redirect()->route('stokBarang');});
            Route::get('/stok/deleteAll', function () {return redirect()->route('stokBarang');});
    //Route khusus Pegawai
    Route::middleware(['employee'])->group(function () {
        //Dashboard dan Search Pegawai isinya stok
        Route::get('/empdashboard', [riwayatController::class,'index'])->name('dashboardemp');
    });
    //Khusus Admin
    Route::middleware(['admin'])->group(function () {

        //Manajemen Pegawai
        Route::get('/admin',[pegawaiController::class,'index'])->name('Manajemen.Admin');
        Route::get('admin/add', [pegawaiController::class,'add'])->name('Tambah.Pegawai');
        Route::post('admin/addsave', [pegawaiController::class,'addSave'])->name('Tambahkan.Pegawai');
        Route::get('admin/edit/{id}', [pegawaiController::class,'edit'])->name('Edit.Pegawai');
        Route::post('admin/editsave', [pegawaiController::class,'editsave'])->name('Editkan.Pegawai');
        Route::post('admin/delete/{id}', [pegawaiController::class,'delete'])->name('Hapus.Pegawai');
        Route::post('admin/deleteAll', [pegawaiController::class,'deleteAll'])->name('Hapus.AllPegawai');
            //Mentalin Request Post saat direquest Get
            Route::get('admin/editsave', function () {return redirect()->route('Manajemen.Admin');});
            Route::get('admin/delete/{id}', function () {return redirect()->route('Manajemen.Admin');});
            Route::get('admin/deleteAll', function () {return redirect()->route('Manajemen.Admin');});
            Route::get('admin/addsave', function () {return redirect()->route('Manajemen.Admin');});
        //Dashboard admin
        Route::get('/dashboard', [riwayatController::class,'index'])->name('dashboard');
        
    });

});
//Route Guest unAuth()
Route::get('/', [barangController::class,'index'])->middleware('noback')->name('stokBarang');
Route::get('/wa/{id}', [barangController::class,'reqWa']);
//RouteSearch
Route::get('/search', [SearchController::class,'index'])->name('search');

Route::middleware(['auth','noback'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
