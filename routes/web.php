<?php

use App\Http\Controllers\AbdulController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ApprovalPenggajianController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComproController;
use App\Http\Controllers\CutiApproveController;
use App\Http\Controllers\CutiApproverController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HcCirController;
use App\Http\Controllers\HcLamaranController;
use App\Http\Controllers\HcLokerController;
use App\Http\Controllers\HcTrainingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\LabulController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MasterCabangController;
use App\Http\Controllers\MasterDivisiController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterKaryawanController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\NavigasiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PengajuanResignController;
use App\Http\Controllers\PenggajianApproverController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResignApproverController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\SlipGajiKaryawanController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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
    Route::get('dashboard/getTotalKaryawanPerBulan', [DashboardController::class, 'getTotalKaryawanPerBulan'])->name('dashboard.getTotalKaryawanPerBulan');
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
    Route::get('karyawan/{id}/resetpassword_btn', [MasterKaryawanController::class, 'resetPasswordBtn'])->name('karyawan.resetpassword_btn');
    Route::post('karyawan/resetpassword', [MasterKaryawanController::class, 'resetPassword'])->name('karyawan.resetpassword');
    Route::post('karyawan/filter', [MasterKaryawanController::class, 'filter'])->name('karyawan.filter');

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

        // histori jabatan
        Route::post('karyawan/histori_jabatan', [MasterKaryawanController::class, 'historiJabatanStore'])->name('karyawan.histori.jabatan.store');
        Route::get('karyawan/histori_jabatan/{id}/hapus', [MasterKaryawanController::class, 'historiJabatanDelete'])->name('karyawan.histori.jabatan.delete');

    // cuti
    Route::get('cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('cuti/create', [CutiController::class, 'create'])->name('cuti.create');
    Route::post('cuti/store', [CutiController::class, 'store'])->name('cuti.store');
    Route::get('cuti/{id}/show', [CutiController::class, 'show'])->name('cuti.show');
    Route::get('cuti/{id}/delete_btn', [CutiController::class, 'deleteBtn'])->name('cuti.delete_btn');
    Route::post('cuti/delete', [CutiController::class, 'delete'])->name('cuti.delete');
    // Route::get('cuti/{id}/atasan_approve', [CutiController::class, 'atasanApprove'])->name('cuti.atasan_approve');
    // Route::get('cuti/{id}/atasan_tolak', [CutiController::class, 'atasanTolak'])->name('cuti.atasan_tolak');
    // Route::get('cuti/{id}/hc_approve', [CutiController::class, 'hcApprove'])->name('cuti.hc_approve');
    // Route::get('cuti/{id}/hc_tolak', [CutiController::class, 'hcTolak'])->name('cuti.hc_tolak');
    Route::post('cuti/approved', [CutiController::class, 'approved'])->name('cuti.approved');
    Route::post('cuti/disapproved', [CutiController::class, 'disapproved'])->name('cuti.disapproved');
    Route::post('cuti/detailApprover', [CutiController::class, 'detailApprover'])->name('cuti.detailApprover');

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
    Route::post('resign/approved', [ResignController::class, 'approved'])->name('resign.approved');
    Route::post('resign/disapproved', [ResignController::class, 'disapproved'])->name('resign.disapproved');
    Route::post('resign/detailApprover', [ResignController::class, 'detailApprover'])->name('resign.detailApprover');

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
    Route::post('penggajian/approved', [PenggajianController::class, 'approved'])->name('penggajian.approved');
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
    Route::get('training', [TrainingController::class, 'index'])->name('training');
    // Route::get('training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::get('training/{id}/show', [TrainingController::class, 'show'])->name('training.show');
    Route::post('training/store', [TrainingController::class, 'store'])->name('training.store');
    Route::get('training/{id}/edit', [TrainingController::class, 'edit'])->name('training.edit');
    Route::post('training/update', [TrainingController::class, 'update'])->name('training.update');
    Route::get('training/{id}/delete', [TrainingController::class, 'delete'])->name('training.delete');
    Route::get('training/getKaryawan', [TrainingController::class, 'getKaryawan'])->name('training.getKaryawan');
    Route::get('training/getModul', [TrainingController::class, 'getModul'])->name('training.getModul');
    Route::get('training/modul', [TrainingController::class, 'moduls'])->name('training.moduls');
    Route::get('training/modul/create', [TrainingController::class, 'modulCreate'])->name('training.modul.create');
    Route::post('training/modul/store', [TrainingController::class, 'modulStore'])->name('training.modul.store');
    Route::get('training/modul/{id}/edit', [TrainingController::class, 'modulEdit'])->name('training.modul.edit');
    Route::put('training/modul/{id}/update', [TrainingController::class, 'modulUpdate'])->name('training.modul.update');
    Route::get('training/modul/{id}/delete', [TrainingController::class, 'modulDelete'])->name('training.modul.delete');
    Route::post('training/laporan', [TrainingController::class, 'laporan'])->name('training.laporan');
    // Route::get('training/{id}/delete_btn', [TrainingController::class, 'deleteBtn'])->name('training.delete_btn');
    // Route::post('training/delete', [TrainingController::class, 'delete'])->name('training.delete');
    // Route::get('training/modul/{file_modul}', [TrainingController::class, 'modul'])->name('training.modul');

    // training training
    // Route::get('training/training', [TrainingController::class, 'training'])->name('training');
    // Route::get('training/training/create', [TrainingController::class, 'trainingCreate'])->name('training.training.create');
    // Route::get('training/training/getKaryawan', [TrainingController::class, 'getKaryawan'])->name('training.getKaryawan');
    // Route::get('training/training/getModul', [TrainingController::class, 'getModul'])->name('training.getModul');
    // Route::post('training/training/store', [TrainingController::class, 'trainingStore'])->name('training.training.store');
    // Route::get('training/training/{id}/show', [TrainingController::class, 'trainingShow'])->name('training.training.show');
    // Route::get('training/training/{id}/edit', [TrainingController::class, 'trainingEdit'])->name('training.training.edit');
    // Route::put('training/training/{id}/update', [TrainingController::class, 'trainingUpdate'])->name('training.training.update');
    // Route::get('training/training/{id}/delete', [TrainingController::class, 'trainingDelete'])->name('training.training.delete');
    // Route::get('training/training/modul', [TrainingController::class, 'moduls'])->name('training.moduls');
    // Route::get('training/training/modul/create', [TrainingController::class, 'modulCreate'])->name('training.modul.create');
    // Route::post('training/training/modul/store', [TrainingController::class, 'modulStore'])->name('training.modul.store');
    // Route::get('training/training/modul/{id}/edit', [TrainingController::class, 'modulEdit'])->name('training.modul.edit');
    // Route::put('training/training/modul/{id}/update', [TrainingController::class, 'modulUpdate'])->name('training.modul.update');
    // Route::get('training/training/modul/{id}/delete', [TrainingController::class, 'modulDelete'])->name('training.modul.delete');

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
    Route::get('labul/input/omzet_cabang/form', [LabulController::class, 'inputOmzetCabangForm'])->name('labul.input.omzet_cabang.form');
    Route::post('labul/input/omzet_cabang/store', [LabulController::class, 'inputOmzetCabangStore'])->name('labul.input.omzet_cabang.store');

    Route::get('labul/result', [LabulController::class, 'result'])->name('labul.result');

    Route::post('labul/result/export_activity_plan', [LabulController::class, 'resultExportActivityPlan'])->name('labul.result.export_activity_plan');
    Route::get('labul/result/activity_plan/{id}/detail', [LabulController::class, 'resultActivityPlanDetail'])->name('labul.result.activity_plan.detail');
    Route::get('labul/result/activity_plan/{id}/edit', [LabulController::class, 'resultActivityPlanEdit'])->name('labul.result.activity_plan.edit');
    Route::put('labul/result/activity_plan/{id}/update', [LabulController::class, 'resultActivityPlanUpdate'])->name('labul.result.activity_plan.update');
    Route::post('labul/result/activity_plan/delete', [LabulController::class, 'resultActivityPlanDelete'])->name('labul.result.activity_plan.delete');
    Route::post('labul/result/activity_plan/cari', [LabulController::class, 'resultActivityPlanCari'])->name('labul.result.activity_plan.cari');

    Route::post('labul/result/export_data_instansi', [LabulController::class, 'resultExportDataInstansi'])->name('labul.result.export_data_instansi');
    Route::get('labul/result/data_instansi/{id}/detail', [LabulController::class, 'resultDataInstansiDetail'])->name('labul.result.data_instansi.detail');
    Route::get('labul/result/data_instansi/{id}/edit', [LabulController::class, 'resultDataInstansiEdit'])->name('labul.result.data_instansi.edit');
    Route::put('labul/result/data_instansi/{id}/update', [LabulController::class, 'resultDataInstansiUpdate'])->name('labul.result.data_instansi.update');
    Route::post('labul/result/data_instansi/delete', [LabulController::class, 'resultDataInstansiDelete'])->name('labul.result.data_instansi.delete');
    Route::post('labul/result/data_instansi/cari', [LabulController::class, 'resultDataInstansiCari'])->name('labul.result.data_instansi.cari');

    Route::post('labul/result/export_data_member', [LabulController::class, 'resultExportDataMember'])->name('labul.result.export_data_member');
    Route::get('labul/result/data_member/{id}/detail', [LabulController::class, 'resultDataMemberDetail'])->name('labul.result.data_member.detail');
    Route::get('labul/result/data_member/{id}/edit', [LabulController::class, 'resultDataMemberEdit'])->name('labul.result.data_member.edit');
    Route::put('labul/result/data_member/{id}/update', [LabulController::class, 'resultDataMemberUpdate'])->name('labul.result.data_member.update');
    Route::post('labul/result/data_member/delete', [LabulController::class, 'resultDataMemberDelete'])->name('labul.result.data_member.delete');
    Route::post('labul/result/data_member/cari', [LabulController::class, 'resultDataMemberCari'])->name('labul.result.data_member.cari');

    Route::post('labul/result/export_data_reseller', [LabulController::class, 'resultExportDataReseller'])->name('labul.result.export_data_reseller');
    Route::get('labul/result/data_reseller/{id}/detail', [LabulController::class, 'resultDataResellerDetail'])->name('labul.result.data_reseller.detail');
    Route::get('labul/result/data_reseller/{id}/edit', [LabulController::class, 'resultDataResellerEdit'])->name('labul.result.data_reseller.edit');
    Route::put('labul/result/data_reseller/{id}/update', [LabulController::class, 'resultDataResellerUpdate'])->name('labul.result.data_reseller.update');
    Route::post('labul/result/data_reseller/delete', [LabulController::class, 'resultDataResellerDelete'])->name('labul.result.data_reseller.delete');
    Route::post('labul/result/data_reseller/cari', [LabulController::class, 'resultDataResellerCari'])->name('labul.result.data_reseller.cari');

    Route::post('labul/result/export_instansi', [LabulController::class, 'resultExportInstansi'])->name('labul.result.export_instansi');
    Route::get('labul/result/instansi/{id}/detail', [LabulController::class, 'resultInstansiDetail'])->name('labul.result.instansi.detail');
    Route::get('labul/result/instansi/{id}/edit', [LabulController::class, 'resultInstansiEdit'])->name('labul.result.instansi.edit');
    Route::put('labul/result/instansi/{id}/update', [LabulController::class, 'resultInstansiUpdate'])->name('labul.result.instansi.update');
    Route::post('labul/result/instansi/delete', [LabulController::class, 'resultInstansiDelete'])->name('labul.result.instansi.delete');
    Route::post('labul/result/instansi/cari', [LabulController::class, 'resultInstansiCari'])->name('labul.result.instansi.cari');

    Route::post('labul/result/export_komplain', [LabulController::class, 'resultExportKomplain'])->name('labul.result.export_komplain');
    Route::get('labul/result/komplain/{id}/detail', [LabulController::class, 'resultKomplainDetail'])->name('labul.result.komplain.detail');
    Route::get('labul/result/komplain/{id}/edit', [LabulController::class, 'resultKomplainEdit'])->name('labul.result.komplain.edit');
    Route::put('labul/result/komplain/{id}/update', [LabulController::class, 'resultKomplainUpdate'])->name('labul.result.komplain.update');
    Route::post('labul/result/komplain/delete', [LabulController::class, 'resultKomplainDelete'])->name('labul.result.komplain.delete');
    Route::post('labul/result/komplain/cari', [LabulController::class, 'resultKomplainCari'])->name('labul.result.komplain.cari');

    Route::post('labul/result/export_omzet', [LabulController::class, 'resultExportOmzet'])->name('labul.result.export_omzet');
    Route::get('labul/result/omzet/{id}/detail', [LabulController::class, 'resultOmzetDetail'])->name('labul.result.omzet.detail');
    Route::get('labul/result/omzet/{id}/edit', [LabulController::class, 'resultOmzetEdit'])->name('labul.result.omzet.edit');
    Route::put('labul/result/omzet/{id}/update', [LabulController::class, 'resultOmzetUpdate'])->name('labul.result.omzet.update');
    Route::post('labul/result/omzet/delete', [LabulController::class, 'resultOmzetDelete'])->name('labul.result.omzet.delete');
    Route::post('labul/result/omzet/cari', [LabulController::class, 'resultOmzetCari'])->name('labul.result.omzet.cari');

    Route::post('labul/result/export_reqor', [LabulController::class, 'resultExportReqor'])->name('labul.result.export_reqor');
    Route::get('labul/result/reqor/{id}/detail', [LabulController::class, 'resultReqorDetail'])->name('labul.result.reqor.detail');
    Route::get('labul/result/reqor/{id}/edit', [LabulController::class, 'resultReqorEdit'])->name('labul.result.reqor.edit');
    Route::put('labul/result/reqor/{id}/update', [LabulController::class, 'resultReqorUpdate'])->name('labul.result.reqor.update');
    Route::post('labul/result/reqor/delete', [LabulController::class, 'resultReqorDelete'])->name('labul.result.reqor.delete');
    Route::post('labul/result/reqor/cari', [LabulController::class, 'resultReqorCari'])->name('labul.result.reqor.cari');

    Route::post('labul/result/export_reseller', [LabulController::class, 'resultExportReseller'])->name('labul.result.export_reseller');
    Route::get('labul/result/reseller/{id}/detail', [LabulController::class, 'resultResellerDetail'])->name('labul.result.reseller.detail');
    Route::get('labul/result/reseller/{id}/edit', [LabulController::class, 'resultResellerEdit'])->name('labul.result.reseller.edit');
    Route::put('labul/result/reseller/{id}/update', [LabulController::class, 'resultResellerUpdate'])->name('labul.result.reseller.update');
    Route::post('labul/result/reseller/delete', [LabulController::class, 'resultResellerDelete'])->name('labul.result.reseller.delete');
    Route::post('labul/result/reseller/cari', [LabulController::class, 'resultResellerCari'])->name('labul.result.reseller.cari');

    Route::post('labul/result/export_survey_kompetitor', [LabulController::class, 'resultExportSurveyKompetitor'])->name('labul.result.export_survey_kompetitor');
    Route::get('labul/result/survey_kompetitor/{id}/detail', [LabulController::class, 'resultSurveyKompetitorDetail'])->name('labul.result.survey_kompetitor.detail');
    Route::get('labul/result/survey_kompetitor/{id}/edit', [LabulController::class, 'resultSurveyKompetitorEdit'])->name('labul.result.survey_kompetitor.edit');
    Route::put('labul/result/survey_kompetitor/{id}/update', [LabulController::class, 'resultSurveyKompetitorUpdate'])->name('labul.result.survey_kompetitor.update');
    Route::post('labul/result/survey_kompetitor/delete', [LabulController::class, 'resultSurveyKompetitorDelete'])->name('labul.result.survey_kompetitor.delete');
    Route::post('labul/result/survey_kompetitor/cari', [LabulController::class, 'resultSurveyKompetitorCari'])->name('labul.result.survey_kompetitor.cari');

    // compro tentang
    Route::get('compro/tentang', [ComproController::class, 'tentang'])->name('compro.tentang');
    Route::post('compro/tentang/store', [ComproController::class, 'tentangStore'])->name('compro.tentang.store');
    Route::get('compro/tentang/{id}/edit', [ComproController::class, 'tentangEdit'])->name('compro.tentang.edit');
    Route::post('compro/tentang/update', [ComproController::class, 'tentangUpdate'])->name('compro.tentang.update');
    Route::post('compro/tentang/delete', [ComproController::class, 'tentangDelete'])->name('compro.tentang.delete');

    // compro kontak
    Route::get('compro/kontak', [ComproController::class, 'kontak'])->name('compro.kontak');
    Route::post('compro/kontak/store', [ComproController::class, 'kontakStore'])->name('compro.kontak.store');
    Route::get('compro/kontak/{id}/edit', [ComproController::class, 'kontakEdit'])->name('compro.kontak.edit');
    Route::post('compro/kontak/update', [ComproController::class, 'kontakUpdate'])->name('compro.kontak.update');
    Route::post('compro/kontak/delete', [ComproController::class, 'kontakDelete'])->name('compro.kontak.delete');
    Route::post('compro/kontak/form/delete', [ComproController::class, 'kontakFormDelete'])->name('compro.kontak.form.delete');

    // compro cabang
    Route::get('compro/cabang', [ComproController::class, 'cabang'])->name('compro.cabang');
    Route::post('compro/cabang/store', [ComproController::class, 'cabangStore'])->name('compro.cabang.store');
    Route::get('compro/cabang/{id}/edit', [ComproController::class, 'cabangEdit'])->name('compro.cabang.edit');
    Route::post('compro/cabang/update', [ComproController::class, 'cabangUpdate'])->name('compro.cabang.update');
    Route::post('compro/cabang/delete', [ComproController::class, 'cabangDelete'])->name('compro.cabang.delete');

    // compro testimoni
    Route::get('compro/testimoni', [ComproController::class, 'testimoni'])->name('compro.testimoni');
    Route::post('compro/testimoni/store', [ComproController::class, 'testimoniStore'])->name('compro.testimoni.store');
    Route::get('compro/testimoni/{id}/edit', [ComproController::class, 'testimoniEdit'])->name('compro.testimoni.edit');
    Route::post('compro/testimoni/update', [ComproController::class, 'testimoniUpdate'])->name('compro.testimoni.update');
    Route::post('compro/testimoni/delete', [ComproController::class, 'testimoniDelete'])->name('compro.testimoni.delete');

    // compro produk
    Route::get('compro/produk', [ComproController::class, 'produk'])->name('compro.produk');
    Route::post('compro/produk/store', [ComproController::class, 'produkStore'])->name('compro.produk.store');
    Route::get('compro/produk/{id}/edit', [ComproController::class, 'produkEdit'])->name('compro.produk.edit');
    Route::post('compro/produk/update', [ComproController::class, 'produkUpdate'])->name('compro.produk.update');
    Route::post('compro/produk/delete', [ComproController::class, 'produkDelete'])->name('compro.produk.delete');

    // compro gabung
    Route::get('compro/gabung', [ComproController::class, 'gabung'])->name('compro.gabung');
    Route::post('compro/gabung/store', [ComproController::class, 'gabungStore'])->name('compro.gabung.store');
    Route::get('compro/gabung/{id}/edit', [ComproController::class, 'gabungEdit'])->name('compro.gabung.edit');
    Route::post('compro/gabung/update', [ComproController::class, 'gabungUpdate'])->name('compro.gabung.update');
    Route::post('compro/gabung/delete', [ComproController::class, 'gabungDelete'])->name('compro.gabung.delete');

    // compro tim
    Route::get('compro/tim', [ComproController::class, 'tim'])->name('compro.tim');
    Route::post('compro/tim/store', [ComproController::class, 'timStore'])->name('compro.tim.store');
    Route::get('compro/tim/{id}/edit', [ComproController::class, 'timEdit'])->name('compro.tim.edit');
    Route::post('compro/tim/update', [ComproController::class, 'timUpdate'])->name('compro.tim.update');
    Route::post('compro/tim/delete', [ComproController::class, 'timDelete'])->name('compro.tim.delete');
    
    // compro partner
    Route::get('compro/partner', [ComproController::class, 'partner'])->name('compro.partner');
    Route::post('compro/partner/store', [ComproController::class, 'partnerStore'])->name('compro.partner.store');
    Route::get('compro/partner/{id}/edit', [ComproController::class, 'partnerEdit'])->name('compro.partner.edit');
    Route::post('compro/partner/update', [ComproController::class, 'partnerUpdate'])->name('compro.partner.update');
    Route::post('compro/partner/delete', [ComproController::class, 'partnerDelete'])->name('compro.partner.delete');

    // compro legal
    Route::get('compro/legal', [ComproController::class, 'legal'])->name('compro.legal');
    Route::post('compro/legal/store', [ComproController::class, 'legalStore'])->name('compro.legal.store');
    Route::get('compro/legal/{id}/edit', [ComproController::class, 'legalEdit'])->name('compro.legal.edit');
    Route::post('compro/legal/update', [ComproController::class, 'legalUpdate'])->name('compro.legal.update');
    Route::post('compro/legal/delete', [ComproController::class, 'legalDelete'])->name('compro.legal.delete');

    // compro pelanggan
    Route::get('compro/pelanggan', [ComproController::class, 'pelanggan'])->name('compro.pelanggan');
    Route::post('compro/pelanggan/store', [ComproController::class, 'pelangganStore'])->name('compro.pelanggan.store');
    Route::get('compro/pelanggan/{id}/edit', [ComproController::class, 'pelangganEdit'])->name('compro.pelanggan.edit');
    Route::post('compro/pelanggan/update', [ComproController::class, 'pelangganUpdate'])->name('compro.pelanggan.update');
    Route::post('compro/pelanggan/delete', [ComproController::class, 'pelangganDelete'])->name('compro.pelanggan.delete');

    // compro blog
    Route::get('compro/blog', [ComproController::class, 'blog'])->name('compro.blog');
    Route::post('compro/blog/store', [ComproController::class, 'blogStore'])->name('compro.blog.store');
    Route::get('compro/blog/{id}/edit', [ComproController::class, 'blogEdit'])->name('compro.blog.edit');
    Route::post('compro/blog/update', [ComproController::class, 'blogUpdate'])->name('compro.blog.update');
    Route::post('compro/blog/delete', [ComproController::class, 'blogDelete'])->name('compro.blog.delete');

    // compro slide
    Route::get('compro/slide', [ComproController::class, 'slide'])->name('compro.slide');
    Route::post('compro/slide/store', [ComproController::class, 'slideStore'])->name('compro.slide.store');
    Route::get('compro/slide/{id}/edit', [ComproController::class, 'slideEdit'])->name('compro.slide.edit');
    Route::post('compro/slide/update', [ComproController::class, 'slideUpdate'])->name('compro.slide.update');
    Route::post('compro/slide/delete', [ComproController::class, 'slideDelete'])->name('compro.slide.delete');

    // abdul
    Route::get('abdul', [AbdulController::class, 'index'])->name('abdul');
    Route::get('abdul/{id}/show', [AbdulController::class, 'show'])->name('abdul.show');
    Route::get('abdul/create', [AbdulController::class, 'create'])->name('abdul.create');
    Route::post('abdul/store', [AbdulController::class, 'store'])->name('abdul.store');
    Route::post('abdul/delete', [AbdulController::class, 'delete'])->name('abdul.delete');
    // Route::get('abdul/approver', [AbdulController::class, 'approver'])->name('abdul.approver');
    // Route::get('abdul/approver/data', [AbdulController::class, 'approverData'])->name('abdul.approver.data');
    // Route::get('abdul/approver/create', [AbdulController::class, 'approverCreate'])->name('abdul.approver.create');
    // Route::post('abdul/approver/store', [AbdulController::class, 'approverStore'])->name('abdul.approver.store');
    // Route::post('abdul/approver/update_approver', [AbdulController::class, 'approverUpdate'])->name('abdul.approver.update');
    // Route::post('abdul/approver/add_approver', [AbdulController::class, 'approverAdd'])->name('abdul.approver.add');
    // Route::get('abdul/approver/{id}/delete_btn', [AbdulController::class, 'approverDeleteAllBtn'])->name('abdul.approver.delete_all_btn');
    // Route::post('abdul/approver/delete', [AbdulController::class, 'approverDeleteAll'])->name('abdul.approver.delete_all');
    // Route::get('abdul/approver/{id}/delete_btn_approver', [AbdulController::class, 'approverDeleteBtn'])->name('abdul.approver.delete_btn');
    // Route::post('abdul/approver/delete_approver', [AbdulController::class, 'approverDelete'])->name('abdul.approver.delete');
    Route::post('abdul/approved', [AbdulController::class, 'approved'])->name('abdul.approved');
    Route::post('abdul/disapproved', [AbdulController::class, 'disapproved'])->name('abdul.disapproved');
    Route::post('abdul/detailApprover', [AbdulController::class, 'detailApprover'])->name('abdul.detailApprover');
    Route::get('abdul/{id}/sp3', [AbdulController::class, 'sp3'])->name('abdul.sp3');
    Route::get('abdul/{id}/akad', [AbdulController::class, 'akad'])->name('abdul.akad');
    Route::get('abdul/{id}/download', [AbdulController::class, 'download'])->name('abdul.download');

    // persetujuan
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan');
    Route::get('persetujuan/create', [PersetujuanController::class, 'create'])->name('persetujuan.create');
    Route::post('persetujuan/store', [PersetujuanController::class, 'store'])->name('persetujuan.store');
    Route::get('persetujuan/{id}/show', [PersetujuanController::class, 'show'])->name('persetujuan.show');
    Route::get('persetujuan/{id}/delete', [PersetujuanController::class, 'delete'])->name('persetujuan.delete');
    Route::get('persetujuan/approver', [PersetujuanController::class, 'approver'])->name('persetujuan.approver');
    Route::get('persetujuan/approver/data', [PersetujuanController::class, 'approverData'])->name('persetujuan.approver.data');
    Route::get('persetujuan/approver/create', [PersetujuanController::class, 'approverCreate'])->name('persetujuan.approver.create');
    Route::post('persetujuan/approver/store', [PersetujuanController::class, 'approverStore'])->name('persetujuan.approver.store');
    Route::post('persetujuan/approver/update_approver', [PersetujuanController::class, 'approverUpdate'])->name('persetujuan.approver.update');
    Route::post('persetujuan/approver/add_approver', [PersetujuanController::class, 'approverAdd'])->name('persetujuan.approver.add');
    Route::get('persetujuan/approver/{id}/delete_btn', [PersetujuanController::class, 'approverDeleteAllBtn'])->name('persetujuan.approver.delete_all_btn');
    Route::post('persetujuan/approver/delete', [PersetujuanController::class, 'approverDeleteAll'])->name('persetujuan.approver.delete_all');
    Route::get('persetujuan/approver/{id}/delete_btn_approver', [PersetujuanController::class, 'approverDeleteBtn'])->name('persetujuan.approver.delete_btn');
    Route::post('persetujuan/approver/delete_approver', [PersetujuanController::class, 'approverDelete'])->name('persetujuan.approver.delete');
    Route::post('persetujuan/approved', [PersetujuanController::class, 'approved'])->name('persetujuan.approved');
    Route::post('persetujuan/disapproved', [PersetujuanController::class, 'disapproved'])->name('persetujuan.disapproved');
    Route::post('persetujuan/detailApprover', [PersetujuanController::class, 'detailApprover'])->name('persetujuan.detailApprover');

    // lembur
    Route::get('lembur', [LemburController::class, 'index'])->name('lembur');
    Route::get('lembur/create', [LemburController::class, 'create'])->name('lembur.create');
    Route::get('lembur/create/form', [LemburController::class, 'createForm'])->name('lembur.create.form');
    Route::post('lembur/store', [LemburController::class, 'store'])->name('lembur.store');
    Route::get('lembur/{id}/show', [LemburController::class, 'show'])->name('lembur.show');
    Route::get('lembur/{id}/edit', [LemburController::class, 'edit'])->name('lembur.edit');
    Route::put('lembur/{id}/update', [LemburController::class, 'update'])->name('lembur.update');
    Route::get('lembur/{id}/delete', [LemburController::class, 'delete'])->name('lembur.delete');
    Route::post('lembur/approved', [LemburController::class, 'approved'])->name('lembur.approved');
    Route::post('lembur/disapproved', [LemburController::class, 'disapproved'])->name('lembur.disapproved');
    Route::post('lembur/detailApprover', [LemburController::class, 'detailApprover'])->name('lembur.detailApprover');
    Route::post('lembur/filter', [LemburController::class, 'filter'])->name('lembur.filter');

      // task
      Route::get('lembur/task', [LemburController::class, 'task'])->name('lembur.task');
      Route::get('lembur/task/create', [LemburController::class, 'taskCreate'])->name('lembur.task.create');
      Route::post('lembur/task/store', [LemburController::class, 'taskStore'])->name('lembur.task.store');
      Route::get('lembur/task/{id}/edit', [LemburController::class, 'taskEdit'])->name('lembur.task.edit');
      Route::put('lembur/task/{id}/update', [LemburController::class, 'taskUpdate'])->name('lembur.task.update');
      Route::get('lembur/task/{id}/delete', [LemburController::class, 'taskDelete'])->name('lembur.task.delete');

    // konsultasi
    Route::get('konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
    Route::get('konsultasi/create', [KonsultasiController::class, 'create'])->name('konsultasi.create');
    Route::post('konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi.store');
    Route::get('konsultasi/{id}/show', [KonsultasiController::class, 'show'])->name('konsultasi.show');
    Route::get('konsultasi/{id}/edit', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
    Route::put('konsultasi/{id}/update', [KonsultasiController::class, 'update'])->name('konsultasi.update');
    Route::get('konsultasi/{id}/delete', [KonsultasiController::class, 'delete'])->name('konsultasi.delete');
    
    // approver
    Route::get('master/approver', [ApproverController::class, 'index'])->name('approver');
    Route::post('master/approver/data', [ApproverController::class, 'data'])->name('approver.data');
    Route::post('master/approver/create', [ApproverController::class, 'create'])->name('approver.create');
    Route::post('master/approver/store', [ApproverController::class, 'store'])->name('approver.store');
    Route::get('master/approver/{id}/delete', [ApproverController::class, 'delete'])->name('approver.delete');
    Route::get('master/approver/{id}/createApprover', [ApproverController::class, 'createApprover'])->name('approver.createApprover');
    Route::post('master/approver/storeApprover', [ApproverController::class, 'storeApprover'])->name('approver.storeApprover');
    Route::get('master/approver/{id}/deleteAllApproverDetail', [ApproverController::class, 'deleteAllApproverDetail'])->name('approver.deleteAllApproverDetail');
});
