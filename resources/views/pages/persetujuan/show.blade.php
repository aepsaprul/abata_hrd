@extends('layouts.app')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5>Detail Persetujuan</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('persetujuan') }}">Persetujuan</a></li>
						<li class="breadcrumb-item active">Detail</li>
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
              <form action="{{ route('persetujuan.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="mb-3">
                      <label for="judul">Judul</label>
                      <input type="text" name="judul" id="judul" class="form-control" value="{{ $persetujuan->judul }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="mb-3">
                      <label for="pemohon">Pemohon</label>
                      <input type="text" name="pemohon" id="pemohon" class="form-control" value="{{ $persetujuan->pemohon }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="mb-3">
                      <label for="sifat">Sifat</label>
                      <input type="text" name="sifat" id="sifat" class="form-control" value="{{ $persetujuan->sifat }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-12 col-12">
                    <div class="mb-3">
                      <label for="keterangan">Keterangan (opsional)</label>
                      <textarea name="keterangan" id="keterangan" class="form-control">{{ $persetujuan->keterangan }}</textarea>
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