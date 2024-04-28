<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\pegawaiController;




// Route untuk validasi token admin
Route::post('/change-token', [TokenController::class, 'changeToken'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('change.token');
Route::get('/forgot-token', [TokenController::class, 'forgotAdmin'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('admin.forgot.token');
Route::post('/insert-token', [TokenController::class, 'insertToken'])->middleware(['auth', 'verified'])->name('admin.insert.token');
Route::post('/validate-token', [TokenController::class, 'validateToken'])->middleware(['auth', 'verified'])->name('validate.token');
// Route untuk admin area yang dilindung
Route::get('/admin',[pegawaiController::class,'index'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Manajemen.Admin');
Route::get('admin/add', [pegawaiController::class,'add'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Tambah.Pegawai');
Route::post('admin/addsave', [pegawaiController::class,'addSave'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Tambahkan.Pegawai');
Route::get('admin/edit/{id}', [pegawaiController::class,'edit'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Edit.Pegawai');
Route::post('admin/editsave', [pegawaiController::class,'editsave'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Editkan.Pegawai');
Route::get('admin/delete/{id}', [pegawaiController::class,'delete'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Hapus.Pegawai');
Route::get('admin/deleteAll', [pegawaiController::class,'deleteAll'])->middleware(['auth', 'token.validated'])->middleware(['auth', 'verified'])->name('Hapus.AllPegawai');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/stok', function () {
    return view('stok.index');
})->middleware(['auth', 'verified'])->name('Manajemen Stok Barang');

Route::get('/dashboard', function () {
    $session=Session::get('token_validated');
    if ($session) {
        return view('dashboard',['key' => true]);
    }else{
        return view('dashboard',['key' => false]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
