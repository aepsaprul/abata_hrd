@extends('layouts.app')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ubah Data Kritk & Saran</h1>
				</div>
			</div>
		</div>
	</section>

    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12"><div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/complaint') }}">BACK</a></h3>
                    </div>
                    <div class="card card-primary">
                        <form action="{{ route('complaint.update', [$complaint->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="form-group col-md-4">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama complaint" name="nama_lengkap" onkeyup="this.value = this.value.toUpperCase()" required value="{{ $complaint->nama_lengkap }}">
                                        </div>
                                        @error('nama_lengkap')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Telepon</label>
                                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Telepon" name="telepon" required value="{{ $complaint->telepon }}">
                                        </div>
                                        @error('telepon')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" required value="{{ $complaint->email }}">
                                        </div>
                                        @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="mb-3">
                                            <label for="pengaduan" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control @error('pengaduan') is-invalid @enderror" id="pengaduan" placeholder="Teks deskripsi" name="pengaduan" required value="{{ $complaint->pengaduan }}">
                                        </div>
                                        @error('pengaduan')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="baru" {{ $complaint->status == "baru" ? "selected" : "" }}>Baru</option>
                                                <option value="proses" {{ $complaint->status == "proses" ? "selected" : "" }}>Proses Followup</option>
                                                <option value="sudah" {{ $complaint->status == "sudah" ? "selected" : "" }}>Sudah Followup</option>
                                            </select>
                                        </div>
                                        @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" title="Simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
