@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1></h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
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
                <form action="{{ route('labul.input.omzet_cabang.store') }}" method="POST">
                  @csrf
                  <div class="d-flex justify-content-center">
                      <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                        <div class="mb-3">
                          <label for="omzet_cabang_cabang" class="form-label">Nama Cabang</label>
                          <select name="omzet_cabang_cabang_id" id="omzet_cabang_cabang_id" class="form-control">
                            @php
                              if (Auth::user()->masterKaryawan) {
                                $cabang_id = Auth::user()->masterKaryawan->master_cabang_id;
                              } else {
                                $cabang_id = 0;
                              }
                              
                            @endphp
                            @foreach ($cabang as $item)
                              <option value="{{ $item->id }}" {{ $item->id == $cabang_id ? "selected" : "" }}>{{ $item->nama_cabang }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_tanggal" class="form-label">Tanggal</label>
                            <input type="datetime-local" name="omzet_cabang_tanggal" id="omzet_cabang_tanggal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_transaksi" class="form-label">Transaksi</label>
                            <input type="number" name="omzet_cabang_transaksi" id="omzet_cabang_transaksi" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_traffic_online" class="form-label">Traffic Online</label>
                            <input type="number" name="omzet_cabang_traffic_online" id="omzet_cabang_traffic_online" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_traffic_offline" class="form-label">Traffic Offline</label>
                            <input type="number" name="omzet_cabang_traffic_offline" id="omzet_cabang_traffic_offline" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_retail" class="form-label">Retail</label>
                            <input type="text" name="omzet_cabang_retail" id="omzet_cabang_retail" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_instansi" class="form-label">Instansi</label>
                            <input type="text" name="omzet_cabang_instansi" id="omzet_cabang_instansi" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_reseller" class="form-label">Reseller</label>
                            <input type="text" name="omzet_cabang_reseller" id="omzet_cabang_reseller" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_cabang" class="form-label">Cabang</label>
                            <input type="text" name="omzet_cabang_cabang" id="omzet_cabang_cabang" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_omzet_harian" class="form-label">Omzet Harian</label>
                            <input type="text" name="omzet_cabang_omzet_harian" id="omzet_cabang_omzet_harian" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_omzet_terbayar" class="form-label">Omzet Terbayar</label>
                            <input type="text" name="omzet_cabang_omzet_terbayar" id="omzet_cabang_omzet_terbayar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_leads" class="form-label">Leads</label>
                            <input type="number" name="omzet_cabang_leads" id="omzet_cabang_leads" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_konsumen_bertanya" class="form-label">Konsumen Bertanya</label>
                            <input type="number" name="omzet_cabang_konsumen_bertanya" id="omzet_cabang_konsumen_bertanya" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_cetak_banner_harian" class="form-label">Cetak Banner Harian</label>
                            <input type="text" name="omzet_cabang_cetak_banner_harian" id="omzet_cabang_cetak_banner_harian" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_cetak_a3_harian" class="form-label">Cetak A3 Harian</label>
                            <input type="text" name="omzet_cabang_cetak_a3_harian" id="omzet_cabang_cetak_a3_harian" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_print_outdoor" class="form-label">Print Outdoor</label>
                            <input type="text" name="omzet_cabang_print_outdoor" id="omzet_cabang_print_outdoor" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_print_indoor" class="form-label">Print Indoor</label>
                            <input type="text" name="omzet_cabang_print_indoor" id="omzet_cabang_print_indoor" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_offset" class="form-label">Offset</label>
                            <input type="text" name="omzet_cabang_offset" id="omzet_cabang_offset" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_merchandise" class="form-label">Merchandise</label>
                            <input type="text" name="omzet_cabang_merchandise" id="omzet_cabang_merchandise" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_akrilik" class="form-label">Akrilik</label>
                            <input type="text" name="omzet_cabang_akrilik" id="omzet_cabang_akrilik" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_design" class="form-label">Design</label>
                            <input type="text" name="omzet_cabang_design" id="omzet_cabang_design" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_laminasi_dingin" class="form-label">Laminasi Dingin</label>
                            <input type="text" name="omzet_cabang_laminasi_dingin" id="omzet_cabang_laminasi_dingin" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_laminasi_a3" class="form-label">Laminasi A3</label>
                            <input type="text" name="omzet_cabang_laminasi_a3" id="omzet_cabang_laminasi_a3" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_fotocopy" class="form-label">Fotocopy</label>
                            <input type="text" name="omzet_cabang_fotocopy" id="omzet_cabang_fotocopy" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_dtf" class="form-label">DTF</label>
                            <input type="text" name="omzet_cabang_dtf" id="omzet_cabang_dtf" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_uv" class="form-label">UV</label>
                            <input type="text" name="omzet_cabang_uv" id="omzet_cabang_uv" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_advertising_produk" class="form-label">Advertising Produk</label>
                            <input type="text" name="omzet_cabang_advertising_produk" id="omzet_cabang_advertising_produk" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_advertising_jasa" class="form-label">Advertising Jasa</label>
                            <input type="text" name="omzet_cabang_advertising_jasa" id="omzet_cabang_advertising_jasa" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_cash_harian" class="form-label">Cash Harian</label>
                            <input type="text" name="omzet_cabang_cash_harian" id="omzet_cabang_cash_harian" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_piutang_bulan_berjalan" class="form-label">Piutang Bulan Berjalan</label>
                            <input type="text" name="omzet_cabang_piutang_bulan_berjalan" id="omzet_cabang_piutang_bulan_berjalan" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="omzet_cabang_piutang_terbayar" class="form-label">Piutang Terbayar</label>
                            <input type="text" name="omzet_cabang_piutang_terbayar" id="omzet_cabang_piutang_terbayar" class="form-control">
                        </div>
                        @foreach ($sales as $item)
                          <div class="mb-3">
                            <label for="omzet_cabang_karyawan_sales_id" class="form-label">Nama Sales</label>
                            <select name="omzet_cabang_karyawan_sales_id[]" id="omzet_cabang_karyawan_sales_id" class="form-control" required>
                              <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="omzet_cabang_pencapaian_omset_sales" class="form-label">Pencapaian Omset Sales</label>
                            <input type="text" name="omzet_cabang_pencapaian_omset_sales[]" id="omzet_cabang_pencapaian_omset_sales" class="pencapaian_omset_sales form-control">
                          </div>
                          <div class="mb-3">
                            <label for="omzet_cabang_pencapaian_cash_sales" class="form-label">Pencapaian Cash Sales</label>
                            <input type="text" name="omzet_cabang_pencapaian_cash_sales[]" id="omzet_cabang_pencapaian_cash_sales" class="pencapaian_cash_sales form-control">
                          </div>                            
                        @endforeach
                        <button class="btn btn-primary btn-omzet-cabang-spinner d-none" disabled style="width: 130px;">
                          <span class="spinner-grow spinner-grow-sm"></span>
                          Loading...
                        </button>
                        <button type="submit" class="btn btn-primary btn-omzet-cabang-save" style="width: 130px;">
                          <i class="fas fa-save"></i> Simpan
                        </button>
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
<script>
  $(document).ready(function () {
    let retail = document.getElementById("omzet_cabang_retail");
    retail.addEventListener("keyup", function(e) {
        retail.value = formatRupiah(this.value, "");
    });

    let instansi = document.getElementById("omzet_cabang_instansi");
    instansi.addEventListener("keyup", function(e) {
        instansi.value = formatRupiah(this.value, "");
    });

    let reseller = document.getElementById("omzet_cabang_reseller");
    reseller.addEventListener("keyup", function(e) {
        reseller.value = formatRupiah(this.value, "");
    });

    let cabang = document.getElementById("omzet_cabang_cabang");
    cabang.addEventListener("keyup", function(e) {
        cabang.value = formatRupiah(this.value, "");
    });

    let omzet_harian = document.getElementById("omzet_cabang_omzet_harian");
    omzet_harian.addEventListener("keyup", function(e) {
        omzet_harian.value = formatRupiah(this.value, "");
    });

    let omzet_terbayar = document.getElementById("omzet_cabang_omzet_terbayar");
    omzet_terbayar.addEventListener("keyup", function(e) {
        omzet_terbayar.value = formatRupiah(this.value, "");
    });

    let cetak_banner_harian = document.getElementById("omzet_cabang_cetak_banner_harian");
    cetak_banner_harian.addEventListener("keyup", function(e) {
        cetak_banner_harian.value = formatRupiah(this.value, "");
    });

    let cetak_a3_harian = document.getElementById("omzet_cabang_cetak_a3_harian");
    cetak_a3_harian.addEventListener("keyup", function(e) {
        cetak_a3_harian.value = formatRupiah(this.value, "");
    });

    let print_outdoor = document.getElementById("omzet_cabang_print_outdoor");
    print_outdoor.addEventListener("keyup", function(e) {
        print_outdoor.value = formatRupiah(this.value, "");
    });

    let print_indoor = document.getElementById("omzet_cabang_print_indoor");
    print_indoor.addEventListener("keyup", function(e) {
        print_indoor.value = formatRupiah(this.value, "");
    });

    let offset = document.getElementById("omzet_cabang_offset");
    offset.addEventListener("keyup", function(e) {
        offset.value = formatRupiah(this.value, "");
    });

    let merchandise = document.getElementById("omzet_cabang_merchandise");
    merchandise.addEventListener("keyup", function(e) {
        merchandise.value = formatRupiah(this.value, "");
    });

    let akrilik = document.getElementById("omzet_cabang_akrilik");
    akrilik.addEventListener("keyup", function(e) {
        akrilik.value = formatRupiah(this.value, "");
    });

    let design = document.getElementById("omzet_cabang_design");
    design.addEventListener("keyup", function(e) {
        design.value = formatRupiah(this.value, "");
    });

    let laminasi_dingin = document.getElementById("omzet_cabang_laminasi_dingin");
    laminasi_dingin.addEventListener("keyup", function(e) {
        laminasi_dingin.value = formatRupiah(this.value, "");
    });

    let laminasi_a3 = document.getElementById("omzet_cabang_laminasi_a3");
    laminasi_a3.addEventListener("keyup", function(e) {
        laminasi_a3.value = formatRupiah(this.value, "");
    });

    let fotocopy = document.getElementById("omzet_cabang_fotocopy");
    fotocopy.addEventListener("keyup", function(e) {
        fotocopy.value = formatRupiah(this.value, "");
    });

    let dtf = document.getElementById("omzet_cabang_dtf");
    dtf.addEventListener("keyup", function(e) {
        dtf.value = formatRupiah(this.value, "");
    });

    let uv = document.getElementById("omzet_cabang_uv");
    uv.addEventListener("keyup", function(e) {
        uv.value = formatRupiah(this.value, "");
    });

    let advertising_produk = document.getElementById("omzet_cabang_advertising_produk");
    advertising_produk.addEventListener("keyup", function(e) {
        advertising_produk.value = formatRupiah(this.value, "");
    });

    let advertising_jasa = document.getElementById("omzet_cabang_advertising_jasa");
    advertising_jasa.addEventListener("keyup", function(e) {
        advertising_jasa.value = formatRupiah(this.value, "");
    });

    let cash_harian = document.getElementById("omzet_cabang_cash_harian");
    cash_harian.addEventListener("keyup", function(e) {
        cash_harian.value = formatRupiah(this.value, "");
    });

    let piutang_bulan_berjalan = document.getElementById("omzet_cabang_piutang_bulan_berjalan");
    piutang_bulan_berjalan.addEventListener("keyup", function(e) {
        piutang_bulan_berjalan.value = formatRupiah(this.value, "");
    });

    let piutang_terbayar = document.getElementById("omzet_cabang_piutang_terbayar");
    piutang_terbayar.addEventListener("keyup", function(e) {
        piutang_terbayar.value = formatRupiah(this.value, "");
    });

    let pencapaian_omset_sales = document.querySelectorAll(".pencapaian_omset_sales");
    for (let index = 0; index < pencapaian_omset_sales.length; index++) {
      pencapaian_omset_sales[index].addEventListener("keyup", function(e) {
        this.value = formatRupiah(this.value, "");
      });      
    }
    
    let pencapaian_cash_sales = document.querySelectorAll(".pencapaian_cash_sales");
    for (let index = 0; index < pencapaian_cash_sales.length; index++) {
      pencapaian_cash_sales[index].addEventListener("keyup", function(e) {
        this.value = formatRupiah(this.value, "");
      });      
    }
  });
</script>
@endsection