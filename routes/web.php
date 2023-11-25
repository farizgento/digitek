<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\SekolahController;
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