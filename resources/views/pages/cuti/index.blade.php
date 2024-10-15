@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cuti</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Cuti</li>
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
            @if (in_array("tambah", $current_data_navigasi))
              <div class="card-header">
                <h3 class="card-title">
                  <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                    <i class="fas fa-plus"></i> Tambah
                  </button>
                </h3>
              </div>
            @endif
            <div class="card-body" style="overflow: auto;">
              <table id="tabel_cuti" class="table table-bordered" style="font-size: 13px;">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Nama Karyawan</th>
                    <th class="text-center text-indigo">Cabang</th>
                    {{-- <th class="text-center text-indigo">Status</th> --}}
                    <th class="text-center text-indigo">Tgl Pengajuan</th>
                    <th class="text-center text-indigo">Approver</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cutis as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td class="text-center">
                        @if ($item->masterKaryawan)
                          {{ $item->masterKaryawan->nama_lengkap }}
                          <br>
                          @if (file_exists('image/' . $item->masterKaryawan->foto))
                            @if ($item->masterKaryawan->foto)
                              <img src="{{ asset(env('APP_URL_IMG') . 'image/' . $item->masterKaryawan->foto) }}" alt="img" style="width: 100px; height: 100px; object-fit: cover;">
                            @endif
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($item->masterKaryawan)
                          {{ $item->masterKaryawan->masterCabang->nama_cabang }}
                        @endif
                      </td>
                      <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                      <td>
                        <div class="row">
                          @php $no = 0; @endphp
                          @foreach ($item->cutiDetail as $cuti_detail)
                            @if ($cuti_detail->hirarki ==  $no)
                              @php continue; @endphp
                            @endif
                            @php $no = $cuti_detail->hirarki; @endphp
                            @if ($cuti_detail->dataAtasan)
                              <div class="col">
                                <table style="border: 1px solid #aaa; width: 100%;">
                                  <tr style="border: 1px solid #aaa;">
                                    <th id="approver_title" colspan="2" class="text-center" role="button" data-status="{{ $item->id }}" data-hirarki="{{ $cuti_detail->hirarki }}">Approver {{ $cuti_detail->hirarki }} <i id="approver_title" data-status="{{ $item->id }}" data-hirarki="{{ $cuti_detail->hirarki }}" class="fas fa-eye"></i></th>
                                  </tr>
                                  <tr style="border: 1px solid #aaa;">
                                    @if ($cuti_detail->status == "1")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-check text-success" data-id="{{ $cuti_detail->id }}"></i></th>
                                    @elseif ($cuti_detail->status == "0")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-times text-danger" data-id="{{ $cuti_detail->id }}"></i></th>
                                    @else
                                      @foreach ($item->cutiDetail as $cuti_detail_2)
                                        @if ($cuti_detail_2->dataAtasan->id == Auth::user()->master_karyawan_id && $cuti_detail_2->hirarki == $cuti_detail->hirarki)
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_approved" class="btn btn-sm btn-success my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $cuti_detail->hirarki }}" data-detailid={{ $cuti_detail->id }} style="width: 40px;"><i id="btn_approved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $cuti_detail->hirarki }}" data-detailid="{{ $cuti_detail->id }}" class="fas fa-check"></i></button></th>
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_disapproved" class="btn btn-sm btn-danger my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $cuti_detail->hirarki }}" data-detailid={{ $cuti_detail->id }} style="width: 40px;"><i id="btn_disapproved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $cuti_detail->hirarki }}" data-detailid="{{ $cuti_detail->id }}" class="fas fa-times"></i></button></th>
                                        @endif
                                      @endforeach
                                    @endif
                                  </tr>
                                  @if ($cuti_detail->approved_keterangan)
                                    <tr style="border: 1px solid #aaa;">
                                      <th style="border: 1px solid #aaa;">{{ $cuti_detail->approved_keterangan }}</th>
                                    </tr>
                                  @endif
                                </table>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </td>
                      <td class="text-center">
                        @if (in_array("detail", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                              @if (in_array("detail", $current_data_navigasi))
                                <a
                                  href="#" class="dropdown-item btn-detail text-indigo"
                                  data-id="{{ $item->id }}">
                                    <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                </a>
                              @endif
                              @if (in_array("hapus", $current_data_navigasi))
                                <a
                                  href="#"
                                  class="dropdown-item btn-delete text-indigo"
                                  data-id="{{ $item->id }}">
                                    <i class="fas fa-trash text-center mr-2" style="width: 20px;"></i> Hapus
                                </a>
                              @endif
                            </div>
                          </div>
                        @endif
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
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <label for="nama" class="form-label">Nama</label>
              <input type="hidden" name="karyawan_id" id="karyawan_id">
              <input type="text" class="form-control" id="nama" name="nama" maxlength="30" required readonly>
              <small id="error_nama" class="form-text text-danger"></small>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <label for="telepon" class="form-label">No Telepon Aktif</label>
              <input type="number" class="form-control" id="telepon" name="telepon" maxlength="15" required>
              <small id="error_telepon" class="form-text text-danger"></small>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <label for="pengganti">Karyawan Pengganti</label>
              <select class="form-control select_pengganti" id="pengganti" name="pengganti" style="width: 100%;">
                {{-- data di jquery --}}
              </select>
              <small id="error_pengganti" class="form-text text-danger"></small>
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
                <div id="form_tanggal"></div>
                <small id="error_jml_hari" class="form-text text-danger"></small>
                <small id="error_form_tanggal" class="form-text text-danger"></small>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <label for="alasan">Alasan Cuti (Secara Lebih Detail)</label>
              <input type="text" name="alasan" id="alasan" class="form-control">
              <small id="error_alasan" class="form-text text-danger"></small>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <label for="sisa_cuti">Sisa Cuti</label>
              <input type="text" name="sisa_cuti" id="sisa_cuti" class="form-control" readonly>
              <small id="error_sisa_cuti" class="form-text text-danger"></small>
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

{{-- modal detail --}}
<div class="modal fade modal-detail" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pengajuan Cuti</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="detail_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="detail_nama" name="detail_nama" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="detail_telepon" class="form-label">No Telepon Aktif</label>
            <input type="number" class="form-control" id="detail_telepon" name="detail_telepon" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="detail_pengganti">Karyawan Pengganti</label>
            <input type="text" name="detail_pengganti" id="detail_pengganti" class="form-control" readonly>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <label for="detail_keterangan">Keterangan</label>
            <input type="text" name="detail_keterangan" id="detail_keterangan" class="form-control" readonly>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <label for="detail_jml_hari">Jumlah Hari</label>
            <input type="text" name="detail_jml_hari" id="detail_jml_hari" class="form-control" readonly>
            <div id="detail_form_tanggal" class="mt-3"></div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <label for="detail_alasan">Alasan Cuti (Secara Lebih Detail)</label>
            <input type="text" name="detail_alasan" id="detail_alasan" class="form-control" readonly>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <label for="detail_sisa_cuti">Sisa Cuti</label>
            <input type="text" name="detail_sisa_cuti" id="detail_sisa_cuti" class="form-control" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- modal approved --}}
