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
                    <h1>Pengajuan Cuti</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Cuti</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Karyawan</th>
                                        <th class="text-center text-indigo">Atasan</th>
                                        <th class="text-center text-indigo">Jenis Cuti</th>
                                        <th class="text-center text-indigo">Tanggal</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cutis as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->masterKaryawan->nama_lengkap }}</td>
                                            <td>{{ $item->atasanLangsung->nama_lengkap }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    @php
                                                        $status = "Permohonan cuti";
                                                        $percentase = "30%";
                                                        $background = "secondary";
                                                    @endphp
												@elseif ($item->status == 2)
                                                    @php
                                                        $status = "Atasan approve";
                                                        $percentase = "60%";
                                                        $background = "primary";
                                                    @endphp
												@elseif ($item->status == 3)
                                                    @php
                                                        $status = "Atasan tolak";
                                                        $percentase = "60%";
                                                        $background = "danger";
                                                    @endphp
												@elseif ($item->status == 4)
                                                    @php
                                                        $status = "HC approve";
                                                        $percentase = "100%";
                                                        $background = "success";
                                                    @endphp
												@elseif ($item->status == 5)
                                                    @php
                                                        $status = "HC tolak";
                                                        $percentase = "100%";
                                                        $background = "danger";
                                                    @endphp
												@else
                                                    @php
                                                        $status = "-";
                                                        $percentase = "0%";
                                                        $background = "transparent";
                                                    @endphp
												@endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percentase }}">
                                                            <span class="">{{ $percentase }}</span>
                                                    </div>
                                                </div>
                                                <span> {{ $status }} </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Form Pengajuan Cuti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="hidden" name="karyawan_id" id="karyawan_id">
                            <input type="text" class="form-control" id="nama" name="nama" maxlength="30" required readonly>
                            <small id="error_nama" class="form-text text-danger"></small>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="hidden" name="jabatan_id" id="jabatan_id">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" maxlength="30" required readonly>
                            <small id="error_jabatan" class="form-text text-danger"></small>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="atasan" class="form-label">Nama Atasan Langsung</label>
                            <select name="atasan" id="atasan" class="form-control select_atasan">
                                {{-- data di jquery --}}
                            </select>
                            <small id="error_atasan" class="form-text text-danger"></small>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="telepon" class="form-label">No Telepon Aktif</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" maxlength="15" required>
                            <small id="error_telepon" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="">Menerangkan dengan ini bahwa saya bermaksud untuk mengambil cuti :</label>
                            <ul style="list-style-type: none; margin: 0; padding: 0;">
                                <li>
                                    <label for="cuti_jenis_1" style="font-weight: normal;">
                                        <input type="radio" name="jenis" id="cuti_jenis_1" value="melahirkan"> Melahirkan
                                    </label>
                                </li>
                                <li>
                                    <label for="cuti_jenis_2" style="font-weight: normal;">
                                        <input type="radio" name="jenis" id="cuti_jenis_2" value="tahunan"> Tahunan
                                    </label>
                                </li>
                                <li>
                                    <label for="cuti_jenis_3" style="font-weight: normal;">
                                        <input type="radio" name="jenis" id="cuti_jenis_3" value="kematian"> Kematian
                                    </label>
                                </li>
                                <li>
                                    <label for="cuti_jenis_4" style="font-weight: normal;">
                                        <input type="radio" name="jenis" id="cuti_jenis_4" value="menikah"> Menikah
                                    </label>
                                </li>
                                <li>
                                    <label for="cuti_jenis_5" style="font-weight: normal;">
                                        <input type="radio" name="jenis" id="cuti_jenis_5" value="lainnya"> Lainnya
                                    </label>
                                    <input type="text" name="form_cuti_lainnya" id="form_cuti_lainnya" class="form-control mt-2" maxlength="50" placeholder="Isi data lainnya">
                                </li>
                            </ul>
                            <small id="error_jenis" class="form-text text-danger"></small>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="jml_hari">Jumlah Hari</label>
                            <select name="jml_hari" id="jml_hari" class="form-control">
                                <option value="">--Pilih Jumlah Hari--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <div id="form_tanggal">

                            </div>
                            <small id="error_jml_hari" class="form-text text-danger"></small>
                            <small id="error_form_tanggal" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="pengganti">Karyawan Pengganti</label>
                            <select class="form-control select_pengganti" id="pengganti" name="pengganti" style="width: 100%;">
                                {{-- data di jquery --}}
                            </select>
                            <small id="error_pengganti" class="form-text text-danger"></small>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="alasan">Alasan Cuti (Secara Lebih Detail)</label>
                            <input type="text" name="alasan" id="alasan" class="form-control">
                            <small id="error_alasan" class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-paper-plane"></i> Kirim
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
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
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

