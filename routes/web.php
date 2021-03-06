<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ApprovalPenggajianController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ChangePasswordController;
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
use App\Http\Controllers\CutiApproveController;
use App\Http\Controllers\CutiApproverController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LabulController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\NavigasiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PengajuanResignController;
use App\Http\Controllers\PenggajianApproverController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResignApproverController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\SlipGajiKaryawanController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::group(['middleware' => 'auth'], function () {
    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

        // biodata
        Route::get('profile/{id}/biodata', [ProfileController::class, 'biodata'])->name('profile.biodata');
        Route::post('profile/biodatas/update', [ProfileController::class, 'biodataUpdate'])->name('profile.biodata_update');

        // medsos
        Route::get('profile/{id}/medsos', [ProfileController::class, 'medsos'])->name('profile.medsos');
        Route::post('profile/medsos/store', [ProfileController::class, 'medsosStore'])->name('profile.medsos_store');
        Route::get('profile/{id}/medsos_delete', [ProfileController::class, 'medsosDelete'])->name('profile.medsos_delete');

        // keluarga sebelum menikah
        Route::get('profile/{id}/sebelum_menikah', [ProfileController::class, 'sebelumMenikah'])->name('profile.sebelum_menikah');
        Route::post('profile/sebelum_menikah/store', [ProfileController::class, 'sebelumMenikahStore'])->name('profile.sebelum_menikah_store');
        Route::get('profile/{id}/sebelum_menikah_delete', [ProfileController::class, 'sebelumMenikahDelete'])->name('profile.sebelum_menikah_delete');

        // keluarga setelah menikah
        Route::get('profile/{id}/setelah_menikah', [ProfileController::class, 'setelahMenikah'])->name('profile.setelah_menikah');
        Route::post('profile/setelah_menikah/store', [ProfileController::class, 'setelahMenikahStore'])->name('profile.setelah_menikah_store');
        Route::get('profile/{id}/setelah_menikah_delete', [ProfileController::class, 'setelahMenikahDelete'])->name('profile.setelah_menikah_delete');

        // kerabata darurat
        Route::get('profile/{id}/kerabat_darurat', [ProfileController::class, 'kerabatDarurat'])->name('profile.kerabat_darurat');
        Route::post('profile/kerabat_darurat/store', [ProfileController::class, 'kerabatDaruratStore'])->name('profile.kerabat_darurat_store');
        Route::get('profile/{id}/kerabat_darurat_delete', [ProfileController::class, 'kerabatDaruratDelete'])->name('profile.kerabat_darurat_delete');

        // pendidikan
        Route::get('profile/{id}/pendidikan', [ProfileController::class, 'pendidikan'])->name('profile.pendidikan');
        Route::post('profile/pendidikan/store', [ProfileController::class, 'pendidikanStore'])->name('profile.pendidikan_store');
        Route::get('profile/{id}/pendidikan_delete', [ProfileController::class, 'pendidikanDelete'])->name('profile.pendidikan_delete');

    // ubah password
    Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change.password.index');
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');
    Route::get('change-password-force', [ChangePasswordController::class, 'force'])->name('change.password.force.index');

    // dashboard hc
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard/{id}/show', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::post('dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');

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

        // navgasi
        Route::get('master/navigasi', [NavigasiController::class, 'index'])->name('navigasi.index');
        Route::post('master/navigasi/main_store', [NavigasiController::class, 'mainStore'])->name('navigasi.main_store');
        Route::get('master/navigasi/{id}/main_edit', [NavigasiController::class, 'mainEdit'])->name('navigasi.main_edit');
        Route::post('master/navigasi/main_update', [NavigasiController::class, 'mainUpdate'])->name('navigasi.main_update');
        Route::get('master/navigasi/{id}/main_delete_btn', [NavigasiController::class, 'mainDeleteBtn'])->name('navigasi.main_delete_btn');
        Route::post('master/navigasi/main_delete', [NavigasiController::class, 'mainDelete'])->name('navigasi.main_delete');

        // navigasi sub
        Route::get('master/navigasi/sub_create', [NavigasiController::class, 'subCreate'])->name('navigasi.sub_create');
        Route::post('master/navigasi/sub_store', [NavigasiController::class, 'subStore'])->name('navigasi.sub_store');
        Route::get('master/navigasi/{id}/sub_edit', [NavigasiController::class, 'subEdit'])->name('navigasi.sub_edit');
        Route::post('master/navigasi/sub_update', [NavigasiController::class, 'subUpdate'])->name('navigasi.sub_update');
        Route::get('master/navigasi/{id}/sub_delete_btn', [NavigasiController::class, 'subDeleteBtn'])->name('navigasi.sub_delete_btn');
        Route::post('master/navigasi/sub_delete', [NavigasiController::class, 'subDelete'])->name('navigasi.sub_delete');

        // navigasi tombol
        Route::get('master/navigasi/tombol_create', [NavigasiController::class, 'tombolCreate'])->name('navigasi.tombol_create');
        Route::post('master/navigasi/tombol_store', [NavigasiController::class, 'tombolStore'])->name('navigasi.tombol_store');
        Route::get('master/navigasi/{id}/tombol_edit', [NavigasiController::class, 'tombolEdit'])->name('navigasi.tombol_edit');
        Route::post('master/navigasi/tombol_update', [NavigasiController::class, 'tombolUpdate'])->name('navigasi.tombol_update');
        Route::get('master/navigasi/{id}/tombol_delete_btn', [NavigasiController::class, 'tombolDeleteBtn'])->name('navigasi.tombol_delete_btn');
        Route::post('master/navigasi/tombol_delete', [NavigasiController::class, 'tombolDelete'])->name('navigasi.tombol_delete');

        // user
        Route::get('master/user', [UserController::class, 'index'])->name('user.index');
        Route::get('master/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('master/user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('master/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('master/user/{id}/access', [UserController::class, 'access'])->name('user.access');
        Route::post('master/user/access_store', [UserController::class, 'accessStore'])->name('user.access_store');
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

        // role
        Route::get('master/role', [RoleController::class, 'index'])->name('role.index');
        Route::post('master/role/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('master/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('master/role/update', [RoleController::class, 'update'])->name('role.update');
        Route::get('master/role/{id}/delete_btn', [RoleController::class, 'deleteBtn'])->name('role.delete_btn');
        Route::post('master/role/delete', [RoleController::class, 'delete'])->name('role.delete');
        Route::post('master/role/update_hirarki', [RoleController::class, 'updateHirarki'])->name('role.update_hirarki');

        // loker
        Route::get('master/loker', [LokerController::class, 'index'])->name('loker.index');
        Route::get('master/loker/create', [LokerController::class, 'create'])->name('loker.create');
        Route::post('master/loker/store', [LokerController::class, 'store'])->name('loker.store');
        Route::get('master/loker/{id}/show', [LokerController::class, 'show'])->name('loker.show');
        Route::get('master/loker/{id}/edit', [LokerController::class, 'edit'])->name('loker.edit');
        Route::post('master/loker/update', [LokerController::class, 'update'])->name('loker.update');
        Route::get('master/loker/{id}/delete_btn', [LokerController::class, 'deleteBtn'])->name('loker.delete_btn');
        Route::post('master/loker/delete', [LokerController::class, 'delete'])->name('loker.delete');
        Route::put('master/loker/{id}/publish', [LokerController::class, 'publish'])->name('loker.publish');

        // cuti approver
        Route::get('master/cuti_approver', [CutiApproverController::class, 'index'])->name('cuti_approver.index');
        Route::get('master/cuti_approver/get_cuti', [CutiApproverController::class, 'getCuti'])->name('cuti_approver.get_cuti');
        Route::get('master/cuti_approver/create', [CutiApproverController::class, 'create'])->name('cuti_approver.create');
        Route::post('master/cuti_approver/store', [CutiApproverController::class, 'store'])->name('cuti_approver.store');
        Route::post('master/cuti_approver/update_approver', [CutiApproverController::class, 'updateApprover'])->name('cuti_approver.update_approver');
        Route::post('master/cuti_approver/add_approver', [CutiApproverController::class, 'addApprover'])->name('cuti_approver.add_approver');
        Route::get('master/cuti_approver/{id}/delete_btn', [CutiApproverController::class, 'deleteBtn'])->name('cuti_approver.delete_btn');
        Route::post('master/cuti_approver/delete', [CutiApproverController::class, 'delete'])->name('cuti_approver.delete');
        Route::get('master/cuti_approver/{id}/delete_btn_approver', [CutiApproverController::class, 'deleteBtnApprover'])->name('cuti_approver.delete_btn_approver');
        Route::post('master/cuti_approver/delete_approver', [CutiApproverController::class, 'deleteApprover'])->name('cuti_approver.delete_approver');

        // resign approver
        Route::get('master/resign_approver', [ResignApproverController::class, 'index'])->name('resign_approver.index');
        Route::get('master/resign_approver/get_resign', [ResignApproverController::class, 'getResign'])->name('resign_approver.get_resign');
        Route::get('master/resign_approver/create', [ResignApproverController::class, 'create'])->name('resign_approver.create');
        Route::post('master/resign_approver/store', [ResignApproverController::class, 'store'])->name('resign_approver.store');
        Route::post('master/resign_approver/update_approver', [ResignApproverController::class, 'updateApprover'])->name('resign_approver.update_approver');
        Route::post('master/resign_approver/add_approver', [ResignApproverController::class, 'addApprover'])->name('resign_approver.add_approver');
        Route::get('master/resign_approver/{id}/delete_btn', [ResignApproverController::class, 'deleteBtn'])->name('resign_approver.delete_btn');
        Route::post('master/resign_approver/delete', [ResignApproverController::class, 'delete'])->name('resign_approver.delete');
        Route::get('master/resign_approver/{id}/delete_btn_approver', [ResignApproverController::class, 'deleteBtnApprover'])->name('resign_approver.delete_btn_approver');
        Route::post('master/resign_approver/delete_approver', [ResignApproverController::class, 'deleteApprover'])->name('resign_approver.delete_approver');

        // penggajian approver
        Route::get('master/penggajian_approver', [PenggajianApproverController::class, 'index'])->name('penggajian_approver.index');
        Route::get('master/penggajian_approver/get_penggajian', [PenggajianApproverController::class, 'getPenggajian'])->name('penggajian_approver.get_penggajian');
        Route::get('master/penggajian_approver/create', [PenggajianApproverController::class, 'create'])->name('penggajian_approver.create');
        Route::post('master/penggajian_approver/store', [PenggajianApproverController::class, 'store'])->name('penggajian_approver.store');
        Route::post('master/penggajian_approver/update_approver', [PenggajianApproverController::class, 'updateApprover'])->name('penggajian_approver.update_approver');
        Route::post('master/penggajian_approver/add_approver', [PenggajianApproverController::class, 'addApprover'])->name('penggajian_approver.add_approver');
        Route::get('master/penggajian_approver/{id}/delete_btn', [PenggajianApproverController::class, 'deleteBtn'])->name('penggajian_approver.delete_btn');
        Route::post('master/penggajian_approver/delete', [PenggajianApproverController::class, 'delete'])->name('penggajian_approver.delete');
        Route::get('master/penggajian_approver/{id}/delete_btn_approver', [PenggajianApproverController::class, 'deleteBtnApprover'])->name('penggajian_approver.delete_btn_approver');
        Route::post('master/penggajian_approver/delete_approver', [PenggajianApproverController::class, 'deleteApprover'])->name('penggajian_approver.delete_approver');

    // karyawan
    Route::resource('karyawan', MasterKaryawanController::class);
    Route::get('karyawan/{id}/delete_btn', [MasterKaryawanController::class, 'deleteBtn'])->name('karyawan.delete_btn');
    Route::post('karyawan/delete', [MasterKaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/ubah_status', [MasterKaryawanController::class, 'ubahStatus'])->name('karyawan.ubah_status');
    Route::put('karyawan/{id}/update_foto', [MasterKaryawanController::class, 'updateFoto'])->name('karyawan.update_foto');
    Route::post('karyawan/karyawan_store', [MasterKaryawanController::class, 'karyawanStore'])->name('karyawan.karyawan_store');

        // biodata
        Route::get('karyawan/{id}/biodata', [MasterKaryawanController::class, 'biodata'])->name('karyawan.biodata');
        Route::post('karyawan/biodatas/update', [MasterKaryawanController::class, 'biodataUpdate'])->name('karyawan.biodata_update');

        // kontrak
        Route::get('karyawan/{id}/kontrak', [MasterKaryawanController::class, 'kontrak'])->name('karyawan.kontrak');
        Route::post('karyawan/kontrak/store', [MasterKaryawanController::class, 'kontrakStore'])->name('karyawan.kontrak_store');
        Route::get('karyawan/{id}/kontrak_delete', [MasterKaryawanController::class, 'kontrakDelete'])->name('karyawan.kontrak_delete');

        // medsos
        Route::get('karyawan/{id}/medsos', [MasterKaryawanController::class, 'medsos'])->name('karyawan.medsos');
        Route::post('karyawan/medsos/store', [MasterKaryawanController::class, 'medsosStore'])->name('karyawan.medsos_store');
        Route::get('karyawan/{id}/medsos_delete', [MasterKaryawanController::class, 'medsosDelete'])->name('karyawan.medsos_delete');

        // keluarga sebelum menikah
        Route::get('karyawan/{id}/sebelum_menikah', [MasterKaryawanController::class, 'sebelumMenikah'])->name('karyawan.sebelum_menikah');
        Route::post('karyawan/sebelum_menikah/store', [MasterKaryawanController::class, 'sebelumMenikahStore'])->name('karyawan.sebelum_menikah_store');
        Route::get('karyawan/{id}/sebelum_menikah_delete', [MasterKaryawanController::class, 'sebelumMenikahDelete'])->name('karyawan.sebelum_menikah_delete');

        // keluarga setelah menikah
        Route::get('karyawan/{id}/setelah_menikah', [MasterKaryawanController::class, 'setelahMenikah'])->name('karyawan.setelah_menikah');
        Route::post('karyawan/setelah_menikah/store', [MasterKaryawanController::class, 'setelahMenikahStore'])->name('karyawan.setelah_menikah_store');
        Route::get('karyawan/{id}/setelah_menikah_delete', [MasterKaryawanController::class, 'setelahMenikahDelete'])->name('karyawan.setelah_menikah_delete');

        // kerabata darurat
        Route::get('karyawan/{id}/kerabat_darurat', [MasterKaryawanController::class, 'kerabatDarurat'])->name('karyawan.kerabat_darurat');
        Route::post('karyawan/kerabat_darurat/store', [MasterKaryawanController::class, 'kerabatDaruratStore'])->name('karyawan.kerabat_darurat_store');
        Route::get('karyawan/{id}/kerabat_darurat_delete', [MasterKaryawanController::class, 'kerabatDaruratDelete'])->name('karyawan.kerabat_darurat_delete');

        // pendidikan
        Route::get('karyawan/{id}/pendidikan', [MasterKaryawanController::class, 'pendidikan'])->name('karyawan.pendidikan');
        Route::post('karyawan/pendidikan/store', [MasterKaryawanController::class, 'pendidikanStore'])->name('karyawan.pendidikan_store');
        Route::get('karyawan/{id}/pendidikan_delete', [MasterKaryawanController::class, 'pendidikanDelete'])->name('karyawan.pendidikan_delete');

    // cuti
    Route::get('cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('cuti/create', [CutiController::class, 'create'])->name('cuti.create');
    Route::post('cuti/store', [CutiController::class, 'store'])->name('cuti.store');
    Route::get('cuti/{id}/show', [CutiController::class, 'show'])->name('cuti.show');
    Route::get('cuti/{id}/delete_btn', [CutiController::class, 'deleteBtn'])->name('cuti.delete_btn');
    Route::post('cuti/delete', [CutiController::class, 'delete'])->name('cuti.delete');
    Route::get('cuti/{id}/atasan_approve', [CutiController::class, 'atasanApprove'])->name('cuti.atasan_approve');
    Route::get('cuti/{id}/atasan_tolak', [CutiController::class, 'atasanTolak'])->name('cuti.atasan_tolak');
    Route::get('cuti/{id}/hc_approve', [CutiController::class, 'hcApprove'])->name('cuti.hc_approve');
    Route::get('cuti/{id}/hc_tolak', [CutiController::class, 'hcTolak'])->name('cuti.hc_tolak');
    Route::get('cuti/{id}/approved', [CutiController::class, 'approved'])->name('cuti.approved');
    Route::get('cuti/{id}/disapproved', [CutiController::class, 'disapproved'])->name('cuti.disapproved');

    // resign
    Route::get('resign', [ResignController::class, 'index'])->name('resign.index');
    Route::get('resign/create', [ResignController::class, 'create'])->name('resign.create');
    Route::post('resign/store', [ResignController::class, 'store'])->name('resign.store');
    Route::get('resign/{id}/show', [ResignController::class, 'show'])->name('resign.show');
    Route::get('resign/{id}/delete_btn', [ResignController::class, 'deleteBtn'])->name('resign.delete_btn');
    Route::post('resign/delete', [ResignController::class, 'delete'])->name('resign.delete');
    Route::get('resign/{id}/resign_approved', [ResignController::class, 'resignApproved'])->name('resign.resign_approved');
    Route::get('resign/{id}/resign_disapproved', [ResignController::class, 'resignDisapproved'])->name('resign.resign_disapproved');
    Route::get('resign/{id}/paklaring', [ResignController::class, 'paklaring'])->name('resign.paklaring');

    // approval
    Route::get('approval', [ApprovalController::class, 'index'])->name('approval.index');
    Route::get('approval/{id}/show', [ApprovalController::class, 'show'])->name('approval.show');
    Route::get('approval/{id}/approved', [ApprovalController::class, 'approved'])->name('approval.approved');
    Route::get('approval/{id}/disapproved', [ApprovalController::class, 'disapproved'])->name('approval.disapproved');
    Route::get('approval/{id}/resign_approved', [ApprovalController::class, 'resignApproved'])->name('approval.resign_approved');
    Route::get('approval/{id}/resign_disapproved', [ApprovalController::class, 'resignDisapproved'])->name('approval.resign_disapproved');
    Route::get('approval/{id}/resign_show', [ApprovalController::class, 'resignShow'])->name('approval.resign_show');

    // approval penggajian
    Route::get('approval_penggajian', [ApprovalPenggajianController::class, 'index'])->name('approval_penggajian.index');
    Route::get('approval_penggajian/{id}/show', [ApprovalPenggajianController::class, 'show'])->name('approval_penggajian.show');
    Route::get('approval_penggajian/{id}/approved', [ApprovalPenggajianController::class, 'approved'])->name('approval_penggajian.approved');
    Route::post('approval_penggajian/disapproved', [ApprovalPenggajianController::class, 'disapproved'])->name('approval_penggajian.disapproved');

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
    Route::post('penggajian/store', [PenggajianController::class, 'store'])->name('penggajian.store');
    Route::get('penggajian/{id}/delete_btn', [PenggajianController::class, 'deleteBtn'])->name('penggajian.delete_btn');
    Route::post('penggajian/delete', [PenggajianController::class, 'delete'])->name('penggajian.delete');
    Route::get('penggajian/{id}/approved', [PenggajianController::class, 'approved'])->name('penggajian.approved');
    Route::post('penggajian/disapproved', [PenggajianController::class, 'disapproved'])->name('penggajian.disapproved');

    // slip gaji
    Route::get('slip_gaji', [SlipGajiController::class, 'index'])->name('slip_gaji.index');
    Route::get('slip_gaji/template', [SlipGajiController::class, 'template'])->name('slip_gaji.template');
    Route::get('slip_gaji/update_template', [SlipGajiController::class, 'updateTemplate'])->name('slip_gaji.update_template');
    Route::get('slip_gaji/update_template/create', [SlipGajiController::class, 'updateTemplateCreate'])->name('slip_gaji.update_template.create');
    Route::post('slip_gaji/update_template/store', [SlipGajiController::class, 'updateTemplateStore'])->name('slip_gaji.update_template.store');
    Route::post('slip_gaji/update_template/delete', [SlipGajiController::class, 'updateTemplateDelete'])->name('slip_gaji.update_template.delete');
    Route::get('slip_gaji/export', [SlipGajiController::class, 'export'])->name('slip_gaji.export');
    Route::post('slip_gaji/import', [SlipGajiController::class, 'import'])->name('slip_gaji.import');
    Route::get('slip_gaji/{id}/edit', [SlipGajiController::class, 'edit'])->name('slip_gaji.edit');
    Route::post('slip_gaji/update', [SlipGajiController::class, 'update'])->name('slip_gaji.update');
    Route::get('slip_gaji/{id}/delete', [SlipGajiController::class, 'delete'])->name('slip_gaji.delete');
    Route::get('slip_gaji/{id}/cetak_pdf', [SlipGajiController::class, 'cetakPdf'])->name('slip_gaji.cetak_pdf');
    Route::get('slip_gaji/{id}/cetak_pdf_karyawan', [SlipGajiController::class, 'cetakPdfKaryawan'])->name('slip_gaji.cetak_pdf_karyawan');

    // slip gaji karyawan
    Route::get('slip_gaji_karyawan', [SlipGajiKaryawanController::class, 'index'])->name('slip_gaji_karyawan.index');
    Route::get('slip_gaji_karyawan/{id}/cetak_pdf', [SlipGajiKaryawanController::class, 'cetakPdf'])->name('slip_gaji_karyawan.cetak_pdf');

    // training
    Route::get('training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::get('training/{id}/show', [TrainingController::class, 'show'])->name('training.show');
    Route::post('training/store', [TrainingController::class, 'store'])->name('training.store');
    Route::get('training/{id}/edit', [TrainingController::class, 'edit'])->name('training.edit');
    Route::post('training/update', [TrainingController::class, 'update'])->name('training.update');
    Route::get('training/{id}/delete_btn', [TrainingController::class, 'deleteBtn'])->name('training.delete_btn');
    Route::post('training/delete', [TrainingController::class, 'delete'])->name('training.delete');
    Route::get('training/modul/{file_modul}', [TrainingController::class, 'modul'])->name('training.modul');

    // pengajuan
        // cuti
        Route::get('pengajuan/cuti', [PengajuanCutiController::class, 'index'])->name('pengajuan_cuti.index');
        Route::get('pengajuan/cuti/create', [PengajuanCutiController::class, 'create'])->name('pengajuan_cuti.create');
        Route::post('pengajuan/cuti/store', [PengajuanCutiController::class, 'store'])->name('pengajuan_cuti.store');

        // resign
        Route::get('pengajuan/resign', [PengajuanResignController::class, 'index'])->name('pengajuan_resign.index');
        Route::get('pengajuan/resign/create', [PengajuanResignController::class, 'create'])->name('pengajuan_resign.create');
        Route::post('pengajuan/resign/store', [PengajuanResignController::class, 'store'])->name('pengajuan_resign.store');

    // complaint
    Route::get('complaint', [ComplaintController::class, 'index'])->name('complaint.index');
    Route::get('complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
    Route::post('complaint/store', [ComplaintController::class, 'store'])->name('complaint.store');
    Route::get('complaint/{id}/edit', [ComplaintController::class, 'edit'])->name('complaint.edit');
    Route::post('complaint/update', [ComplaintController::class, 'update'])->name('complaint.update');
    Route::get('complaint/{id}/delete_btn', [ComplaintController::class, 'deleteBtn'])->name('complaint.delete_btn');
    Route::post('complaint/delete', [ComplaintController::class, 'delete'])->name('complaint.delete');

    // labul
    Route::get('labul/input', [LabulController::class, 'input'])->name('labul.input');
    Route::get('labul/input/activity_plan', [LabulController::class, 'inputActivityPlan'])->name('labul.input.activity_plan');
    Route::post('labul/input/activity_plan/store', [LabulController::class, 'inputActivityPlanStore'])->name('labul.input.activity_plan.store');

    Route::get('labul/input/data_member', [LabulController::class, 'inputDataMember'])->name('labul.input.data_member');
    Route::post('labul/input/data_member/store', [LabulController::class, 'inputDataMemberStore'])->name('labul.input.data_member.store');

    Route::get('labul/input/reseller', [LabulController::class, 'inputReseller'])->name('labul.input.reseller');
    Route::post('labul/input/reseller/store', [LabulController::class, 'inputResellerStore'])->name('labul.input.reseller.store');

    Route::get('labul/input/data_reseller', [LabulController::class, 'inputDataReseller'])->name('labul.input.data_reseller');
    Route::post('labul/input/data_reseller/store', [LabulController::class, 'inputDataResellerStore'])->name('labul.input.data_reseller.store');

    Route::get('labul/input/instansi', [LabulController::class, 'inputInstansi'])->name('labul.input.instansi');
    Route::post('labul/input/instansi/store', [LabulController::class, 'inputInstansiStore'])->name('labul.input.instansi.store');

    Route::get('labul/input/survey_kompetitor', [LabulController::class, 'inputSurveyKompetitor'])->name('labul.input.survey_kompetitor');
    Route::post('labul/input/survey_kompetitor/store', [LabulController::class, 'inputSurveyKompetitorStore'])->name('labul.input.survey_kompetitor.store');

    Route::get('labul/input/komplain', [LabulController::class, 'inputKomplain'])->name('labul.input.komplain');
    Route::post('labul/input/komplain/store', [LabulController::class, 'inputKomplainStore'])->name('labul.input.komplain.store');

    Route::get('labul/input/data_instansi', [LabulController::class, 'inputDataInstansi'])->name('labul.input.data_instansi');
    Route::post('labul/input/data_instansi/store', [LabulController::class, 'inputDataInstansiStore'])->name('labul.input.data_instansi.store');

    Route::get('labul/input/reqor', [LabulController::class, 'inputReqor'])->name('labul.input.reqor');
    Route::post('labul/input/reqor/store', [LabulController::class, 'inputReqorStore'])->name('labul.input.reqor.store');

    Route::get('labul/input/omzet_cabang', [LabulController::class, 'inputOmzetCabang'])->name('labul.input.omzet_cabang');
    Route::post('labul/input/omzet_cabang/store', [LabulController::class, 'inputOmzetCabangStore'])->name('labul.input.omzet_cabang.store');

    Route::get('labul/result', [LabulController::class, 'result'])->name('labul.result');
    Route::get('labul/result/export_activity_plan', [LabulController::class, 'resultExportActivityPlan'])->name('labul.result.export_activity_plan');
    Route::get('labul/result/export_data_instansi', [LabulController::class, 'resultExportDataInstansi'])->name('labul.result.export_data_instansi');
    Route::get('labul/result/export_data_member', [LabulController::class, 'resultExportDataMember'])->name('labul.result.export_data_member');
    Route::get('labul/result/export_data_reseller', [LabulController::class, 'resultExportDataReseller'])->name('labul.result.export_data_reseller');
    Route::get('labul/result/export_instansi', [LabulController::class, 'resultExportInstansi'])->name('labul.result.export_instansi');
    Route::get('labul/result/export_komplain', [LabulController::class, 'resultExportKomplain'])->name('labul.result.export_komplain');
    Route::get('labul/result/export_omzet', [LabulController::class, 'resultExportOmzet'])->name('labul.result.export_omzet');
    Route::get('labul/result/export_reqor', [LabulController::class, 'resultExportReqor'])->name('labul.result.export_reqor');
    Route::get('labul/result/export_reseller', [LabulController::class, 'resultExportReseller'])->name('labul.result.export_reseller');
    Route::get('labul/result/export_survey_kompetitor', [LabulController::class, 'resultExportSurveyKompetitor'])->name('labul.result.export_survey_kompetitor');

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
