@extends('layouts.app')

@section('style')
@endsection

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
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="activity_plan" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">activity plan</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="data_member" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">data member</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="reseller" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">reseller</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="data_reseller" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">data reseller</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="instansi" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">instansi</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="survey_kompetitor" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">survey kompetitor</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="komplain" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">komplain (kritik & saran)</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="data_instansi" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">data instansi</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="reqor" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">request & orderan tertolak</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2">
                                    <button id="omzet_cabang" class="btn btn-lg btn-flat btn-outline-primary btn-block text-capitalize">omzet cabang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- activity plan --}}
<div class="modal fade modal-activity-plan" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-activity-plan">
                <div class="modal-header">
                    <h5 class="modal-title">Form Activity Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="activity_plan_cabang" class="form-label">Nama Cabang</label>
                        <select name="activity_plan_cabang_id" id="activity_plan_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="activity_plan_tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="activity_plan_tanggal" id="activity_plan_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="activity_plan_jumlah_rencana_kunjungan" class="form-label">Jumlah Rencana Kunjungan</label>
                        <input type="number" name="activity_plan_jumlah_rencana_kunjungan" id="activity_plan_jumlah_rencana_kunjungan" class="form-control">
                        <div class="spinner-border spinner-border-sm mt-2 activity_plan_jumlah_rencana_kunjungan_spinner d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="list_activity_plan_rencana_kunjungan"></div>
                    <div class="mb-3">
                        <label for="activity_plan_jumlah_rencana_salescall" class="form-label">Jumlah Rencana Salescall</label>
                        <input type="number" name="activity_plan_jumlah_rencana_salescall" id="activity_plan_jumlah_rencana_salescall" class="form-control">
                        <div class="spinner-border spinner-border-sm mt-2 activity_plan_jumlah_rencana_salescall_spinner d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="list_activity_plan_rencana_salescall"></div>
                    <div class="mb-3">
                        <label for="activity_plan_jumlah_rencana_sebar_brosur" class="form-label">Jumlah Rencana Sebar Brosur</label>
                        <input type="number" name="activity_plan_jumlah_rencana_sebar_brosur" id="activity_plan_jumlah_rencana_sebar_brosur" class="form-control">
                        <div class="spinner-border spinner-border-sm mt-2 activity_plan_jumlah_rencana_sebar_brosur_spinner d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="list_activity_plan_rencana_sebar_brosur"></div>
                    <div class="mb-3">
                        <label for="activity_plan_jumlah_rencana_penawaran" class="form-label">Jumlah Rencana Penawaran</label>
                        <input type="number" name="activity_plan_jumlah_rencana_penawaran" id="activity_plan_jumlah_rencana_penawaran" class="form-control">
                        <div class="spinner-border spinner-border-sm mt-2 activity_plan_jumlah_rencana_penawaran_spinner d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="list_activity_plan_rencana_penawaran"></div>
                    <div class="mb-3">
                        <label for="activity_plan_jumlah_penawaran_merchant" class="form-label">Jumlah Penawaran Merchant</label>
                        <input type="number" name="activity_plan_jumlah_penawaran_merchant" id="activity_plan_jumlah_penawaran_merchant" class="form-control">
                        <div class="spinner-border spinner-border-sm mt-2 activity_plan_jumlah_penawaran_merchant_spinner d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="list_activity_plan_penawaran_merchant"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-activity-plan-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-activity-plan-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- data member --}}
<div class="modal fade modal-data-member" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-data-member">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="data_member_cabang" class="form-label">Nama Cabang</label>
                        <select name="data_member_cabang_id" id="data_member_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="data_member_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="data_member_tanggal" id="data_member_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_member_nama_member" class="form-label">Nama Member</label>
                        <input type="text" name="data_member_nama_member" id="data_member_nama_member" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_member_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="number" name="data_member_nomor_hp" id="data_member_nomor_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_member_alamat" class="form-label">Alamat</label>
                        <input type="text" name="data_member_alamat" id="data_member_alamat" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-data-member-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-data-member-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- reseller --}}
<div class="modal fade modal-reseller" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-reseller">
                <div class="modal-header">
                    <h5 class="modal-title">Form Reseller</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reseller_cabang" class="form-label">Nama Cabang</label>
                        <select name="reseller_cabang_id" id="reseller_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="reseller_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="reseller_tanggal" id="reseller_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reseller_reseller_id" class="form-label">Nama Reseller</label>
                        <select name="reseller_reseller_id" id="reseller_reseller_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="reseller_hasil_kunjungan" class="form-label">Hasil Kunjungan</label>
                        <input type="text" name="reseller_hasil_kunjungan" id="reseller_hasil_kunjungan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reseller_foto" class="form-label">Foto</label>
                        <input type="file" name="reseller_foto" id="reseller_foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-reseller-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-reseller-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- data reseller --}}