<script>
    $(function () {
        $("#example1").DataTable();
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

        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.create') }}",
                type: 'GET',
                success: function(response) {
                    $('#nama').val(response.karyawan.nama_lengkap);
                    $('#karyawan_id').val(response.karyawan.id);
                    $('#jabatan').val(response.karyawan.master_jabatan.nama_jabatan);
                    $('#jabatan_id').val(response.karyawan.master_jabatan.id);

                    // atasan
                    let value_atasan = "<option value=\"\">--Pilih Atasan--</option>";
                    $.each(response.atasans, function (index, item) {
                        value_atasan += "<option value=\"" + item.id + "\">" + item.nama_lengkap + "</option>";
                    });
                    $('#atasan').append(value_atasan);

                    // pengganti
                    let value_pengganti = "<option value=\"\">--Pilih Pengganti--</option>";
                    $.each(response.pengganti, function (index, item) {
                        value_pengganti += "<option value=\"" + item.id + "\">" + item.nama_lengkap + "</option>";
                    });
                    $('#pengganti').append(value_pengganti);

                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#nama').focus();

            $('.select_atasan').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-form")
            });

            $('.select_pengganti').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-form")
            });
        });

        $(document).on('submit', '#form', function (e) {
            e.preventDefault();

            $('#error_nama').empty();
            $('#error_jabatan').empty();
            $('#error_atasan').empty();
            $('#error_telepon').empty();
            $('#error_jenis').empty();
            $('#error_jml_hari').empty();
            $('#error_form_tanggal').empty();
            $('#error_pengganti').empty();
            $('#error_alasan').empty();

            var formData = new FormData($('#form')[0]);

            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#error_nama').append(response.errors.nama);
                        $('#error_jabatan').append(response.errors.jabatan);
                        $('#error_atasan').append(response.errors.atasan);
                        $('#error_telepon').append(response.errors.telepon);
                        $('#error_jenis').append(response.errors.jenis);
                        $('#error_jml_hari').append(response.errors.jml_hari);
                        $('#error_form_tanggal').append(response.errors.form_tanggal);
                        $('#error_pengganti').append(response.errors.pengganti);
                        $('#error_alasan').append(response.errors.alasan);

                        $('.btn-spinner').addClass('d-none');
                        $('.btn-save').removeClass('d-none');
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
                    var errorMessage = xhr.status + ': ' + statusText

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        $('#form_cuti_lainnya').hide();

        $('input[name="jenis"]').change(function () {
            if ($("#cuti_jenis_5").is(":checked")) {
                $('#form_cuti_lainnya').show();
                $('#form_cuti_lainnya').prop('required', true);
            }
            else {
                $('#form_cuti_lainnya').hide();
            }
        });

		$('#jml_hari').on('change', function () {
			var jml_hari = $(this).val();
			$('#form_tanggal').empty();

			for (let index = 1; index <= jml_hari; index++) {

				var form_tanggal = "<br>" +
					"<div class=\"row\">" +
						"<div class=\"col-md-3\">" +
							"<label for=\"\">Tanggal " + index + "</label>" +
						"</div>" +
						"<div class=\"col-md-9\">" +
							"<input type=\"date\" name=\"cuti_tanggal[]\" id=\"cuti_tanggal_" + index + "\" class=\"form-control\" autocomplete=\"off\" required>" +
						"</div>" +
					"</div>";

				$('#form_tanggal').append(form_tanggal);
			}
		});
    });
</script>

@endsection
