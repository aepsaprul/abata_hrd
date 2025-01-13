@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ubah Lembur</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lembur') }}">Lembur</a></li>
            <li class="breadcrumb-item active">Ubah</li>
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
            <div class="card-body">
              <div class="mb-3">
                <div class="d-flex justify-content-start">
                  <div style="width: 150px;">Nama Cabang</div>
                  <div class="mx-2">:</div>
                  <div class="">{{ $lembur->cabang }}</div>
                </div>
                <div class="d-flex">
                  <div style="width: 150px;">Hari Tanggal</div>
                  <div class="mx-2">:</div>
                  <div>{{ tglCarbon($lembur->created_at, 'l, d M Y') }}</div>
                </div>
              </div>
              <hr>
              <div id="detail_wrap">
                @foreach ($lembur->dataDetail as $key => $detail)
                  <div class="row">
                    <div class="col-md-3 col-12 mb-3">
                      <label for="nama">Karyawan</label>
                      <input type="text" name="nama" id="nama_{{ $detail->id }}" class="form-control" value="{{ $detail->nama_karyawan }}" readonly>
                    </div>
                    <div class="col-md-3 col-12 mb-3">
                      <label for="mulai">Mulai</label>
                      <input type="datetime-local" name="mulai" id="mulai_{{ $detail->id }}" class="form-control" value="{{ $detail->mulai }}">
                    </div>
                    <div class="col-md-3 col-12 mb-3">
                      <label for="selesai">Selesai</label>
                      <input type="datetime-local" name="selesai" id="selesai_{{ $detail->id }}" class="form-control" value="{{ $detail->selesai }}">
                    </div>
                    <div class="col-md-3 col-12 mb-3 d-flex align-items-end">
                      <button id="btn_update" class="btn btn-primary" data-id="{{ $detail->id }}">Update</button>
                    </div>
                  </div>              
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#detail_wrap').on('click', function(e) {
      const id = e.target.getAttribute('id');
      if (!id) return;
      if (id === "btn_update") {
        const dataId = Number(e.target.dataset.id);
        const url = `/lembur/${dataId}/update`;
        let formData = {
          mulai: $('#mulai_'+dataId).val(),
          selesai: $('#selesai_'+dataId).val()
        }

        $.ajax({
          url: url,
          type: "PUT",
          data: formData,
          success: function(response) {
            console.log(response);
          }
        })
      }
    })
  })
</script>
@endsection
