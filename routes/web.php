<?php

use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/auth',[AuthController::class,'redirectLogin']);


Route::prefix('super-admin')->middleware(['auth:sanctum','verified','role:super_admin'])->group(function () {
    Route::get('/', function () {
        return view('super-admin.index');
    })->name('super-admin-index');
});

Route::prefix('admin')->middleware(['auth:sanctum','verified','role:admin'])->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin-index');
});

Route::middleware(['auth:sanctum','verified','role:user'])->group(function () {

    Route::get('/', function () {
        return view('user-index');
    })->name('user-index');
});