<div class="modal fade modal-data-reseller" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-data-reseller">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Reseller</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="data_reseller_cabang" class="form-label">Nama Cabang</label>
                        <select name="data_reseller_cabang_id" id="data_reseller_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="data_reseller_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="data_reseller_tanggal" id="data_reseller_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_reseller_nama_reseller" class="form-label">Nama Reseller</label>
                        <input type="text" name="data_reseller_nama_reseller" id="data_reseller_nama_reseller" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_reseller_nama_usaha" class="form-label">Nama Usaha</label>
                        <input type="text" name="data_reseller_nama_usaha" id="data_reseller_nama_usaha" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_reseller_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="number" name="data_reseller_nomor_hp" id="data_reseller_nomor_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_reseller_alamat" class="form-label">Alamat</label>
                        <input type="text" name="data_reseller_alamat" id="data_reseller_alamat" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-data-reseller-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-data-reseller-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- instansi --}}
<div class="modal fade modal-instansi" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-instansi">
                <div class="modal-header">
                    <h5 class="modal-title">Form Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="instansi_cabang" class="form-label">Nama Cabang</label>
                        <select name="instansi_cabang_id" id="instansi_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="instansi_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="instansi_tanggal" id="instansi_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="instansi_instansi_id" class="form-label">Nama Instansi</label>
                        <select name="instansi_instansi_id" id="instansi_instansi_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="instansi_foto" class="form-label">Foto</label>
                        <input type="file" name="instansi_foto" id="instansi_foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-instansi-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-instansi-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- survey kompetitor --}}
<div class="modal fade modal-survey-kompetitor" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-survey-kompetitor">
                <div class="modal-header">
                    <h5 class="modal-title">Form Survey Kompetitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="survey_kompetitor_cabang" class="form-label">Nama Cabang</label>
                        <select name="survey_kompetitor_cabang_id" id="survey_kompetitor_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="survey_kompetitor_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="survey_kompetitor_tanggal" id="survey_kompetitor_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="survey_kompetitor_nama_kompetitor" class="form-label">Nama Kompetitor</label>
                        <input type="text" name="survey_kompetitor_nama_kompetitor" id="survey_kompetitor_nama_kompetitor" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="survey_kompetitor_hasil_survey" class="form-label">Hasil Survey</label>
                        <input type="text" name="survey_kompetitor_hasil_survey" id="survey_kompetitor_hasil_survey" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="survey_kompetitor_promo_kompetitor" class="form-label">Promo Kompetitor</label>
                        <input type="text" name="survey_kompetitor_promo_kompetitor" id="survey_kompetitor_promo_kompetitor" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="survey_kompetitor_foto" class="form-label">Foto</label>
                        <input type="file" name="survey_kompetitor_foto" id="survey_kompetitor_foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-survey-kompetitor-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-survey-kompetitor-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- komplain --}}
<div class="modal fade modal-komplain" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-komplain">
                <div class="modal-header">
                    <h5 class="modal-title">Form Komplain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="komplain_cabang" class="form-label">Nama Cabang</label>
                        <select name="komplain_cabang_id" id="komplain_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="komplain_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="komplain_tanggal" id="komplain_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="komplain_nama_customer" class="form-label">Nama Customer</label>
                        <input type="text" name="komplain_nama_customer" id="komplain_nama_customer" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="komplain_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="komplain_nomor_hp" id="komplain_nomor_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="komplain_kritik_saran" class="form-label">Kritik & Saran</label>
                        <input type="text" name="komplain_kritik_saran" id="komplain_kritik_saran" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="komplain_penanganan_awal" class="form-label">Penanganan Awal</label>
                        <input type="text" name="komplain_penanganan_awal" id="komplain_penanganan_awal" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-komplain-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-komplain-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- data instansi --}}
<div class="modal fade modal-data-instansi" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-data-instansi">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="data_instansi_cabang" class="form-label">Nama Cabang</label>
                        <select name="data_instansi_cabang_id" id="data_instansi_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="data_instansi_tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="data_instansi_tanggal" id="data_instansi_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_instansi_pic" class="form-label">PIC</label>
                        <input type="text" name="data_instansi_pic" id="data_instansi_pic" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_instansi_nama_instansi" class="form-label">Nama Instansi</label>
                        <input type="text" name="data_instansi_nama_instansi" id="data_instansi_nama_instansi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_instansi_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="number" name="data_instansi_nomor_hp" id="data_instansi_nomor_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="data_instansi_alamat" class="form-label">Alamat</label>
                        <input type="text" name="data_instansi_alamat" id="data_instansi_alamat" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-data-instansi-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-data-instansi-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- reqor --}}
