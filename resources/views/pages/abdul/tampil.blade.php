<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pinjaman Abata Peduli</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pinjaman Abata Peduli</li>
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
            <button class="btn btn-primary btn-pengajuan"><i class="fas fa-plus"></i> Pengajuan Pinjaman</button>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center text-indigo">Karyawan</th>
                  <th class="text-center text-indigo">Nomor</th>
                  <th class="text-center text-indigo">Pinjaman</th>
                  <th class="text-center text-indigo">Angsuran</th>
                  <th class="text-center text-indigo">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pengajuans as $item)
                  <tr>
                    <td>{{ $item->karyawan_id }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->pinjaman }}</td>
                    <td>{{ $item->angsuran }}</td>
                    <td>aksi</td>
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