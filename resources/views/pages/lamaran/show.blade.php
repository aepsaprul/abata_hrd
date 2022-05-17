@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <div class="h3 font-weight-bold">{{ $biodata->nama_lengkap }}</div>
                    <div><a href="{{ route('lamaran.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    {{-- pas foto --}}
                    <div class="card card-primary card-outline">
                        <form id="form_foto" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center profile_img">
                                    @if ($biodata->foto)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->foto) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>Pas Foto</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    {{-- kartu keluarga --}}
                    <div class="card card-primary card-outline">
                        <form id="form_kk" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center img_kk">
                                    @if ($biodata->kk)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->kk) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>Kartu Keluarga</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    {{-- ktp --}}
                    <div class="card card-primary card-outline">
                        <form id="form_ktp" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center img_ktp">
                                    @if ($biodata->ktp)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->ktp) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>KTP</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    {{-- surat lamaran --}}
                    <div class="card card-primary card-outline">
                        <form id="form_surat_lamaran" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center img_surat_lamaran">
                                    @if ($biodata->surat_lamaran)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->surat_lamaran) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>Surat Lamaran</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    {{-- cv --}}
                    <div class="card card-primary card-outline">
                        <form id="form_cv" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center img_cv">
                                    @if ($biodata->cv)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->cv) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>Curriculum Vitae</small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    {{-- ijazah --}}
                    <div class="card card-primary card-outline">
                        <form id="form_ijazah" method="post" enctype="multipart/form-data">
                            <div class="card-body box-profile">
                                <div class="text-center img_ijazah">
                                    @if ($biodata->ijazah)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/image/' . $biodata->ijazah) }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('http://localhost/abata_recruitment/public/assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <small>Ijazah</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a></li>
                                <li class="nav-item"><a class="nav-link" href="#medsos" data-toggle="tab">Medis Sosial</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#penghargaan" data-toggle="tab">Penghargaan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#organisasi" data-toggle="tab">Organisasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#riwayat_pekerjaan" data-toggle="tab">Riwayat Pekerjaan</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                {{-- biodata --}}
                                <div class="active tab-pane" id="biodata">
                                    <div class="row" id="biodata_data">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="nama_lengkap" class="col-form-label col-form-label-sm font-weight-light">Nama Lengkap</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->nama_lengkap }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="nama_panggilan" class="col-form-label col-form-label-sm font-weight-light">Nama Panggilan</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->nama_panggilan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="gender" class="col-form-label col-form-label-sm font-weight-light">Jenis Kelamin</label>
                                                <input type="text" class="form-control" value="{{ $biodata->gender }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="nomor_ktp" class="col-form-label col-form-label-sm font-weight-light">Nomor KTP</label>
                                                <input type="number" class="form-control form-control-sm" value="{{ $biodata->nomor_ktp }}" readonly>
                                            </div>
                                        </div>
                                        <div class=col-lg-3 col-md-3 col-sm-12 col-12>
                                            <div class=form-group>
                                                <label for=status_kawin class=col-form-label col-form-label-sm font-weight-light>Status Perkawinan</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->status_kawin }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="agama" class="col-form-label col-form-label-sm font-weight-light">Agama</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->agama }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="tempat_lahir" class="col-form-label col-form-label-sm font-weight-light">Tempat Lahir</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->tempat_lahir }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="tanggal_lahir" class="col-form-label col-form-label-sm font-weight-light">Tanggal Lahir</label>
                                                <input type="date" class="form-control form-control-sm" value="{{ $biodata->tanggal_lahir }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="alamat_asal" class="col-form-label col-form-label-sm font-weight-light">Alamat KTP</label>
                                                <textarea class="form-control form-control-sm" rows="3" readonly>{{ $biodata->alamat_asal }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="alamat_domisili" class="col-form-label col-form-label-sm font-weight-light">Alamat Sekarang</label>
                                                <textarea class="form-control form-control-sm" rows="3" readonly>{{ $biodata->alamat_domisili }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="sim" class="font-weight-light">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" class="form-control form-control-sm" value="{{ $biodata->jenis_sim }}" readonly>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" class="form-control form-control-sm" value="{{ $biodata->nomor_sim }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label col-form-label-sm font-weight-light">Email</label>
                                                <input type="email" class="form-control form-control-sm" value="{{ $biodata->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="telepon" class="col-form-label col-form-label-sm font-weight-light">Telepon</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $biodata->telepon }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="penghasilan_ortu" class="col-form-label col-form-label-sm font-weight-light">Penghasilan Orang Tua</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ rupiah($biodata->penghasilan_ortu) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- sebelum menikah --}}
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <span class="font-weight-bold">Keluarga Sebelum Menikah</span>
                                        </div>
                                        <div class="card-body">
                                            <div style="overflow-x: auto;">
                                                <table id="tabel_sebelum_menikah" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th class="text-center">Hubungan</th>
                                                            <th class="text-center">Nama</th>
                                                            <th class="text-center">Usia</th>
                                                            <th class="text-center">Jenis Kelamin</th>
                                                            <th class="text-center">Pendidikan</th>
                                                            <th class="text-center">Pekerjaan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data_sebelum_menikah">
                                                        @foreach ($sebelum_menikah as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $item->hubungan }}</td>
                                                                <td class="text-center">{{ $item->nama }}</td>
                                                                <td class="text-center">{{ $item->usia }}</td>
                                                                <td class="text-center">{{ $item->gender == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                                <td class="text-center">{{ $item->pendidikan }}</td>
                                                                <td class="text-center">{{ $item->pekerjaan }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- setelah menikah --}}
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <span class="font-weight-bold">Keluarga Setelah Menikah</span>
                                        </div>
                                        <div class="card-body">
                                            <div style="overflow-x: auto;">
                                                <table id="tabel_setelah_menikah" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th class="text-center">Hubungan</th>
                                                            <th class="text-center">Nama</th>
                                                            <th class="text-center">Tempat Lahir</th>
                                                            <th class="text-center">Tanggal Lahir</th>
                                                            <th class="text-center">Pekerjaan Terakhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data_setelah_menikah">
                                                        @foreach ($setelah_menikah as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $item->hubungan }}</td>
                                                                <td class="text-center">{{ $item->nama }}</td>
                                                                <td class="text-center">{{ $item->tempat_lahir }}</td>
                                                                <td class="text-center">{{ $item->tanggal_lahir }}</td>
                                                                <td class="text-center">{{ $item->pekerjaan }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- kerabat darurat --}}
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <span class="font-weight-bold">Kerabat Darurat</span>
                                        </div>
                                        <div class="card-body">
                                            <div style="overflow-x: auto;">
                                                <table id="tabel_kerabat_darurat" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th class="text-center">Hubungan</th>
                                                            <th class="text-center">Nama</th>
                                                            <th class="text-center">Jenis Kelamin</th>
                                                            <th class="text-center">Telepon</th>
                                                            <th class="text-center">Alamat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data_kerabat_darurat">
                                                        @foreach ($kerabat_darurat as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $item->hubungan }}</td>
                                                                <td class="text-center">{{ $item->nama }}</td>
                                                                <td class="text-center">{{ $item->gender == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                                <td class="text-center">{{ $item->telepon }}</td>
                                                                <td class="text-center">{{ $item->alamat }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- media sosial --}}
                                <div class="tab-pane" id="medsos">
                                    <div style="overflow-x: auto;">
                                        <table id="tabel_medsos" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center">Nama Media Sosial</th>
                                                    <th class="text-center">Nama Akun</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_medsos">
                                                @foreach ($medsos as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->nama_medsos }}</td>
                                                        <td class="text-center">{{ $item->nama_akun }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- pendidikan --}}
                                <div class="tab-pane" id="pendidikan">
                                    <div style="overflow-x: auto;">
                                        <table id="tabel_pendidikan" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center">Tingkat</th>
                                                    <th class="text-center">Nama Sekolah</th>
                                                    <th class="text-center">Kota</th>
                                                    <th class="text-center">Jurusan</th>
                                                    <th class="text-center">Tahun Masuk</th>
                                                    <th class="text-center">Tahun Lulus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_pendidikan">
                                                @foreach ($pendidikan as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->tingkat }}</td>
                                                        <td class="text-center">{{ $item->nama }}</td>
                                                        <td class="text-center">{{ $item->kota }}</td>
                                                        <td class="text-center">{{ $item->jurusan }}</td>
                                                        <td class="text-center">{{ $item->tahun_masuk }}</td>
                                                        <td class="text-center">{{ $item->tahun_lulus }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- penghargaan --}}
                                <div class="tab-pane" id="penghargaan">
                                    <div style="overflow-x: auto;">
                                        <table id="tabel_penghargaan" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center">Nama Penghargaan</th>
                                                    <th class="text-center">Tahun</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_penghargaan">
                                                @foreach ($penghargaan as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->nama }}</td>
                                                        <td class="text-center">{{ $item->tahun }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- organisasi --}}
                                <div class="tab-pane" id="organisasi">
                                    <div style="overflow-x: auto;">
                                        <table id="tabel_organisasi" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center">Nama Organisasi</th>
                                                    <th class="text-center">Jabatan</th>
                                                    <th class="text-center">Masa Kerja</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_organisasi">
                                                @foreach ($organisasi as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->nama }}</td>
                                                        <td class="text-center">{{ $item->jabatan }}</td>
                                                        <td class="text-center">{{ $item->masa_kerja }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- riwayat_pekerjaan --}}
                                <div class="tab-pane" id="riwayat_pekerjaan">
                                    <div id="data_riwayat_pekerjaan">
                                        @foreach ($riwayat_pekerjaan as $item)
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="nama_perusahaan" class="col-sm-5 col-form-label">Nama Perusahaan</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->nama_perusahaan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="jenis_industri" class="col-sm-5 col-form-label">Jenis Industri</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->jenis_industri }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="jabatan_awal" class="col-sm-5 col-form-label">Jabatan Awal</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->jabatan_awal }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="jabatan_akhir" class="col-sm-5 col-form-label">Jabatan Akhir</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->jabatan_akhir }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="awal_bekerja" class="col-sm-5 col-form-label">Awal Bekerja</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ tgl_indo($item->awal_bekerja) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="akhir_bekerja" class="col-sm-5 col-form-label">Akhir Bekerja</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ tgl_indo($item->akhir_bekerja) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="gaji_awal" class="col-sm-5 col-form-label">Gaji Awal</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ rupiah($item->gaji_awal) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="gaji_akhir" class="col-sm-5 col-form-label">Gaji Akhir</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ rupiah($item->gaji_akhir) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="nama_atasan" class="col-sm-5 col-form-label">Nama Atasan</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->nama_atasan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="alasan_berhenti" class="col-sm-5 col-form-label">Alasan Berhenti</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control text-right border-0" value="{{ $item->alasan_berhenti }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script type="text/javascript">
</script>

@endsection