<div id="modal_approved" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_approved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Approved</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="status" id="status">
          <input type="hidden" name="detail_id" id="detail_id">
          <input type="hidden" name="confirm" id="confirm">
          <input type="hidden" name="hirarki" id="hirarki">
          <div class="mb-3">
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-approved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-success btn-approved-save" style="width: 130px;">
            <i class="fas fa-paper-plane"></i> Approved
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal disapproved --}}
<div id="modal_disapproved" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_disapproved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Disapproved</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="status" id="status">
          <input type="hidden" name="confirm" id="confirm">
          <input type="hidden" name="hirarki" id="hirarki">
          <div class="mb-3">
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-disapproved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-danger btn-disapproved-save" style="width: 130px;">
            <i class="fas fa-paper-plane"></i> Disapproved
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal approver detail --}}
<div id="modal_approver_detail" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div id="data_approver"></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
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
  </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $("#tabel_cuti").DataTable({
      'responsive': true
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

      // create
    $('#btn-create').on('click', function() {
      $.ajax({
        url: "{{ URL::route('cuti.create') }}",
        type: 'GET',
        success: function(response) {
          $('#nama').val(response.karyawan.nama_lengkap);
          $('#telepon').val(response.karyawan.telepon);
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

          $('#sisa_cuti').val(response.karyawan.total_cuti);

          $('.modal-form').modal('show');
        }
      });
    });

    $(document).on('shown.bs.modal', '.modal-form', function() {
      $('#nama').focus();

      $('.select_pengganti').select2({
        theme: 'bootstrap4'
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
        url: "{{ URL::route('cuti.store') }}",
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

            $('#error_sisa_cuti').append(response.error_sisa_cuti);

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
          var errorMessage = xhr.status + ': ' + error

          Toast.fire({
            icon: 'error',
            title: 'Error - ' + errorMessage
          });
          setTimeout(() => {
            $('.btn-spinner').addClass('d-none');
            $('.btn-save').removeClass('d-none');
          }, 1000);
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

      let date = new Date();
      let tahun = date.getFullYear();
      let bulan = date.getMonth() + 1;
      let tanggal = date.getDate() + 7;

      let bulan_fix, tanggal_fix;
      if (bulan < 10) {
        bulan_fix = '0' + bulan;
      } else {
        bulan_fix = bulan;
      }
      if (tanggal < 10) {
        tanggal_fix = '0' + tanggal;
      } else {
        tanggal_fix = tanggal;
      }

      console.log(bulan_fix+'-'+tanggal_fix);

      for (let index = 1; index <= jml_hari; index++) {

        var form_tanggal = '<br>' +
          '<div class="row">' +
            '<div class="col-md-3">' +
              '<label for="">Tanggal ' + index + '</label>' +
            '</div>' +
            '<div class="col-md-9">' +
              '<input type="date" name="cuti_tanggal[]" id="cuti_tanggal_' + index + '" class="form-control"  onkeydown="return false" min="' + tahun + '-' + bulan_fix + '-' + tanggal_fix + '" autocomplete="off" required>' +
            '</div>' +
          '</div>';

        $('#form_tanggal').append(form_tanggal);
      }
    });

    $('#tabel_cuti').on('click', function (e) {
      const id = e.target.getAttribute('id');
      const dataStatus = e.target.dataset.status;
      const dataConfirm = e.target.dataset.confirm;
      const dataHirarki = e.target.dataset.hirarki;
      const dataDetailId = e.target.dataset.detailid;

      if (!id) return;

      if (id == "btn_approved") {
        $('#modal_approved #detail_id').val(dataDetailId);
        $('#modal_approved #status').val(dataStatus);
        $('#modal_approved #confirm').val(dataConfirm);
        $('#modal_approved #hirarki').val(dataHirarki);
        $('#modal_approved').modal('show');
      }

      if (id == "btn_disapproved") {
        $('#modal_disapproved #status').val(dataStatus);
        $('#modal_disapproved #confirm').val(dataConfirm);
        $('#modal_disapproved #hirarki').val(dataHirarki);
        $('#modal_disapproved').modal('show');
      }

      if(id == "approver_title") {
        $('#modal_approver_detail #data_approver').empty();

        let formData = {
          id: dataStatus,
          hirarki: dataHirarki
        }

        $.ajax({
          url: "{{ route('cuti.detailApprover') }}",
          type: "post",
          data: formData,
          success: function(response) {
            let val = ``;
            $.each(response.cuti_detail, function(index, item) {
              val += `
                <div class="row">
                  <div class="col">`;
                  if (item.confirm == 1) {
                    val += `<span class="text-primary">${item.data_atasan.nama_lengkap}</span>`;
                  } else {
                    val += `<span>${item.data_atasan.nama_lengkap}</span>`;
                  }
                  val += `</div>
                </div>
              `;
            })
            $('#modal_approver_detail #data_approver').append(val);
            $('#modal_approver_detail').modal('show');
          }
        })
      }
    })

    $('#form_approved').submit(function(e) {
      e.preventDefault();
      let formData = {
        status: $('#modal_approved #status').val(),
        confirm: $('#modal_approved #confirm').val(),
        hirarki: $('#modal_approved #hirarki').val(),
        keterangan: $('#modal_approved #keterangan').val()
      }

      $.ajax({
        url: "{{ route('cuti.approved') }}",
        type: "post",
        data: formData,
        success: function(response) {
          window.location.reload();
        }
      })
    })

    $('#form_disapproved').submit(function(e) {
      e.preventDefault();
      let formData = {
        status: $('#modal_disapproved #status').val(),
        confirm: $('#modal_disapproved #confirm').val(),
        hirarki: $('#modal_disapproved #hirarki').val(),
        keterangan: $('#modal_disapproved #keterangan').val()
      }

      $.ajax({
        url: "{{ route('cuti.disapproved') }}",
        type: "post",
        data: formData,
        success: function(response) {
          window.location.reload();
        }
      })
    })
    // $(document).on('click', '.btn-approve', function (e) {
    //   e.preventDefault();
    //   let id = $(this).attr('data-id');
    //   $('#approved_id').val(id);
    //   $('.modal_approved').modal('show');
    // })

    // $(document).on('submit', '#form_approved', function (e) {
    //   e.preventDefault();

    //   let formData = {
    //     id: $('#approved_id').val(),
    //     keterangan: $('#approved_keterangan').val()
    //   }

    //   $.ajax({
    //     url: "{{ URL::route('cuti.approved') }}",
    //     type: 'post',
    //     data: formData,
    //     beforeSend: function () {
    //       $('.btn-approved-spinner').removeClass('d-none');
    //       $('.btn-approved-save').addClass('d-none');
    //     },
    //     success: function (response) {
    //       Toast.fire({
    //         icon: 'success',
    //         title: 'Cuti telah disetujui'
    //       });

    //       setTimeout( () => {
    //         window.location.reload(1);
    //       }, 1000);
    //     }
    //   });
    // });

    // btn disapprove cuti
    // $(document).on('click', '.btn-disapprove', function (e) {
    //   e.preventDefault();
    //   let id = $(this).attr('data-id');
    //   $('#disapproved_id').val(id);
    //   $('.modal_disapproved').modal('show');
    // })

    // $(document).on('submit', '#form_disapproved', function (e) {
    //   e.preventDefault();

    //   let formData = {
    //     id: $('#disapproved_id').val(),
    //     keterangan: $('#disapproved_keterangan').val()
    //   }

    //   $.ajax({
    //     url: "{{ URL::route('cuti.disapproved') }}",
    //     type: 'post',
    //     data: formData,
    //     beforeSend: function () {
    //       $('.btn-disapproved-spinner').removeClass('d-none');
    //       $('.btn-disapproved-save').addClass('d-none');
    //     },
    //     success: function (response) {
    //       Toast.fire({
    //         icon: 'success',
    //         title: 'Cuti tidak disetujui'
    //       });

    //       setTimeout( () => {
    //         window.location.reload(1);
    //       }, 1000);
    //     }
    //   });
    // });

    // detail
    $(document).on('click', '.btn-detail', function (e) {
      e.preventDefault();
      $('#form_tanggal').empty();
      $('#detail_form_tanggal').empty();

      var id = $(this).attr('data-id');
      var url = '{{ route("cuti.show", ":id") }}';
      url = url.replace(':id', id);

      var formData = {
        id: id
      }

      $.ajax({
        url: url,
        type: 'GET',
        data: formData,
        success: function (response) {
          $('#detail_nama').val(response.cuti.master_karyawan.nama_lengkap);
          $('#detail_telepon').val(response.cuti.telepon);
          $('#detail_pengganti').val(response.cuti.karyawan_pengganti.nama_lengkap);
          $('#detail_keterangan').val(response.cuti.jenis);
          $('#detail_jml_hari').val(response.cuti.jml_hari);
          $('#detail_alasan').val(response.cuti.alasan);
          $('#detail_sisa_cuti').val(response.cuti.master_karyawan.total_cuti);

          var value_tanggal = "";
          $.each(response.cuti.cuti_tgl, function (index, item) {
            value_tanggal += "" +
            "<label>Tanggal " + (index + 1) + "</label>" +
            "<input type=\"text\" class=\"form-control\" value=\"" + tanggalIndo(item.tanggal) + "\" readonly>";
          });
          $('#detail_form_tanggal').append(value_tanggal);

          $('.modal-detail').modal('show');
        }
      });
    });

    // delete
    $('body').on('click', '.btn-delete', function (e) {
      e.preventDefault();

      var id = $(this).attr('data-id');
      var url = '{{ route("cuti.delete_btn", ":id") }}';
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

    $('#form-delete').submit(function (e) {
      e.preventDefault();

      var formData = {
          id: $('#delete_id').val()
      }

      $.ajax({
        url: "{{ URL::route('cuti.delete') }}",
        type: 'POST',
        data: formData,
        beforeSend: function () {
          $('.btn-delete-spinner').css('display', 'block');
          $('.btn-delete-yes').css('display', 'none');
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
          var errorMessage = xhr.status + ': ' + xhar.statusText

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
