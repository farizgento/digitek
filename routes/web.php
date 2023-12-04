<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ChartPeminjamanController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\LokasiBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TipeBukuController;
use App\Http\Controllers\UserController;
use App\Models\LokasiBuku;
use App\Models\Peminjaman;
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

Route::get('/',[UserController::class,'index'])->name('home-user');
Route::get('/jenis-buku/{jenisbuku}',[UserController::class,'buku'])->name('buku-user');
Route::get('/ebook/{nama}',[BukuController::class,'viewEbookGuest'])->name('view-ebook-guest');
Route::get('/ebook-member/{buku}',[BukuController::class,'viewEbook'])->name('view-ebook-member');

Route::middleware(['auth:sanctum','role:user'])->group(function(){
    Route::get('cart/{buku}',[UserController::class,'addToCart'])->name('add-cart');
    Route::delete('cart/{buku}', [UserController::class, 'removeFromCart'])->name('hapus-cart');
    Route::post('checkout',[UserController::class, 'checkout'])->name('checkout');
    Route::get('/peminjaman',[PeminjamanController::class,'getByUser'])->name('get-peminjaman-member');
});


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
    Route::put('/sekolah/{sekolah}',[SekolahController::class,'update'])->name('update-sekolah');
    Route::delete('/sekolah/{sekolah}',[SekolahController::class,'delete'])->name('delete-sekolah');
 
    // JENIS BUKU
    Route::get('/jenis-buku',[JenisBukuController::class,'getAllsuper'])->name('jenis-buku-super');
    Route::post('/jenis-buku',[JenisBukuController::class,'store'])->name('store-jenis');
    Route::put('/jenis-buku/{jenisbuku}',[JenisBukuController::class,'update'])->name('update-jenis-buku');
    Route::delete('/jenis-buku/{jenisbuku}',[JenisBukuController::class,'delete'])->name('delete-jenis-buku');
 
    // LOKASI BUKU
    Route::get('/lokasi-buku',[LokasiBukuController::class,'getAllsuper'])->name('lokasi-buku-super');
    Route::post('/lokasi-buku',[LokasiBukuController::class,'store'])->name('store-lokasi');
    Route::put('/lokasi-buku,{lokasibuku}',[LokasiBukuController::class,'update'])->name('update-lokasi-buku');
    Route::delete('/lokasi-buku,{lokasibuku}',[LokasiBukuController::class,'delete'])->name('delete-lokasi-buku');
 
    // TIPE BUKU
    Route::get('/tipe-buku',[TipeBukuController::class,'getAllsuper'])->name('tipe-super');
    Route::post('/tipe',[TipeBukuController::class,'store'])->name('store-tipe-super');
    Route::put('/tipe/{tipebuku}',[TipeBukuController::class,'update'])->name('update-tipe-super');
    Route::delete('/tipe/{tipebuku}',[TipeBukuController::class,'delete'])->name('delete-tipe-super');
 
    // BUKU
    Route::get('/ebook/{buku}',[BukuController::class,'viewEbook'])->name('view-ebook-super');
    Route::get('/buku',[BukuController::class,'getAllsuper'])->name('buku-super');
    Route::post('/buku',[BukuController::class,'store'])->name('store-buku-super');
    Route::put('/buku/{buku}',[BukuController::class,'update'])->name('update-buku-super');
    Route::delete('/buku/{buku}',[BukuController::class,'delete'])->name('delete-buku-super');

    // PEMINJAMAN
    Route::get('/peminjaman',[PeminjamanController::class,'getAllSuper'])->name('peminjaman-super');
    Route::put('/peminjaman/{peminjaman}',[PeminjamanController::class, 'update'])->name('update-peminjaman-super');
    
});

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {

    // JENIS BUKU
    Route::get('/jenis-buku',[JenisBukuController::class,'getAllAdmin'])->name('jenis-buku-admin');
    Route::post('/jenis-buku',[JenisBukuController::class,'store'])->name('store-jenis-admin');
    Route::put('/jenis-buku/{jenisbuku}',[JenisBukuController::class,'update'])->name('update-jenis-admin');
    Route::delete('/jenis-buku/{jenisbuku}',[JenisBukuController::class,'delete'])->name('delete-jenis-admin');
 
    // LOKASI BUKU
    Route::get('/lokasi-buku',[LokasiBukuController::class,'getAllAdmin'])->name('lokasi-buku-admin');
    Route::post('/lokasi-buku',[LokasiBukuController::class,'store'])->name('store-lokasi-admin');
    Route::put('/lokasi-buku/{lokasibuku}',[LokasiBukuController::class,'update'])->name('update-lokasi-admin');
    Route::delete('/lokasi-buku/{lokasibuku}',[LokasiBukuController::class,'delete'])->name('delete-lokasi-admin');
 
    // TIPE BUKU
    Route::get('/tipe-buku',[TipeBukuController::class,'getAllAdmin'])->name('tipe-admin');
    Route::post('/tipe',[TipeBukuController::class,'store'])->name('store-tipe-admin');
    Route::put('/tipe/{tipebuku}',[TipeBukuController::class,'update'])->name('update-tipe-admin');
    Route::delete('/tipe/{tipebuku}',[TipeBukuController::class,'delete'])->name('delete-tipe-admin');
 
    // BUKU
    Route::get('/buku',[BukuController::class,'getAllAdmin'])->name('buku-admin');
    Route::get('/ebook/{buku}',[BukuController::class,'viewEbook'])->name('view-ebook-admin');
    Route::post('/buku',[BukuController::class,'store'])->name('store-buku-admin');
    Route::put('/buku/{buku}',[BukuController::class,'update'])->name('update-buku-admin');
    Route::delete('/buku/{buku}',[BukuController::class,'delete'])->name('delete-buku-admin');

    // MEMBER
    Route::get('/member',[AuthController::class, 'AdminGetUserBySekolah'])->name('member-admin');
    Route::post('/member',[AuthController::class, 'AddAdmin'])->name('create-member-admin');

    // PEMINJAMAN
    Route::get('/peminjaman',[PeminjamanController::class, 'AdminGetBySekolahID'])->name('peminjaman-admin');
    Route::put('/peminjaman/{peminjaman}',[PeminjamanController::class, 'update'])->name('update-peminjaman-admin');

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin-index');
});

Route::middleware(['auth:sanctum','role:user'])->group(function () {
    Route::get('/users', function () {
        return view('user.index');
    })->name('user-index');
    
});