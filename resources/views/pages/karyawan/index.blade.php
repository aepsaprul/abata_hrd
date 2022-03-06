@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                        <th class="text-center text-indigo">Divisi</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->masterJabatan)
                                                    {{ $item->masterJabatan->nama_jabatan }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->masterDivisi)
                                                    {{ $item->masterDivisi->nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->masterCabang)
                                                    {{ $item->masterCabang->nama_cabang }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="custom-control custom-switch custom-switch-on-success">
                                                    <input
                                                        type="checkbox"
                                                        name="status"
                                                        class="custom-control-input"
                                                        id="status_{{ $item->id }}"
                                                        data-id="{{ $item->id }}"
                                                        {{ $item->status == "Aktif" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="status_{{ $item->id }}"></label>
                                                </div>
                                                <span class="status_title_{{ $item->id }}" style="font-size: 12px;">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a
                                                        href="#"
                                                        class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a
                                                            href="{{ route('karyawan.show', [$item->id]) }}"
                                                            class="dropdown-item border-bottom btn-show"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-eye pr-1"></i> Lihat
                                                        </a>
                                                        <a
                                                            href="{{ route('karyawan.edit', [$item->id]) }}"
                                                            class="dropdown-item border-bottom btn-edit"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-delete"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-minus-circle pr-1"></i> Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

{{-- modal create --}}
<div class="modal fade modal-create" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-create" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline pb-1">
                                <div class="card-body box-profile">
                                    <div class="text-center profile_img create_profile_img">
                                        <img
                                            class="profile-user-img img-fluid"
                                            src="{{ asset('assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label for="create_foto">Foto</label>
                                        <input type="file" id="create_foto" name="foto" class="form-control form-control-sm" >
                                        <small id="errorFoto" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="create_nik">NIK</label>
                                        <input type="text" id="create_nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                                        <small id="errorNik" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-primary card-outline pb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="create_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_nama_panggilan">Nama Panggilan</label>
                                                <input type="text" id="create_nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" id="create_jenis_kelamin" class="form-control form-control-sm">
                                                    <option value="l">L (Laki - laki)</option>
                                                    <option value="p">P (Perempuan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_nomor_ktp">Nomor KTP</label>
                                                <input type="text" id="create_nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                                                <small id="errorNomorKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_status_perkawinan">Status Perkawinan</label>
                                                <select name="status_perkawinan" id="create_status_perkawinan" class="form-control form-control-sm">
                                                    <option value="lajang">Lajang</option>
                                                    <option value="menikah">Menikah</option>
                                                    <option value="cerai">Cerai</option>
                                                </select>
                                                <small id="errorStatusPerkawinan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_agama">Agama</label>
                                                <select name="agama" id="create_agama" class="form-control form-control-sm">
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen_protestan">Kristen Protestan</option>
                                                    <option value="katholik">Katholik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="kong_hu_cu">Kong Hu Cu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="create_tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorTempatLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="create_tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                                                <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_alamat_asal">Alamat KTP</label>
                                                <textarea name="alamat_asal" id="create_alamat_asal" cols="30" rows="2" class="form-control"></textarea>
                                                <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_alamat_domisili">Alamat Domisili</label>
                                                <textarea name="alamat_domisili" id="create_alamat_domisili" cols="30" rows="2" class="form-control"></textarea>
                                                <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sim">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" id="create_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10">
                                                        <small id="errorJenisSim" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" id="create_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15">
                                                        <small id="errorNomorSim" class="form-text text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_cabang_id">Cabang</label>
                                                <select name="master_cabang_id" id="create_cabang_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorCabangId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_jabatan_id">Jabatan</label>
                                                <select name="master_jabatan_id" id="create_jabatan_id" class="form-control form-control-sm create-select-jabatan" >

                                                </select>
                                                <small id="errorJabatanId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_divisi_id">Divisi</label>
                                                <select name="master_divisi_id" id="create_divisi_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorDivisiId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_telepon">Telepon</label>
                                                <input type="text" id="create_telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorTelepon" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_email">Email</label>
                                                <input type="email" id="create_email" name="email" class="form-control form-control-sm" maxlength="50" >
                                                <small id="errorEmail" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;">
                        <span aria-hidden="true"><i class="fas fa-times"></i> Tutup</span>
                    </button>
                    <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal show --}}
<div class="modal fade modal-show" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-show" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline pb-1">
                                <div class="card-body box-profile">
                                    <div class="text-center profile_img show_profile_img">
                                        <img
                                            class="profile-user-img img-fluid"
                                            src="{{ asset('assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label for="show_foto">Foto</label>
                                        <input type="file" id="show_foto" name="foto" class="form-control form-control-sm" >
                                        <small id="errorFoto" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="show_nik">NIK</label>
                                        <input type="text" id="show_nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                                        <small id="errorNik" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-primary card-outline pb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="show_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_nama_panggilan">Nama Panggilan</label>
                                                <input type="text" id="show_nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" id="show_jenis_kelamin" class="form-control form-control-sm">
                                                    <option value="l">L (Laki - laki)</option>
                                                    <option value="p">P (Perempuan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_nomor_ktp">Nomor KTP</label>
                                                <input type="text" id="show_nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                                                <small id="errorNomorKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_status_perkawinan">Status Perkawinan</label>
                                                <select name="status_perkawinan" id="show_status_perkawinan" class="form-control form-control-sm">
                                                    <option value="lajang">Lajang</option>
                                                    <option value="menikah">Menikah</option>
                                                    <option value="cerai">Cerai</option>
                                                </select>
                                                <small id="errorStatusPerkawinan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_agama">Agama</label>
                                                <select name="agama" id="show_agama" class="form-control form-control-sm">
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen_protestan">Kristen Protestan</option>
                                                    <option value="katholik">Katholik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="kong_hu_cu">Kong Hu Cu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="show_tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorTempatLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="show_tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                                                <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_alamat_asal">Alamat KTP</label>
                                                <textarea name="alamat_asal" id="show_alamat_asal" cols="30" rows="2" class="form-control"></textarea>
                                                <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_alamat_domisili">Alamat Domisili</label>
                                                <textarea name="alamat_domisili" id="show_alamat_domisili" cols="30" rows="2" class="form-control"></textarea>
                                                <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sim">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" id="show_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10">
                                                        <small id="errorJenisSim" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" id="show_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15">
                                                        <small id="errorNomorSim" class="form-text text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_cabang_id">Cabang</label>
                                                <select name="master_cabang_id" id="show_cabang_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorCabangId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_jabatan_id">Jabatan</label>
                                                <select name="master_jabatan_id" id="show_jabatan_id" class="form-control form-control-sm show-select-jabatan" >

                                                </select>
                                                <small id="errorJabatanId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_divisi_id">Divisi</label>
                                                <select name="master_divisi_id" id="show_divisi_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorDivisiId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_telepon">Telepon</label>
                                                <input type="text" id="show_telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorTelepon" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="show_email">Email</label>
                                                <input type="email" id="show_email" name="email" class="form-control form-control-sm" maxlength="50" >
                                                <small id="errorEmail" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;">
                        <span aria-hidden="true"><i class="fas fa-times"></i> Tutup</span>
                    </button>
                    <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-save text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true
        });
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('input[name="status"]').on('change', function () {
            let id = $(this).attr('data-id');
            let val_state;

            if ($('#status_' + id).is(":checked")) {
                val_state = "Aktif";
            } else {
                val_state = "Nonaktif";
            }

            $('.status_title_' + id).empty();

            var formData = {
                id: $(this).attr('data-id'),
                status: val_state
            }

            $.ajax({
                type: "post",
                url: "{{ URL::route('karyawan.ubah_status') }}",
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Karyawan berhasil diubah'
                    });

                    $('.status_title_' + response.id).append(response.title);
                }
            });
        });

        // create foto
        $('input[type="file"][name="foto"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.create_profile_img');
            var currentImagePath = $(this).data('value');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                if (typeof(FileReader) != 'undefind') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {'src':e.target.result, 'class':'profile-user-img img-fluid', 'style': 'width: 100%'}).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('Browser tidak support FileReader');
                }
            } else {
                $(img_holder).html(currentImagePath);
            }
        });

        // edit foto
        $('input[type="file"][name="foto"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.edit_profile_img');
            var currentImagePath = $(this).data('value');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                if (typeof(FileReader) != 'undefind') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {'src':e.target.result, 'class':'profile-user-img img-fluid img-circle'}).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('Browser tidak support FileReader');
                }
            } else {
                $(img_holder).html(currentImagePath);
            }
        });

        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('karyawan.create') }}",
                type: "GET",
                success: function (response) {
                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\">" + value.nama_jabatan + "</option>";
                    });
                    $('#create_jabatan_id').append(value_jabatan);

                    var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
                    $.each(response.cabangs, function (index, value) {
                         value_cabang += "<option value=\"" + value.id + "\">" + value.nama_cabang + "</option>";
                    });
                    $('#create_cabang_id').append(value_cabang);

                    var value_divisi = "<option value=\"\">--Pilih Divisi--</option>";
                    $.each(response.divisis, function (index, value) {
                         value_divisi += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#create_divisi_id').append(value_divisi);

                    $('.modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_nama_lengkap').focus();

            $('.create-select-jabatan').select2();
        });

        $(document).on('submit', '#form-create', function (e) {
            e.preventDefault();

            $('#errorNik').empty();
            $('#errorTelepon').empty();
            $('#errorEmail').empty();
            $('#errorNamaLengkap').empty();
            $('#errorNamaPanggilan').empty();
            $('#errorNomorKtp').empty();
            $('#errorStatusPerkawinan').empty();
            $('#errorTempatLahir').empty();
            $('#errorTanggalLahir').empty();
            $('#errorAlamatAsal').empty();
            $('#errorAlamatDomisili').empty();
            $('#errorJenisSim').empty();
            $('#errorNomorSim').empty();
            $('#errorCabangId').empty();
            $('#errorJabatanId').empty();
            $('#errorDivisiId').empty();
            $('#errorFoto').empty();

            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                url: "{{ URL::route('karyawan.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-create-spinner').removeClass('d-none');
                    $('.btn-create-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#errorNik').append(response.errors.nik);
                        $('#errorTelepon').append(response.errors.telepon);
                        $('#errorEmail').append(response.errors.email);
                        $('#errorNamaLengkap').append(response.errors.nama_lengkap);
                        $('#errorNamaPanggilan').append(response.errors.nama_panggilan);
                        $('#errorNomorKtp').append(response.errors.nomor_ktp);
                        $('#errorStatusPerkawinan').append(response.errors.status_perkawinan);
                        $('#errorTempatLahir').append(response.errors.tempat_lahir);
                        $('#errorTanggalLahir').append(response.errors.tanggal_lahir);
                        $('#errorAlamatAsal').append(response.errors.alamat_asal);
                        $('#errorAlamatDomisili').append(response.errors.alamat_domisili);
                        $('#errorJenisSim').append(response.errors.jenis_sim);
                        $('#errorNomorSim').append(response.errors.nomor_sim);
                        $('#errorCabangId').append(response.errors.master_cabang_id);
                        $('#errorJabatanId').append(response.errors.master_jabatan_id);
                        $('#errorDivisiId').append(response.errors.master_divisi_id);
                        $('#errorFoto').append(response.errors.foto);

                        setTimeout(() => {
                            $('.btn-create-spinner').addClass('d-none');
                            $('.btn-create-save').removeClass('d-none');
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil ditambah'
                        });

                        setTimeout(() => {
                            window.location.reload(1);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // delete
        $(document).on('click', '.btn-delete', function () {
            var id = $(this).attr('data-id');
            var url = "{{ route('karyawan.delete_btn', ':id') }}";
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#delete_id').val(response.id);
                    $('.modal-delete').modal('show');
                }
            });
        });

        $(document).on('submit', '#form-delete', function (e) {
            e.preventDefault();
            let formData = new FormData($('#form-delete')[0]);

            $.ajax({
                url: "{{ URL::route('karyawan.delete') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-delete-spinner').removeClass('d-none');
                    $('.btn-delete-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    });
</script>

@endsection
