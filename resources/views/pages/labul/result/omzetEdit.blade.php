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
                <form action="{{ route('labul.result.omzet.update', [$omzet->id]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="d-flex justify-content-center">
                      <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                        <input type="hidden" name="edit_omzet_id" id="edit_omzet_id" value="{{ $omzet->id }}">
                        <div class="mb-3">
                          <label for="edit_omzet_cabang_id" class="form-label">Nama Cabang</label>
                          <select name="edit_omzet_cabang_id" id="edit_omzet_cabang_id" class="form-control">
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
                          <label for="edit_omzet_tanggal" class="form-label">Tanggal</label>
                          <input type="datetime-local" name="edit_omzet_tanggal" id="edit_omzet_tanggal" class="form-control" value="{{ $omzet->tanggal }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_transaksi" class="form-label">Transaksi</label>
                          <input type="text" name="edit_omzet_transaksi" id="edit_omzet_transaksi" class="form-control" value="{{ $omzet->transaksi }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_traffic_online" class="form-label">Traffic Online</label>
                          <input type="text" name="edit_omzet_traffic_online" id="edit_omzet_traffic_online" class="form-control" value="{{ $omzet->traffic_online }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_traffic_offline" class="form-label">Traffic Offline</label>
                          <input type="text" name="edit_omzet_traffic_offline" id="edit_omzet_traffic_offline" class="form-control" value="{{ $omzet->traffic_offline }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_retail" class="form-label">Retail</label>
                          <input type="text" name="edit_omzet_retail" id="edit_omzet_retail" class="form-control" value="@labulCurrency($omzet->retail)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_instansi" class="form-label">Instansi</label>
                          <input type="text" name="edit_omzet_instansi" id="edit_omzet_instansi" class="form-control" value="@labulCurrency($omzet->instansi)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_reseller" class="form-label">Reseller</label>
                          <input type="text" name="edit_omzet_reseller" id="edit_omzet_reseller" class="form-control" value="@labulCurrency($omzet->reseller)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_cabang_rp" class="form-label">Cabang</label>
                          <input type="text" name="edit_omzet_cabang_rp" id="edit_omzet_cabang_rp" class="form-control" value="@labulCurrency($omzet->cabang_rp)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_omzet_harian" class="form-label">Omzet Harian</label>
                          <input type="text" name="edit_omzet_omzet_harian" id="edit_omzet_omzet_harian" class="form-control" value="@labulCurrency($omzet->omzet_harian)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_omzet_terbayar" class="form-label">Omzet Terbayar</label>
                          <input type="text" name="edit_omzet_omzet_terbayar" id="edit_omzet_omzet_terbayar" class="form-control" value="@labulCurrency($omzet->omzet_terbayar)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_leads" class="form-label">Leads</label>
                          <input type="text" name="edit_omzet_leads" id="edit_omzet_leads" class="form-control" value="{{ $omzet->leads }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_konsumen_bertanya" class="form-label">Konsumen Bertanya</label>
                          <input type="text" name="edit_omzet_konsumen_bertanya" id="edit_omzet_konsumen_bertanya" class="form-control" value="{{ $omzet->konsumen_bertanya }}">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_cetak_banner_harian" class="form-label">Cetak Banner Harian</label>
                          <input type="text" name="edit_omzet_cetak_banner_harian" id="edit_omzet_cetak_banner_harian" class="form-control" value="@labulCurrency($omzet->cetak_banner_harian)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_cetak_a3_harian" class="form-label">Cetak A3 Harian</label>
                          <input type="text" name="edit_omzet_cetak_a3_harian" id="edit_omzet_cetak_a3_harian" class="form-control" value="@labulCurrency($omzet->cetak_a3_harian)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_print_outdoor" class="form-label">Print Outdoor</label>
                          <input type="text" name="edit_omzet_print_outdoor" id="edit_omzet_print_outdoor" class="form-control" value="@labulCurrency($omzet->print_outdoor)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_print_indoor" class="form-label">Print Indoor</label>
                          <input type="text" name="edit_omzet_print_indoor" id="edit_omzet_print_indoor" class="form-control" value="@labulCurrency($omzet->print_indoor)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_offset" class="form-label">Offset</label>
                          <input type="text" name="edit_omzet_offset" id="edit_omzet_offset" class="form-control" value="@labulCurrency($omzet->offset)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_merchandise" class="form-label">Merchandise</label>
                          <input type="text" name="edit_omzet_merchandise" id="edit_omzet_merchandise" class="form-control" value="@labulCurrency($omzet->merchandise)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_akrilik" class="form-label">Akrilik</label>
                          <input type="text" name="edit_omzet_akrilik" id="edit_omzet_akrilik" class="form-control" value="@labulCurrency($omzet->akrilik)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_design" class="form-label">Design</label>
                          <input type="text" name="edit_omzet_design" id="edit_omzet_design" class="form-control" value="@labulCurrency($omzet->design)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_laminasi_dingin" class="form-label">Laminasi Dingin</label>
                          <input type="text" name="edit_omzet_laminasi_dingin" id="edit_omzet_laminasi_dingin" class="form-control" value="@labulCurrency($omzet->laminasi_dingin)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_laminasi_a3" class="form-label">Laminasi A3</label>
                          <input type="text" name="edit_omzet_laminasi_a3" id="edit_omzet_laminasi_a3" class="form-control" value="@labulCurrency($omzet->laminasi_a3)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_fotocopy" class="form-label">Fotocopy</label>
                          <input type="text" name="edit_omzet_fotocopy" id="edit_omzet_fotocopy" class="form-control" value="@labulCurrency($omzet->fotocopy)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_dtf" class="form-label">DTF</label>
                          <input type="text" name="edit_omzet_dtf" id="edit_omzet_dtf" class="form-control" value="@labulCurrency($omzet->dtf)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_uv" class="form-label">UV</label>
                          <input type="text" name="edit_omzet_uv" id="edit_omzet_uv" class="form-control" value="@labulCurrency($omzet->uv)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_advertising_produk" class="form-label">Advertising Produk</label>
                          <input type="text" name="edit_omzet_advertising_produk" id="edit_omzet_advertising_produk" class="form-control" value="@labulCurrency($omzet->advertising_produk)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_advertising_jasa" class="form-label">Advertising Jasa</label>
                          <input type="text" name="edit_omzet_advertising_jasa" id="edit_omzet_advertising_jasa" class="form-control" value="@labulCurrency($omzet->advertising_jasa)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_cash_harian" class="form-label">Cash Harian</label>
                          <input type="text" name="edit_omzet_cash_harian" id="edit_omzet_cash_harian" class="form-control" value="@labulCurrency($omzet->cash_harian)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_piutang_bulan_berjalan" class="form-label">Piutang Bulan Berjalan</label>
                          <input type="text" name="edit_omzet_piutang_bulan_berjalan" id="edit_omzet_piutang_bulan_berjalan" class="form-control" value="@labulCurrency($omzet->piutang_bulan_berjalan)">
                        </div>
                        <div class="mb-3">
                          <label for="edit_omzet_piutang_terbayar" class="form-label">Piutang Terbayar</label>
                          <input type="text" name="edit_omzet_piutang_terbayar" id="edit_omzet_piutang_terbayar" class="form-control" value="@labulCurrency($omzet->piutang_terbayar)">
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
                            <input type="text" name="omzet_cabang_pencapaian_omset_sales[]" id="omzet_cabang_pencapaian_omset_sales" class="pencapaian_omset_sales form-control"
                              @foreach ($omzet_sales as $item_omzet_sales)
                                @if ($item_omzet_sales->karyawan_id == $item->id)
                                  value="@labulCurrency($item_omzet_sales->pencapaian_omzet)"
                                @endif
                              @endforeach
                            >
                          </div>
                          <div class="mb-3">
                            <label for="omzet_cabang_pencapaian_cash_sales" class="form-label">Pencapaian Cash Sales</label>
                            <input type="text" name="omzet_cabang_pencapaian_cash_sales[]" id="omzet_cabang_pencapaian_cash_sales" class="pencapaian_cash_sales form-control"
                              @foreach ($omzet_sales as $item_omzet_sales)
                                @if ($item_omzet_sales->karyawan_id == $item->id)
                                  value="@labulCurrency($item_omzet_sales->pencapaian_cash)"
                                @endif
                              @endforeach
                            >
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
    let retail = document.getElementById("edit_omzet_retail");
    retail.addEventListener("keyup", function(e) {
      retail.value = formatRupiah(this.value, "");
    });

    let instansi = document.getElementById("edit_omzet_instansi");
    instansi.addEventListener("keyup", function(e) {
      instansi.value = formatRupiah(this.value, "");
    });

    let reseller = document.getElementById("edit_omzet_reseller");
    reseller.addEventListener("keyup", function(e) {
      reseller.value = formatRupiah(this.value, "");
    });

    let cabang = document.getElementById("edit_omzet_cabang_rp");
    cabang.addEventListener("keyup", function(e) {
      cabang.value = formatRupiah(this.value, "");
    });

    let omzet_harian = document.getElementById("edit_omzet_omzet_harian");
    omzet_harian.addEventListener("keyup", function(e) {
      omzet_harian.value = formatRupiah(this.value, "");
    });

    let omzet_terbayar = document.getElementById("edit_omzet_omzet_terbayar");
    omzet_terbayar.addEventListener("keyup", function(e) {
      omzet_terbayar.value = formatRupiah(this.value, "");
    });

    let cetak_banner_harian = document.getElementById("edit_omzet_cetak_banner_harian");
    cetak_banner_harian.addEventListener("keyup", function(e) {
      cetak_banner_harian.value = formatRupiah(this.value, "");
    });

    let cetak_a3_harian = document.getElementById("edit_omzet_cetak_a3_harian");
    cetak_a3_harian.addEventListener("keyup", function(e) {
      cetak_a3_harian.value = formatRupiah(this.value, "");
    });

    let print_outdoor = document.getElementById("edit_omzet_print_outdoor");
    print_outdoor.addEventListener("keyup", function(e) {
      print_outdoor.value = formatRupiah(this.value, "");
    });

    let print_indoor = document.getElementById("edit_omzet_print_indoor");
    print_indoor.addEventListener("keyup", function(e) {
      print_indoor.value = formatRupiah(this.value, "");
    });

    let offset = document.getElementById("edit_omzet_offset");
    offset.addEventListener("keyup", function(e) {
      offset.value = formatRupiah(this.value, "");
    });

    let merchandise = document.getElementById("edit_omzet_merchandise");
    merchandise.addEventListener("keyup", function(e) {
      merchandise.value = formatRupiah(this.value, "");
    });

    let akrilik = document.getElementById("edit_omzet_akrilik");
    akrilik.addEventListener("keyup", function(e) {
      akrilik.value = formatRupiah(this.value, "");
    });

    let design = document.getElementById("edit_omzet_design");
    design.addEventListener("keyup", function(e) {
      design.value = formatRupiah(this.value, "");
    });

    let laminasi_dingin = document.getElementById("edit_omzet_laminasi_dingin");
    laminasi_dingin.addEventListener("keyup", function(e) {
      laminasi_dingin.value = formatRupiah(this.value, "");
    });

    let laminasi_a3 = document.getElementById("edit_omzet_laminasi_a3");
    laminasi_a3.addEventListener("keyup", function(e) {
      laminasi_a3.value = formatRupiah(this.value, "");
    });

    let fotocopy = document.getElementById("edit_omzet_fotocopy");
    fotocopy.addEventListener("keyup", function(e) {
      fotocopy.value = formatRupiah(this.value, "");
    });

    let dtf = document.getElementById("edit_omzet_dtf");
    dtf.addEventListener("keyup", function(e) {
      dtf.value = formatRupiah(this.value, "");
    });

    let uv = document.getElementById("edit_omzet_uv");
    uv.addEventListener("keyup", function(e) {
      uv.value = formatRupiah(this.value, "");
    });

    let advertising_produk = document.getElementById("edit_omzet_advertising_produk");
    advertising_produk.addEventListener("keyup", function(e) {
      advertising_produk.value = formatRupiah(this.value, "");
    });

    let advertising_jasa = document.getElementById("edit_omzet_advertising_jasa");
    advertising_jasa.addEventListener("keyup", function(e) {
      advertising_jasa.value = formatRupiah(this.value, "");
    });

    let cash_harian = document.getElementById("edit_omzet_cash_harian");
    cash_harian.addEventListener("keyup", function(e) {
      cash_harian.value = formatRupiah(this.value, "");
    });

    let piutang_bulan_berjalan = document.getElementById("edit_omzet_piutang_bulan_berjalan");
    piutang_bulan_berjalan.addEventListener("keyup", function(e) {
      piutang_bulan_berjalan.value = formatRupiah(this.value, "");
    });

    let piutang_terbayar = document.getElementById("edit_omzet_piutang_terbayar");
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