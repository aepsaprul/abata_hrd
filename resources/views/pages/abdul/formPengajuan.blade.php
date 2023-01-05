<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Form Pengajuan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <button class="btn btn-sm btn-danger btn-kembali"><i class="fas fa-arrow-left"></i> Kembali</button>
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
            <form>
              <input type="text" name="karyawan_id" id="karyawan_id" value="{{ Auth::user()->master_karyawan_id }}">
              <div class="row">
                <div class="col-4 mb-2">
                  <label for="nomor">Nomor</label>
                  <input type="text" name="nomor" id="nomor" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="jabatan">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="telepon">Telepon</label>
                  <input type="text" name="telepon" id="telepon" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="cabang">Cabang</label>
                  <input type="text" name="cabang" id="cabang" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="pinjaman">Besar Pinjaman</label>
                  <input type="text" name="pinjaman" id="pinjaman" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="keperluan">Untuk Keperluan</label>
                  <input type="text" name="keperluan" id="keperluan" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="gaji">Gaji per Bulan</label>
                  <input type="text" name="gaji" id="gaji" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="angsuran">Angsuran per Bulan</label>
                  <input type="text" name="angsuran" id="angsuran" class="form-control">
                </div>
                <div class="col-4 mb-2">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control"></textarea>
                </div>
                <div class="col-8 mb-2">
                  <label for="metode_bayar">Metode Bayar</label>
                  <div class="row">
                    <div class="col-12">
                      <label><input type="radio" name="metode_bayar" id="metode_bayar1" value="1"> Transfer mandiri ke rekening Abata Peduli</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label>
                        <input type="radio" name="metode_bayar" id="metode_bayar2" value="2"> 
                        Pemotongan gaji setiap bulannya hingga selesai, <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dimulai bulan
                        <input type="text" name="metode_bayar_des" id="metode_bayar_des" class="mr-3"><em class="text-danger d-none text-warning-metode-bayar">wajib diisi</em>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mt-3">
                  <button class="btn btn-primary btn-spinner d-none" disabled style="width: 150px;">
                    <span class="spinner-grow spinner-grow-sm"></span>
                  </button>
                  <button class="btn btn-primary btn-submit" style="width: 150px;"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
