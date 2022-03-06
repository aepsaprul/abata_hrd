@extends('layouts.app')

@section('style')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Data Kritik & Saran</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Kritik & Saran</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                        <div class="text-success">
                            <i><b>{{ session('status') }}</b></i>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table-bordered" style="width:100%;">
                                <thead class="bg-secondary text-white mt-3">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Kritik</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaints as $key => $complaint)
                                    <tr>
                                        <td class="text-center">{{ $key +1 }}</td>
                                        <td style="padding: 5px;">{{ $complaint->nama_lengkap }}</td>
                                        <td style="padding: 5px;">{{ $complaint->telepon }}</td>
                                        <td style="padding: 5px;">{{ $complaint->email }}</td>
                                        <td style="padding: 5px;">{{ $complaint->pengaduan }}</td>
                                        <td style="padding: 5px;" class="text-center">{{ date('d-m-Y', strtotime($complaint->tanggal)) }}</td>
                                        <td style="padding: 5px;">
                                            @if ($complaint->status == "proses")
                                                Proses Followup
                                            @elseif($complaint->status == "sudah")
                                                Sudah Followup
                                            @else
                                                Baru
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('complaint.edit', [$complaint->id]) }}" class="btn btn-primary" title="Ubah" style="margin-left: 9px; margin-top: 5px; font-size: 12px;"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('complaint.delete', [$complaint->id]) }}" class="btn btn-danger" title="Hapus" style="margin-left: 9px; margin-top: 5px; font-size: 12px;" onclick="return confirm('Yakin akan menghapus?')"><i class="fas fa-trash"></i></a>
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
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'excelHtml5',
                    customize: function( xlsx ) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        $('row c[r^="C"]', sheet).attr( 's', '2' );
                    }
                } ]
            });
        } );
    </script>
@endsection
