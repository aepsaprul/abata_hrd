@extends('layouts.app')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5>Tambah Persetujuan</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('persetujuan') }}">Persetujuan</a></li>
						<li class="breadcrumb-item active">Tambah</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
              <form action="{{ route('persetujuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 col-12">
                    <div class="mb-3">
                      <label for="judul">Judul</label>
                      <input type="text" name="judul" id="judul" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="mb-3">
                      <label for="pemohon">Pemohon</label>
                      <input type="text" name="pemohon" id="pemohon" class="form-control" value="{{ $pemohon }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="mb-3">
                      <label for="sifat">Sifat</label>
                      <select name="sifat" id="sifat" class="form-control">
                        <option value="prioritas">Prioritas</option>
                        <option value="mendesak">Mendesak</option>
                        <option value="dianggarkan">Dianggarkan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="mb-3">
                      <label for="lampiran">Lampiran</label>
                      <input type="file" name="lampiran" id="lampiran" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12 col-12">
                    <div class="mb-3">
                      <label for="keterangan">Keterangan (opsional)</label>
                      <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button class="btn btn-primary" style="width: 130px;"><i class="fas fa-paper-plane"></i> Kirim</button>
                  </div>
                </div>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection