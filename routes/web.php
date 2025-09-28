<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AnggaranopdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BaprekonOpdController;
use App\Http\Controllers\BkuController;
use App\Http\Controllers\BkuOpdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KamarControlleruser;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\Landing_pageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ObjekController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\Realisasi_hd_Controller;
use App\Http\Controllers\Realisasi_HD_Controller as ControllersRealisasi_HD_Controller;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\RealisasiopdController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\RekonbkuController;
use App\Http\Controllers\RincianObjekController;
use App\Http\Controllers\SubRincianObjekController;
use App\Http\Controllers\TarikSp2dController;
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

// REALISASI
Route::get('/tampilrealisasi', [RealisasiController::class, 'index'])->name('realisasi.index')->middleware('auth:web','checkRole:Admin');

// REALISASI HALAMAN DEPAN
Route::get('/tampilrealisasi_hd', [ControllersRealisasi_HD_Controller::class, 'index']);

// REKAPAN REKENING 
Route::get('/tampilrekapanrek', [KamarController::class, 'index'])->name('view.dataindex.index')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilrekapanrek/{id}/tampilawal', [KamarController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilrekapanrek/{id}/tampil', [KamarController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/kamar/rekening', [KamarController::class, 'getDatarek'])->middleware('auth:web','checkRole:Admin');
Route::get('/kamar/opd', [KamarController::class, 'getDataopd1'])->middleware('auth:web','checkRole:Admin');

// Route::get('/downloadlaporanexcel1', [KamarController::class, 'Exportexcells'])->name('laporan.downloadlaporanexcel1')->middleware('auth:web','checkRole:Admin');


// REKAPAN REKENING USER
Route::get('/tampilrekapanrekuser', [KamarControlleruser::class, 'index'])->name('view.dataindexuser.index')->middleware('auth:web','checkRole:User');
Route::get('/tampilrekapanrekuser/{id}/tampilawal', [KamarControlleruser::class, 'viewdataindexuser'])->name('view.datauser.tampil')->middleware('auth:web','checkRole:User');
Route::get('/tampilrekapanrekuser/{id}/tampil', [KamarControlleruser::class, 'viewdataindexuser'])->name('view.datauser.tampil')->middleware('auth:web','checkRole:User');
Route::get('/bku/rekening2', [KamarControlleruser::class, 'getDatarek'])->middleware('auth:web','checkRole:User');

// DATA PERIODE
Route::get('/tampilperiode', [PeriodeController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/periode/store', [PeriodeController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/periode/edit/{id}', [PeriodeController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/periode/destroy/{id}', [PeriodeController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// TARIK SP2D SIPD
Route::get('/tampilsp2dsipd', [TarikSp2dController::class, 'index'])->middleware('auth:web','checkRole:Admin');

// MAINTENANCE
// Route::get('/', [MaintenanceController::class, 'index']);

// DATA BKU OPD
Route::get('/tampilbkuopd', [BkuOpdController::class, 'index'])->middleware('auth:web','checkRole:User');
Route::post('/bkuopd/store', [BkuOpdController::class, 'store'])->middleware('auth:web','checkRole:User');
Route::get('/bkuopd/rekening', [BkuOpdController::class, 'getDatarek'])->middleware('auth:web','checkRole:User');
Route::get('/bkuopd/opd', [BkuOpdController::class, 'getDataopd'])->middleware('auth:web','checkRole:User');
Route::get('/bkuopd/bank', [BkuOpdController::class, 'getDatabank'])->middleware('auth:web','checkRole:User');
Route::get('/bkuopd/edit/{id_transaksi}', [BkuOpdController::class, 'editbkuopd'])->middleware('auth:web','checkRole:User');


Route::get('/rekakun/bkuopd', [BkuOpdController::class, 'getDataakun1'])->name('akun1.index')->middleware('auth:web','checkRole:User');
Route::get('/rekkelompok/bkuopd/{id}', [BkuOpdController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:User');
Route::get('/rekjenis/bkuopd/{id}', [BkuOpdController::class, 'getDatajenis'])->middleware('auth:web','checkRole:User');
Route::get('/rekobjek/bkuopd/{id}', [BkuOpdController::class, 'getDataobjek'])->middleware('auth:web','checkRole:User');
Route::get('/rekrincianobjek/bkuopd/{id}', [BkuOpdController::class, 'getDatarincianobjek'])->middleware('auth:web','checkRole:User');
Route::get('/reksubrincianobjek/bkuopd/{id}', [BkuOpdController::class, 'getDatasubrincianobjek'])->middleware('auth:web','checkRole:User');

Route::get('/bkuopd5/edit/{id_transaksi}', [BkuOpdController::class, 'tambahkasbpkad'])->middleware('auth:web','checkRole:User');
Route::post('/bkukasbpkad/update/{id_transaksi}', [BkuOpdController::class, 'simpankasbpkad'])->middleware('auth:web','checkRole:User');
Route::get('/bkukasbpkad/batal/{id_transaksi}', [BkuOpdController::class, 'batalkasbpkad'])->middleware('auth:web','checkRole:User');
Route::post('/bkukasbpkad/updatebatal/{id_transaksi}', [BkuOpdController::class, 'simpanbatalkasbpkad'])->middleware('auth:web','checkRole:User');
Route::get('/bkuopd5/ubah/{id_transaksi}', [BkuOpdController::class, 'ubahkasbpkad'])->middleware('auth:web','checkRole:User');
Route::post('/bkukasbpkad/updateubah/{id_transaksi}', [BkuOpdController::class, 'simpanubahkasbpkad'])->middleware('auth:web','checkRole:User');

// DATA REK PENERIMAAN PENDAPATAN
//AKUN
Route::get('/tampilrekakun', [AkunController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekakun/store', [AkunController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekakun/edit/{id}', [AkunController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rekakun/destroy/{id}', [AkunController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekakun', [AkunController::class, 'import'])->name('rekakun.import')->middleware('auth:web','checkRole:Admin');

// KELOMPOK
Route::get('/tampilrekkelompok', [KelompokController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekkelompok/store', [KelompokController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/edit/{id_kel}', [KelompokController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rekkelompok/destroy/{id_kel}', [KelompokController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekkelompok', [KelompokController::class, 'import'])->name('rekkelompok.import')->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/akun', [KelompokController::class, 'getDataakun'])->middleware('auth:web','checkRole:Admin');

// JENIS
Route::get('/tampilrekjenis', [JenisController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekjenis/store', [JenisController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekjenis/edit/{id_jen}', [JenisController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rekjenis/destroy/{id_jen}', [JenisController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekjenis', [JenisController::class, 'import'])->name('rekjenis.import')->middleware('auth:web','checkRole:Admin');

Route::get('/rekakun/jenis', [JenisController::class, 'getDataakun'])->name('akun.index')->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/jenis/{id}', [JenisController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:Admin');

// OBJEK
Route::get('/tampilrekobjek', [ObjekController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekobjek/store', [ObjekController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekobjek/edit/{id_o}', [ObjekController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rekobjek/destroy/{id_o}', [ObjekController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekobjek', [ObjekController::class, 'import'])->name('rekobjek.import')->middleware('auth:web','checkRole:Admin');

Route::get('/rekakun/objek', [ObjekController::class, 'getDataakun'])->name('akun.index')->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/objek/{id}', [ObjekController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekjenis/objek/{id}', [ObjekController::class, 'getDatajenis'])->middleware('auth:web','checkRole:Admin');

// RINCIAN OBJEK
Route::get('/tampilrekrincianobjek', [RincianObjekController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/rekrincianobjek/store', [RincianObjekController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekrincianobjek/edit/{id_ro}', [RincianObjekController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/rekrincianobjek/destroy/{id_ro}', [RincianObjekController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('rekrincianobjek', [RincianObjekController::class, 'import'])->name('rekrincianobjek.import')->middleware('auth:web','checkRole:Admin');

Route::get('/rekakun/rincianobjek', [RincianObjekController::class, 'getDataakun'])->name('akun.index')->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/rincianobjek/{id}', [RincianObjekController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekjenis/rincianobjek/{id}', [RincianObjekController::class, 'getDatajenis'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekobjek/rincianobjek/{id}', [RincianObjekController::class, 'getDataobjek'])->middleware('auth:web','checkRole:Admin');

// SUB RINCIAN OBJEK
Route::get('/tampilreksubrincianobjek', [SubRincianObjekController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/reksubrincianobjek/store', [SubRincianObjekController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/reksubrincianobjek/edit/{id_ro}', [SubRincianObjekController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/reksubrincianobjek/destroy/{id_ro}', [SubRincianObjekController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('reksubrincianobjek', [SubRincianObjekController::class, 'import'])->name('reksubrincianobjek.import')->middleware('auth:web','checkRole:Admin');

Route::get('/rekakun/subrincianobjek', [SubRincianObjekController::class, 'getDataakun'])->name('akun.index')->middleware('auth:web','checkRole:Admin');
Route::get('/rekkelompok/subrincianobjek/{id}', [SubRincianObjekController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekjenis/subrincianobjek/{id}', [SubRincianObjekController::class, 'getDatajenis'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekobjek/subrincianobjek/{id}', [SubRincianObjekController::class, 'getDataobjek'])->middleware('auth:web','checkRole:Admin');
Route::get('/rekrincianobjek/subrincianobjek/{id}', [SubRincianObjekController::class, 'getDatarincianobjek'])->middleware('auth:web','checkRole:Admin');

// DATA REKON
Route::get('/tampilrekon', [RekonbkuController::class, 'index'])->middleware('auth:web','checkRole:User');
Route::get('/tampilrekon2', [RekonbkuController::class, 'index2'])->middleware('auth:web','checkRole:User');

// REALISASI OPD
Route::get('/tampilrealisasiopd', [RealisasiopdController::class, 'index'])->name('realisasiopd.index')->middleware('auth:web','checkRole:User');

// DATA ANGGARAN OPD
Route::get('/tampilanggaranopd', [AnggaranopdController::class, 'index'])->middleware('auth:web','checkRole:User');
Route::post('/anggaranopd/store', [AnggaranopdController::class, 'store'])->middleware('auth:web','checkRole:User');
Route::get('/anggaranopd/edit/{id_anggaranopd}', [AnggaranopdController::class, 'edit'])->middleware('auth:web','checkRole:User');
Route::delete('/anggaranopd/destroy/{id_anggaranopd}', [AnggaranopdController::class, 'destroy'])->middleware('auth:web','checkRole:User');

Route::get('/rekakun/anggaranopd', [AnggaranopdController::class, 'getDataakun1'])->name('akun1.index')->middleware('auth:web','checkRole:User');
Route::get('/rekkelompok/anggaranopd/{id}', [AnggaranopdController::class, 'getDatakelompok'])->middleware('auth:web','checkRole:User');
Route::get('/rekjenis/anggaranopd/{id}', [AnggaranopdController::class, 'getDatajenis'])->middleware('auth:web','checkRole:User');
Route::get('/rekobjek/anggaranopd/{id}', [AnggaranopdController::class, 'getDataobjek'])->middleware('auth:web','checkRole:User');
Route::get('/rekrincianobjek/anggaranopd/{id}', [AnggaranopdController::class, 'getDatarincianobjek'])->middleware('auth:web','checkRole:User');
Route::get('/reksubrincianobjek/anggaranopd/{id}', [AnggaranopdController::class, 'getDatasubrincianobjek'])->middleware('auth:web','checkRole:User');

// BAP REKON
Route::get('/tampilbaprekon', [BaprekonOpdController::class, 'index'])->middleware('auth:web','checkRole:User');



