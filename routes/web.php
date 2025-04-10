<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BkuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing_pageController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('Tampilan_tambahan.Landing_page');
// });

Route::get('/', [Landing_pageController::class, 'index']);

// AUTH
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

// HOME
Route::get('/home', [HomeController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');

// DATA OPD
Route::get('/tampilopd', [OpdController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');
Route::post('/opd/store', [OpdController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/opd/edit/{id}', [OpdController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/opd/destroy/{id}', [OpdController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// DATA USER
Route::get('/tampiluser', [UserController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/store', [UserController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/aktif/{id}', [UserController::class, 'aktif'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/nonaktif/{id}', [UserController::class, 'nonaktif'])->middleware('auth:web','checkRole:Admin');
Route::get('/user/opd', [UserController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');

// DATA REKENING
Route::get('/tampilrekening', [RekeningController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekening/store', [RekeningController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekening/edit/{id_rekening}', [RekeningController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rek/destroy/{id_rekening}', [RekeningController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekening', [RekeningController::class, 'import'])->name('rekening.import')->middleware('auth:web','checkRole:Admin');

// DATA BANK
Route::get('/tampilbank', [BankController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/bank/store', [BankController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/bank/edit/{id_bank}', [BankController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/bank/destroy/{id_bank}', [BankController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// ANGGARAN
Route::get('/tampilanggaran', [AnggaranController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('anggaran', [AnggaranController::class, 'import'])->name('anggaran.import')->middleware('auth:web','checkRole:Admin');

// DATA BKU
Route::get('/tampilbku', [BkuController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/bku/store', [BkuController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/bku/edit/{id_transaksi}', [BkuController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/bku/destroy/{id_transaksi}', [BkuController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('bku', [BkuController::class, 'import'])->name('bku.import')->middleware('auth:web','checkRole:Admin');
Route::get('/bku/rekening', [BkuController::class, 'getDatarek'])->middleware('auth:web','checkRole:Admin');
Route::get('/bku/opd', [BkuController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');
Route::get('/bku/bank', [BkuController::class, 'getDatabank'])->middleware('auth:web','checkRole:Admin');