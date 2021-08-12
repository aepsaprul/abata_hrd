
@extends('layouts.app')

@section('style')
<link href="https://cdn.datatables.net/datetime/1.0.2/css/dataTables.dateTime.min.css" rel="stylesheet">

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/datetime/1.0.2/css/dataTables.dateTime.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">

<style>
  table thead tr th {
    text-align: center;
  }

  .nomor-tabel {
    text-align: center;
  }
</style>

@endsection
		

@section('content')

<div class="wrapper"> 

  <!-- Main Sidebar Container --> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengunjung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pengunjung</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<!-- Date -->
					<div class="form-group">
						<label>Tgl Awal:</label>

						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="far fa-calendar-alt"></i>
							</span>
							</div>
							<input type="text" id="min" class="form-control float-right" name="min">
						</div>
						<!-- /.input group -->
					</div>
				</div>
				<div class="col-md-2">
					<!-- Date -->
					<div class="form-group">
						<label>Tgl Akhir:</label>

						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="far fa-calendar-alt"></i>
							</span>
							</div>
							<input type="text" id="max" class="form-control float-right" name="max">
						</div>
						<!-- /.input group -->
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Cabang:</label>

						<select data-column="6" name="" id="" class="form-control filter-cabang">
							<option value="">Semua Cabang</option>
							<option value="2">Situmpur</option>
							<option value="3">HR</option>
							<option value="4">DKW</option>
							<option value="Abata Purbalingga">Purbalingga</option>
							<option value="6">Cilacap</option>
						</select>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-12">
					@if(session('status'))
						<div class="alert alert-success">
							{{session('status')}}
						</div>
					@endif
					<div class="card">
						<div class="card-body">
							<table id="example" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Telepon</th>
									<th>Jenis Cetak</th>
									<th>Nama Desain / CS</th>
									<th>Tanggal</th>
									<th>Cabang</th>
									<th>Kecepatan</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($pengunjungs as $key => $pengunjung)
										<tr>
											<td class="text-center">{{ $key + 1 }}</td>
											<td class="text-left">{{ $pengunjung->nama_customer }}</td>
											<td class="text-right">{{ $pengunjung->telepon }}</td>
											<td class="text-center">
												@if ($pengunjung->customer_filter_id == 1)
													File Siap
												@elseif($pengunjung->customer_filter_id == 2)
													Desain / Edit
												@elseif($pengunjung->customer_filter_id == 3)
													Konsultasi CS
												@elseif($pengunjung->customer_filter_id == 4)
													Desain
												@elseif($pengunjung->customer_filter_id == 5)
													Edit
												@endif
											</td>
											<td>{{ $pengunjung->masterKaryawan->nama_lengkap }}</td>
											<td class="text-center">{{ $pengunjung->tanggal }}</td>
											<td class="text-center">{{ $pengunjung->masterCabang->nama_cabang }}</td>
											<td class="text-right">
												@php
													$waktuawal  = date_create($pengunjung->mulai); //waktu di setting
													$waktuakhir = date_create($pengunjung->selesai); //2019-02-21 09:35 waktu sekarang
													$diff  = date_diff($waktuawal, $waktuakhir);

													if ($diff->h == 0) {
															echo $diff->i . " menit " . $diff->s . " detik";      
													} else {
															echo $diff->h . " jam " . $diff->i . " menit " . $diff->s . " detik";
													}
												@endphp
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
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->

@endsection

@section('script')

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script>
	$(document).ready(function() {
		var minDate, maxDate;
 
		// Custom filtering function which will search data in column four between two values
		$.fn.dataTable.ext.search.push(
				function( settings, data, dataIndex ) {
						var min = minDate.val();
						var max = maxDate.val();
						var date = new Date( data[5] );
			
						if (
								( min === null && max === null ) ||
								( min === null && date <= max ) ||
								( min <= date   && max === null ) ||
								( min <= date   && date <= max )
						) {
								return true;
						}
						return false;
				}
		);
	
		$(document).ready(function() {
				// Create date inputs
				minDate = new DateTime($('#min'), {
						format: 'DD/MM/YYYY'
				});
				maxDate = new DateTime($('#max'), {
						format: 'DD/MM/YYYY'
				});
			
				// DataTables initialisation
				var table = $('#example').DataTable({
						dom: 'Bfrtip',
						buttons: [
								'excel', 'pdf', 'print'
						]
				});
			
				// Refilter the table
				$('#min, #max').on('change', function () {
						table.draw();
				});
				
				//  filter cabang 
				$('.filter-cabang').change(function () {
						table.column( $(this).data('column'))
						.search( $(this).val() )
						.draw();
					});
		});
	});
</script>

@endsection

