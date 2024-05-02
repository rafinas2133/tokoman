<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\SearchStok;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfitController;




// Route untuk user terAuth()
Route::middleware(['auth','verified'])->group(function () {
    //Route Semua Role User
        //laporan dan profit
        Route::get('/pelaporan', [LaporanController::class,'index'])->name('laporan');
        Route::get('/hitungProfit', [ProfitController::class,'index'])->name('profit');
        //Manipulasi Stok
        Route::post('/tambahstok/{id}', [barangController::class,'tambahStok'])->name('tambahStok');
        Route::get('/deleteImg/{id}', [barangController::class,'deleteImg'])->name('deletegambar');
        Route::get('/stok/add', [barangController::class,'add'])->name('tambahStok');
        Route::post('/stok/addsave', [barangController::class,'addsave'])->name('stokSave');
        Route::get('/stok/edit/{id}', [barangController::class,'edit'])->name('editStok');
        Route::post('/stok/editsave/{id}', [barangController::class,'editsave'])->name('editSave');
        Route::get('/stok/delete/{id}', [barangController::class,'delete'])->name('deleteStok');
        Route::get('/stok/deleteAll', [barangController::class,'deleteAll'])->name('deleteStokAll');
    //Route khusus Pegawai
    Route::middleware(['employee'])->group(function () {
        //Dashboard dan Search Pegawai isinya stok
        Route::get('/empdashboard', [barangController::class,'employeeIndex'])->name('dashboard');
        Route::get('/empdashboard/search', [SearchStok::class,'index'])->name('searchStokemp');
    });
    //Khusus Admin
    Route::middleware(['admin'])->group(function () {
        //Indeks Manajemen Stok dan Search di dalam Stok
        Route::get('/stok', [barangController::class,'adminIndex'])->name('stokIndex');
        Route::get('/stok/search', [SearchStok::class,'index'])->name('searchStokadmin');
        //Manajemen Pegawai
        Route::get('/admin',[pegawaiController::class,'index'])->name('Manajemen.Admin');
        Route::get('admin/add', [pegawaiController::class,'add'])->name('Tambah.Pegawai');
        Route::post('admin/addsave', [pegawaiController::class,'addSave'])->name('Tambahkan.Pegawai');
        Route::get('admin/edit/{id}', [pegawaiController::class,'edit'])->name('Edit.Pegawai');
        Route::post('admin/editsave', [pegawaiController::class,'editsave'])->name('Editkan.Pegawai');
        Route::get('admin/delete/{id}', [pegawaiController::class,'delete'])->name('Hapus.Pegawai');
        Route::get('admin/deleteAll', [pegawaiController::class,'deleteAll'])->name('Hapus.AllPegawai');
        //Dashboard admin
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
    });

});
//Route Guest unAuth()
Route::get('/', [barangController::class,'index'])->name('stokBarang');
Route::get('/wa/{id}', [barangController::class,'reqWa']);
//RouteSearch
Route::get('/search', [SearchController::class,'index'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
