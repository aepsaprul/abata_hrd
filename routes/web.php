<?php

use App\Http\Controllers\CabangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HcCirController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HcLokerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HcLamaranController;
use App\Http\Controllers\HcTrainingController;
use App\Http\Controllers\MasterDivisiController;
use App\Http\Controllers\MasterKaryawanController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterCabangController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    // master
        // menu
        Route::get('master/nav', [NavController::class, 'index'])->name('nav.index');
            // nav main
            Route::post('master/nav/main_store', [NavController::class, 'mainStore'])->name('nav.main_store');
            Route::get('master/nav/{id}/main_edit', [NavController::class, 'mainEdit'])->name('nav.main_edit');
            Route::post('master/nav/main_update', [NavController::class, 'mainUpdate'])->name('nav.main_update');
            Route::get('master/nav/{id}/main_delete_btn', [NavController::class, 'mainDeleteBtn'])->name('nav.main_delete_btn');
            Route::post('master/nav/main_delete', [NavController::class, 'mainDelete'])->name('nav.main_delete');

            // nav sub
            Route::get('master/nav/sub_create', [NavController::class, 'subCreate'])->name('nav.sub_create');
            Route::post('master/nav/sub_store', [NavController::class, 'subStore'])->name('nav.sub_store');
            Route::get('master/nav/{id}/sub_edit', [NavController::class, 'subEdit'])->name('nav.sub_edit');
            Route::post('master/nav/sub_update', [NavController::class, 'subUpdate'])->name('nav.sub_update');
            Route::get('master/nav/{id}/sub_delete_btn', [NavController::class, 'subDeleteBtn'])->name('nav.sub_delete_btn');
            Route::post('master/nav/sub_delete', [NavController::class, 'subDelete'])->name('nav.sub_delete');

        // user
        Route::get('master/user', [UserController::class, 'index'])->name('user.index');
        Route::get('master/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('master/user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('master/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('master/user/{id}/access', [UserController::class, 'access'])->name('user.access');
        Route::put('master/user/{id}/access_save', [UserController::class, 'accessSave'])->name('user.access_save');
        Route::post('master/user/sync', [UserController::class, 'sync'])->name('user.sync');

        // cabang
        Route::get('master/cabang', [CabangController::class, 'index'])->name('cabang.index');
        Route::post('master/cabang/store', [CabangController::class, 'store'])->name('cabang.store');
        Route::get('master/cabang/{id}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
        Route::put('master/cabang/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
        Route::get('master/cabang/{id}/delete_btn', [CabangController::class, 'deleteBtn'])->name('cabang.delete_btn');
        Route::post('master/cabang/delete', [CabangController::class, 'delete'])->name('cabang.delete');

        // jabatan
        Route::get('master/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::post('master/jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('master/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('master/jabatan/{id}/update', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::get('master/jabatan/{id}/delete_btn', [JabatanController::class, 'deleteBtn'])->name('jabatan.delete_btn');
        Route::post('master/jabatan/delete', [JabatanController::class, 'delete'])->name('jabatan.delete');

        // divisi
        Route::get('master/divisi', [DivisiController::class, 'index'])->name('divisi.index');
        Route::post('master/divisi/store', [DivisiController::class, 'store'])->name('divisi.store');
        Route::get('master/divisi/{id}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
        Route::put('master/divisi/{id}/update', [DivisiController::class, 'update'])->name('divisi.update');
        Route::get('master/divisi/{id}/delete_btn', [DivisiController::class, 'deleteBtn'])->name('divisi.delete_btn');
        Route::post('master/divisi/delete', [DivisiController::class, 'delete'])->name('divisi.delete');

        // loker
        Route::get('master/loker', [LokerController::class, 'index'])->name('loker.index');
        Route::get('master/loker/create', [LokerController::class, 'create'])->name('loker.create');
        Route::post('master/loker/store', [LokerController::class, 'store'])->name('loker.store');
        Route::get('master/loker/{id}/edit', [LokerController::class, 'edit'])->name('loker.edit');
        Route::put('master/loker/{id}/update', [LokerController::class, 'update'])->name('loker.update');
        Route::get('master/loker/{id}/delete_btn', [LokerController::class, 'deleteBtn'])->name('loker.delete_btn');
        Route::post('master/loker/delete', [LokerController::class, 'delete'])->name('loker.delete');

    // karyawan
    Route::resource('karyawan', MasterKaryawanController::class);
    Route::get('karyawan/{id}/delete', [MasterKaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/kontrak-simpan', [MasterKaryawanController::class, 'kontrakSimpan'])->name('karyawan.kontrak_simpan');
    Route::post('karyawan/kontrak-edit', [MasterKaryawanController::class, 'kontrakEdit'])->name('karyawan.kontrak_edit');
    Route::post('karyawan/kontrak-update', [MasterKaryawanController::class, 'kontrakUpdate'])->name('karyawan.kontrak_update');
    Route::post('karyawan/kontrak-delete', [MasterKaryawanController::class, 'kontrakDelete'])->name('karyawan.kontrak_delete');

    // cuti
    Route::get('cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('cuti/{id}/delete_btn', [CutiController::class, 'deleteBtn'])->name('cuti.delete_btn');
    Route::post('cuti/delete', [CutiController::class, 'delete'])->name('cuti.delete');

    // lamaran
    Route::get('lamaran', [LamaranController::class, 'index'])->name('lamaran.index');
    Route::get('lamaran/{id}/show', [LamaranController::class, 'show'])->name('lamaran.show');
    Route::get('lamaran/{id}/delete', [LamaranController::class, 'delete'])->name('lamaran.delete');
    Route::get('lamaran/{id}/rekrutmen', [LamaranController::class, 'rekrutmen'])->name('lamaran.rekrutmen');
    Route::get('lamaran/{id}/gagal_interview', [LamaranController::class, 'gagalInterview'])->name('lamaran.gagal.interview');
    Route::get('lamaran/{id}/interview', [LamaranController::class, 'interview'])->name('lamaran.interview');
    Route::get('lamaran/{id}/gagal', [LamaranController::class, 'gagal'])->name('lamaran.gagal');
    Route::get('lamaran/{id}/terima', [LamaranController::class, 'terima'])->name('lamaran.terima');
    Route::get('lamaran/berkas/{pdf}', [LamaranController::class, 'berkas'])->name('lamaran.berkas');

    // penggajian
    Route::get('penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');

    // resign
    Route::get('resign', [ResignController::class, 'index'])->name('resign.index');

    // training
    Route::get('training', [TrainingController::class, 'index'])->name('training.index');

    // Route::resource('hc/cir', HcCirController::class);
    // Route::get('hc/cir/{id}/delete', [HcCirController::class, 'delete'])->name('cir.delete');
    // Route::get('hc/cir/{id}/atasan_approve', [HcCirController::class, 'atasanApprove'])->name('cir.atasan_approve');
    // Route::get('hc/cir/{id}/atasan_tolak', [HcCirController::class, 'atasanTolak'])->name('cir.atasan_tolak');
    // Route::get('hc/cir/{id}/hc_approve', [HcCirController::class, 'hcApprove'])->name('cir.hc_approve');
    // Route::get('hc/cir/{id}/hc_tolak', [HcCirController::class, 'hcTolak'])->name('cir.hc_tolak');

    // Route::get('hc/form_resign', [HcCirController::class, 'resignFormIndex'])->name('cir.index_form_resign');
    // Route::get('hc/form_resign/{id}/show', [HcCirController::class, 'resignShow'])->name('cir.resign_show');
    // Route::get('hc/form_resign/{id}/delete', [HcCirController::class, 'resignDelete'])->name('cir.resign_delete');
    // Route::get('hc/form_resign/{id}/atasan_approve', [HcCirController::class, 'resignAtasanApprove'])->name('cir.resign_atasan_approve');
    // Route::get('hc/form_resign/{id}/atasan_tolak', [HcCirController::class, 'resignAtasanTolak'])->name('cir.resign_atasan_tolak');
    // Route::get('hc/form_resign/{id}/hc_approve', [HcCirController::class, 'resignHcApprove'])->name('cir.resign_hc_approve');
    // Route::get('hc/form_resign/{id}/hc_tolak', [HcCirController::class, 'resignHcTolak'])->name('cir.resign_hc_tolak');
    // Route::get('hc/form_resign/{id}/direktur_approve', [HcCirController::class, 'resignDirekturApprove'])->name('cir.resign_direktur_approve');
    // Route::get('hc/form_resign/{id}/direktur_tolak', [HcCirController::class, 'resignDirekturTolak'])->name('cir.resign_direktur_tolak');

    // Route::get('hc/cuti', [HcCirController::class, 'indexCuti'])->name('cir.index_cuti');
    // Route::get('hc/cuti/create', [HcCirController::class, 'createCuti'])->name('cir.create_cuti');
    // Route::post('hc/cuti/store', [HcCirController::class, 'storeCuti'])->name('cir.store_cuti');
    // Route::get('hc/resign', [HcCirController::class, 'indexResign'])->name('cir.index_resign');
    // Route::get('hc/resign/create', [HcCirController::class, 'createResign'])->name('cir.create_resign');
    // Route::post('hc/resign/store', [HcCirController::class, 'storeResign'])->name('cir.store_resign');


    // Route::resource('hc/lamaran', HcLamaranController::class);
    // Route::get('hc/lamaran/{id}/delete', [HcLamaranController::class, 'delete'])->name('lamaran.delete');
    // Route::get('hc/lamaran/{id}/rekrutmen', [HcLamaranController::class, 'rekrutmen'])->name('lamaran.rekrutmen');
    // Route::get('hc/lamaran/{id}/gagal_interview', [HcLamaranController::class, 'gagalInterview'])->name('lamaran.gagal.interview');
    // Route::get('hc/lamaran/{id}/interview', [HcLamaranController::class, 'interview'])->name('lamaran.interview');
    // Route::get('hc/lamaran/{id}/gagal', [HcLamaranController::class, 'gagal'])->name('lamaran.gagal');
    // Route::get('hc/lamaran/{id}/terima', [HcLamaranController::class, 'terima'])->name('lamaran.terima');
    // Route::get('hc/lamaran/berkas/{pdf}', [HcLamaranController::class, 'berkas'])->name('training.berkas');


    // Route::resource('hc/training', HcTrainingController::class);
    // Route::get('hc/training/{id}/delete', [HcTrainingController::class, 'delete'])->name('training.delete');
    // Route::get('hc/training/data/modul/{file_modul}', [HcTrainingController::class, 'datamodul'])->name('training.cek.datamodul');

});
