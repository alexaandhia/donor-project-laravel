<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ResponseController;
use Faker\Guesser\Name;

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

Route::get('/', [DonorController::class, 'index'])->name('home');
Route::post('/store', [DonorController::class, 'store'])->name('store');

//buat login sm auth
Route::get('/login', [DonorController::class, 'login'])->name('login');
Route::post('/auth', [DonorController::class, 'auth'])->name('auth');

//admin dan aksesnya
Route::middleware(['isLogin', 'cekRole:admin'])->group(function(){
    Route::get('/admin', [DonorController::class, 'admin'])->name('admin');
    Route::delete('/delete/{id}', [DonorController::class, 'destroy'])->name('delete');
    Route::get('/export/pdf', [DonorController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/created/pdf/{id}', [DonorController::class, 'createPDF'])->name('created.pdf');
    Route::get('/export/excel', [DonorController::class, 'exportExcel'])->name('export.excel');
});

//officer dan aksesnya
Route::middleware(['isLogin', 'cekRole:officer'])->group(function(){
    Route::get('/officer', [DonorController::class, 'officer'])->name('officer');
    Route::get('/response/edit/{donor_id}', [ResponseController::class, 'edit'])->name('edit');
    Route::patch('/response/update/{donor_id}', [ResponseController::class, 'update'])->name('response.update');
    Route::get('/officer/sort', [ResponseController::class, 'sortType'])->name('sort.type');
});

//bisa diakses dua duanya
Route::middleware(['isLogin', 'cekRole:admin,officer'])->group(function(){
    Route::get('/logout', [DonorController::class, 'logout'])->name('logout');
});


Route::get ('/error', [DonorController::class, 'error'])->name('error');