<div class="modal fade modal-reqor" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-reqor">
                <div class="modal-header">
                    <h5 class="modal-title">Form Request & Orderan Tertolak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reqor_cabang" class="form-label">Nama Cabang</label>
                        <select name="reqor_cabang_id" id="reqor_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="reqor_tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="reqor_tanggal" id="reqor_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reqor_nama_customer" class="form-label">Nama Customer</label>
                        <input type="text" name="reqor_nama_customer" id="reqor_nama_customer" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reqor_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="reqor_nomor_hp" id="reqor_nomor_hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reqor_request_produk" class="form-label">Request Produk</label>
                        <input type="text" name="reqor_request_produk" id="reqor_request_produk" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reqor_produk_tertolak" class="form-label">Produk Tertolak</label>
                        <input type="text" name="reqor_produk_tertolak" id="reqor_produk_tertolak" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="reqor_alasan" class="form-label">Alasan</label>
                        <input type="text" name="reqor_alasan" id="reqor_alasan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-reqor-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-reqor-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- omzet cabang --}}
<div class="modal fade modal-omzet-cabang" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-omzet-cabang">
                <div class="modal-header">
                    <h5 class="modal-title">Form Laporan Omzet Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="omzet_cabang_cabang" class="form-label">Nama Cabang</label>
                        <select name="omzet_cabang_cabang_id" id="omzet_cabang_cabang_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="omzet_cabang_tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="omzet_cabang_tanggal" id="omzet_cabang_tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="omzet_cabang_transaksi" class="form-label">Transaksi</label>
                        <input type="number" name="omzet_cabang_transaksi" id="omzet_cabang_transaksi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="omzet_cabang_transaksi_online" class="form-label">Transaksi Online</label>
                        <input type="number" name="omzet_cabang_transaksi_online" id="omzet_cabang_transaksi_online" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="omzet_cabang_transaksi_offline" class="form-label">Transaksi Offline</label>
                        <input type="number" name="omzet_cabang_transaksi_offline" id="omzet_cabang_transaksi_offline" class="form-control">
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
                        <label for="omzet_cabang_laminasi" class="form-label">Laminasi</label>
                        <input type="text" name="omzet_cabang_laminasi" id="omzet_cabang_laminasi" class="form-control">
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-alasan-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-alasan-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        // activity plan
        $(document).on('click', '#activity_plan', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.activity_plan") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#activity_plan_cabang_id').append(val_cabang);
                }
            })
            $('.modal-activity-plan').modal('show');
        })

        let keyupTimer;
        $(document).on('keyup', '#activity_plan_jumlah_rencana_kunjungan', function () {
            $(".activity_plan_jumlah_rencana_kunjungan_spinner").removeClass('d-none');
            $('.list_activity_plan_rencana_kunjungan').empty();
            let val_rencana_kunjungan = $('#activity_plan_jumlah_rencana_kunjungan').val();
            clearTimeout(keyupTimer);

            if (val_rencana_kunjungan != "") {
                keyupTimer = setTimeout(function () {
                    $(".activity_plan_jumlah_rencana_kunjungan_spinner").addClass('d-none');

                    let val_list_activity_plan_rencana_kunjungan = "";
                    for (let index = 1; index <= val_rencana_kunjungan; index++) {
                        val_list_activity_plan_rencana_kunjungan += '' +
                            '<div class="mb-3">' +
                                '<label for="activity_plan_rencana_kunjungan" class="form-label text-success">Rencana Kunjungan ' + index + '</label>' +
                                '<input type="number" name="activity_plan_rencana_kunjungan" id="activity_plan_rencana_kunjungan" class="form-control">' +
                            '</div>';
                    }
                    $('.list_activity_plan_rencana_kunjungan').append(val_list_activity_plan_rencana_kunjungan);
                }, 1000);
            } else {
                $(".activity_plan_jumlah_rencana_kunjungan_spinner").addClass('d-none');
            }
        })

        $(document).on('keyup', '#activity_plan_jumlah_rencana_salescall', function () {
            $(".activity_plan_jumlah_rencana_salescall_spinner").removeClass('d-none');
            $('.list_activity_plan_rencana_salescall').empty();
            let val_rencana_salescall = $('#activity_plan_jumlah_rencana_salescall').val();
            clearTimeout(keyupTimer);

            if (val_rencana_salescall != "") {
                keyupTimer = setTimeout(function () {
                    $(".activity_plan_jumlah_rencana_salescall_spinner").addClass('d-none');

                    let val_list_activity_plan_rencana_salescall = "";
                    for (let index = 1; index <= val_rencana_salescall; index++) {
                        val_list_activity_plan_rencana_salescall += '' +
                            '<div class="mb-3">' +
                                '<label for="activity_plan_rencana_salescall" class="form-label text-success">Rencana Salescall ' + index + '</label>' +
                                '<input type="number" name="activity_plan_rencana_salescall" id="activity_plan_rencana_salescall" class="form-control">' +
                            '</div>';
                    }
                    $('.list_activity_plan_rencana_salescall').append(val_list_activity_plan_rencana_salescall);
                }, 1000);
            } else {
                $(".activity_plan_jumlah_rencana_salescall_spinner").addClass('d-none');
            }
        })

        $(document).on('keyup', '#activity_plan_jumlah_rencana_sebar_brosur', function () {
            $(".activity_plan_jumlah_rencana_sebar_brosur_spinner").removeClass('d-none');
            $('.list_activity_plan_rencana_sebar_brosur').empty();
            let val_rencana_sebar_brosur = $('#activity_plan_jumlah_rencana_sebar_brosur').val();
            clearTimeout(keyupTimer);

            if (val_rencana_sebar_brosur != "") {
                keyupTimer = setTimeout(function () {
                    $(".activity_plan_jumlah_rencana_sebar_brosur_spinner").addClass('d-none');

                    let val_list_activity_plan_rencana_sebar_brosur = "";
                    for (let index = 1; index <= val_rencana_sebar_brosur; index++) {
                        val_list_activity_plan_rencana_sebar_brosur += '' +
                            '<div class="mb-3">' +
                                '<label for="activity_plan_rencana_sebar_brosur" class="form-label text-success">Rencana Sebar Brosur ' + index + '</label>' +
                                '<input type="number" name="activity_plan_rencana_sebar_brosur" id="activity_plan_rencana_sebar_brosur" class="form-control">' +
                            '</div>';
                    }
                    $('.list_activity_plan_rencana_sebar_brosur').append(val_list_activity_plan_rencana_sebar_brosur);
                }, 1000);
            } else {
                $(".activity_plan_jumlah_rencana_sebar_brosur_spinner").addClass('d-none');
            }
        })

        $(document).on('keyup', '#activity_plan_jumlah_rencana_penawaran', function () {
            $(".activity_plan_jumlah_rencana_penawaran_spinner").removeClass('d-none');
            $('.list_activity_plan_rencana_penawaran').empty();
            let val_rencana_penawaran = $('#activity_plan_jumlah_rencana_penawaran').val();
            clearTimeout(keyupTimer);

            if (val_rencana_penawaran != "") {
                keyupTimer = setTimeout(function () {
                    $(".activity_plan_jumlah_rencana_penawaran_spinner").addClass('d-none');

                    let val_list_activity_plan_rencana_penawaran = "";
                    for (let index = 1; index <= val_rencana_penawaran; index++) {
                        val_list_activity_plan_rencana_penawaran += '' +
                            '<div class="mb-3">' +
                                '<label for="activity_plan_rencana_penawaran" class="form-label text-success">Rencana Penawaran ' + index + '</label>' +
                                '<input type="number" name="activity_plan_rencana_penawaran" id="activity_plan_rencana_penawaran" class="form-control">' +
                            '</div>';
                    }
                    $('.list_activity_plan_rencana_penawaran').append(val_list_activity_plan_rencana_penawaran);
                }, 1000);
            } else {
                $(".activity_plan_jumlah_rencana_penawaran_spinner").addClass('d-none');
            }
        })

        $(document).on('keyup', '#activity_plan_jumlah_penawaran_merchant', function () {
            $(".activity_plan_jumlah_penawaran_merchant_spinner").removeClass('d-none');
            $('.list_activity_plan_penawaran_merchant').empty();
            let val_penawaran_merchant = $('#activity_plan_jumlah_penawaran_merchant').val();
            clearTimeout(keyupTimer);

            if (val_penawaran_merchant != "") {
                keyupTimer = setTimeout(function () {
                    $(".activity_plan_jumlah_penawaran_merchant_spinner").addClass('d-none');

                    let val_list_activity_plan_penawaran_merchant = "";
                    for (let index = 1; index <= val_penawaran_merchant; index++) {
                        val_list_activity_plan_penawaran_merchant += '' +
                            '<div class="mb-3">' +
                                '<label for="activity_plan_penawaran_merchant" class="form-label text-success">Rencana Penawaran Merchant ' + index + '</label>' +
                                '<input type="number" name="activity_plan_penawaran_merchant" id="activity_plan_penawaran_merchant" class="form-control">' +
                            '</div>';
                    }
                    $('.list_activity_plan_penawaran_merchant').append(val_list_activity_plan_penawaran_merchant);
                }, 1000);
            } else {
                $(".activity_plan_jumlah_penawaran_merchant_spinner").addClass('d-none');
            }
        })

        // data member
        $(document).on('click', '#data_member', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.data_member") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#data_member_cabang_id').append(val_cabang);
                }
            })
            $('.modal-data-member').modal('show');
        })

        $(document).on('submit', '#form-data-member', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-data-member')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.data_member.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-data-member-spinner').removeClass('d-none');
                    $('.btn-data-member-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // reseller
        $(document).on('click', '#reseller', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.reseller") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#reseller_cabang_id').append(val_cabang);

                    let val_reseller = '<option value="">--Pilih Reseller--</option>';
                    $.each(response.resellers, function (index, item) {
                        val_reseller += '<option value="' + item.id + '">' + item.nama_reseller + '</option>';
                    })
                    $('#reseller_reseller_id').append(val_reseller);
                }
            })
            $('.modal-reseller').modal('show');
        })

        $(document).on('submit', '#form-reseller', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-reseller')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.reseller.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-reseller-spinner').removeClass('d-none');
                    $('.btn-reseller-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // data reseller
        $(document).on('click', '#data_reseller', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.data_reseller") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#data_reseller_cabang_id').append(val_cabang);
                }
            })
            $('.modal-data-reseller').modal('show');
        })

        $(document).on('submit', '#form-data-reseller', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-data-reseller')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.data_reseller.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-data-reseller-spinner').removeClass('d-none');
                    $('.btn-data-reseller-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // instansi
        $(document).on('click', '#instansi', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.instansi") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#instansi_cabang_id').append(val_cabang);

                    let val_instansi = '<option value="">--Pilih instansi--</option>';
                    $.each(response.instansis, function (index, item) {
                        val_instansi += '<option value="' + item.id + '">' + item.nama_instansi + '</option>';
                    })
                    $('#instansi_instansi_id').append(val_instansi);
                }
            })
            $('.modal-instansi').modal('show');
        })

        $(document).on('submit', '#form-instansi', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-instansi')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.instansi.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-instansi-spinner').removeClass('d-none');
                    $('.btn-instansi-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // survey kompetitor
        $(document).on('click', '#survey_kompetitor', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.survey_kompetitor") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#survey_kompetitor_cabang_id').append(val_cabang);
                }
            })
            $('.modal-survey-kompetitor').modal('show');
        })

        $(document).on('submit', '#form-survey-kompetitor', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-survey-kompetitor')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.survey_kompetitor.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-survey-kompetitor-spinner').removeClass('d-none');
                    $('.btn-survey-kompetitor-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // komplain
        $(document).on('click', '#komplain', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.komplain") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#komplain_cabang_id').append(val_cabang);
                }
            })
            $('.modal-komplain').modal('show');
        })

        $(document).on('submit', '#form-komplain', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-komplain')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.komplain.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-komplain-spinner').removeClass('d-none');
                    $('.btn-komplain-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // data instansi
        $(document).on('click', '#data_instansi', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.data_instansi") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#data_instansi_cabang_id').append(val_cabang);
                }
            })
            $('.modal-data-instansi').modal('show');
        })

        $(document).on('submit', '#form-data-instansi', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-data-instansi')[0]);

            $.ajax({
                url: "{{ URL::route('labul.input.data_instansi.store') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-data-instansi-spinner').removeClass('d-none');
                    $('.btn-data-instansi-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil di input'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            })
        })

        // reqor
        $(document).on('click', '#reqor', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.reqor") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#reqor_cabang_id').append(val_cabang);
                }
            })
            $('.modal-reqor').modal('show');
        })

        // omzet cabang
        $(document).on('click', '#omzet_cabang', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ URL::route("labul.input.omzet_cabang") }}',
                type: 'get',
                success: function (response) {
                    let val_cabang = '<option value="">--Pilih Cabang--</option>';
                    $.each(response.cabangs, function (index, item) {
                        val_cabang += '<option value="' + item.id + '">' + item.nama_cabang + '</option>';
                    })
                    $('#omzet_cabang_cabang_id').append(val_cabang);
                }
            })
            $('.modal-omzet-cabang').modal('show');
        })
    });
</script>
@endsection
