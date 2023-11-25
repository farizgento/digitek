<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\LokasiBukuController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TipeBukuController;
use App\Models\LokasiBuku;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard-guest');


Route::prefix('super-admin')->middleware(['auth:sanctum','role:super_admin'])->group(function () {
    Route::get('/', function () {
        return view('super-admin.index');
    })->name('super-admin-index');
    // ADMIN
    Route::get('/admin',[AuthController::class,'getAllAdmin'])->name('admin-superadmin');
    Route::post('/admin',[AuthController::class,'addAdmin'])->name('add-admin');
    
    // SEKOLAH
    Route::get('/sekolah',[SekolahController::class,'getAllSuper'])->name('sekolah-superadmin');
    Route::post('/sekolah',[SekolahController::class,'store'])->name('add-sekolah');
    Route::put('/sekolah,{sekolah}',[SekolahController::class,'update'])->name('update-sekolah');
    Route::delete('/sekolah,{sekolah}',[SekolahController::class,'delete'])->name('delete-sekolah');
 
    // JENIS BUKU
    Route::get('/jenis-buku',[JenisBukuController::class,'getAllsuper'])->name('jenis-buku-super');
    Route::post('/jenis-buku',[JenisBukuController::class,'store'])->name('store-jenis');
    Route::put('/jenis-buku,{jenisbuku}',[JenisBukuController::class,'update'])->name('update-jenis-buku');
    Route::delete('/jenis-buku,{jenisbuku}',[JenisBukuController::class,'delete'])->name('delete-jenis-buku');
 
    // LOKASI BUKU
    Route::get('/lokasi-buku',[LokasiBukuController::class,'getAllsuper'])->name('lokasi-buku-super');
    Route::post('/lokasi-buku',[LokasiBukuController::class,'store'])->name('store-lokasi');
    Route::put('/lokasi-buku,{lokasibuku}',[LokasiBukuController::class,'update'])->name('update-lokasi-buku');
    Route::delete('/lokasi-buku,{lokasibuku}',[LokasiBukuController::class,'delete'])->name('delete-lokasi-buku');
 
    // TIPE BUKU
    Route::get('/tipe-buku',[TipeBukuController::class,'getAllsuper'])->name('tipe-super');
    Route::post('/tipe',[TipeBukuController::class,'store'])->name('store-tipe-super');
    Route::put('/tipe,{tipebuku}',[TipeBukuController::class,'update'])->name('update-tipe-super');
    Route::delete('/tipe,{tipebuku}',[TipeBukuController::class,'delete'])->name('delete-tipe-super');
 
    // BUKU
    Route::get('/buku',[BukuController::class,'getAllsuper'])->name('buku-super');
    Route::post('/buku',[BukuController::class,'store'])->name('store-buku-super');
    Route::put('/buku,{buku}',[BukuController::class,'update'])->name('update-buku-super');
    Route::delete('/buku,{buku}',[BukuController::class,'delete'])->name('delete-buku-super');
    
});

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin-index');
});

Route::middleware(['auth:sanctum','role:user'])->group(function () {
    Route::get('/users', function () {
        return view('user.index');
    })->name('user-index');
    
});