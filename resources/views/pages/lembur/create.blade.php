@extends('layouts.app')
@section('style')
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
          <h1>Tambah Lembur</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lembur') }}">Lembur</a></li>
            <li class="breadcrumb-item active">Tambah</li>
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
          <form action="{{ route('lembur.store') }}" method="POST">
            @csrf
            <div id="karyawan_wrap"></div>
            <div class="d-flex justify-content-between">
              <div>
                <button type="button" id="btn_tambah_karyawan" class="btn btn-warning px-3"><i class="fas fa-plus"></i> Karyawan</button>
              </div>
              <div>
                <button class="btn btn-primary px-5" type="submit">Kirim</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  function calculateDifference() {
      const datetime1 = document.getElementById('mulai').value;
      const datetime2 = document.getElementById('selesai').value;

      if (datetime1 && datetime2) {
          // Konversi ke objek Date
          const date1 = new Date(datetime1);
          const date2 = new Date(datetime2);

          // Hitung selisih dalam milidetik
          const diffInMs = Math.ceil(date2 - date1);

          // Konversi milidetik ke jam
          const diffInHours = (diffInMs / (1000 * 60 * 60)).toFixed(0);

          // Tampilkan hasil ke form output
          document.getElementById('total').value = diffInHours;
      }
    }

  $(document).ready(function() {
    $('#btn_tambah_karyawan').click(function() {
      $.ajax({
        url: "{{ route('lembur.create.form') }}",
        type: "get",
        success: function(response) {          
          // Membuat elemen field baru
          let newSelect = `
            <div class="input-group card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-11">
                    <div class="row">
                      <div class="col-md-3 col-12 mb-3">
                        <label for="karyawan">Nama Karyawan</label>
                        <select name="karyawan[]" class="form-control select2_karyawan" required>
                          <option value="">Pilih Karyawan</option>`;
                          $.each(response.karyawans, function(index, item) {
                            newSelect += `<option value="${item.id}">${item.nama_lengkap}</option>`;
                          })
                      newSelect += `
                        </select>
                      </div>
                      <div class="col-md-3 col-12 mb-3">
                        <label for="mulai">Mulai</label>
                        <input type="datetime-local" name="mulai[]" id="mulai" class="form-control" onchange="calculateDifference()">
                      </div>
                      <div class="col-md-3 col-12 mb-3">
                        <label for="selesai">Selesai</label>
                        <input type="datetime-local" name="selesai[]" id="selesai" class="form-control" onchange="calculateDifference()">
                      </div>
                      <div class="col-md-3 col-12 mb-3">
                        <label for="task">Aktivitas</label>
                        <select name="task[]" class="form-control select2_task">
                          <option value="">Pilih Aktivitas</option>`;
                          $.each(response.tasks, function(index_task, task) {
                            newSelect += `<option value="${task.id}">${task.nama}</option>`;
                          })
                        newSelect += `
                        </select>
                      </div>
                      <div class="col-md-12 col-12 mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan[]" id="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1 d-flex justify-content-end">
                    <div class="d-flex align-items-center mb-3">
                      <button type="button" class="btn btn-danger btn_hapus"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            `;
          
          // Menambah elemen field baru ke dalam formulir
          $('#karyawan_wrap').append(newSelect);

          $('#karyawan_wrap .select2_karyawan').last().select2({
            placeholder: "Pilih Karyawan",
            allowClear: true,
            theme: 'bootstrap4'
          })

          $('#karyawan_wrap .select2_task').last().select2({
            placeholder: "Pilih Aktivitas",
            allowClear: true,
            theme: 'bootstrap4'
          })
        }
      })
    });

    // hapus karyawan
    $('#karyawan_wrap').on('click', '.btn_hapus', function() {
      // Menghapus elemen .form-group terdekat
      $(this).closest('#karyawan_wrap .input-group').remove();
    });
  })
</script>
@endsection
