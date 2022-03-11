@extends('layouts.app')

@section('style')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Approve</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Approve</li>
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
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row data-approve">
                                {{-- data di jquery --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" class="form-create" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            {{-- data di jquery --}}
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('script')

<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>

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

        // show data
        dataCuti();
        function dataCuti() {
            $.ajax({
                url: "{{ URL::route('cuti_approve.get_cuti') }}",
                type: 'GET',
                success: function (response) {
                    let data_approve = "";
                    $.each(response.approves, function (index, item) {
                        data_approve += "" +
                        "<div class=\"col-lg-3 col-md-4 col-sm-12 col-12\">" +
                            "<div class=\"card card-primary\">" +
                                "<div class=\"card-header\">" +
                                    "<h3 class=\"card-title\">" + item.role.nama + "</h3>" +
                                    "<div class=\"card-tools\">" +
                                        "<button type=\"button\" class=\"btn btn-tool\">" +
                                            "<i class=\"fas fa-times\"></i>" +
                                        "</button>" +
                                    "</div>" +
                                "</div>" +
                                "<div class=\"card-body\">";
                                    $.each(response.approve_details, function (index_detail, item_detail) {
                                        if (item.role_id == item_detail.role_id) {
                                        data_approve += "" +
                                            "<div class=\"row\">" +
                                                "<div class=\"col-lg-12 col-md-12 col-sm-12 col-12\">" +
                                                    "<input type=\"text\" id=\"hirarki_" + item_detail.id + "\" name=\"hirarki_" + item_detail.id + "\" value=\"" + item_detail.hirarki + "\">" +
                                                    "<label for=\"atasan_id_" + item_detail.role_id + "\">Approval " + item_detail.hirarki + "</label>" +
                                                    "<div class=\"select2-primary\">" +
                                                        "<select id=\"atasan_id_" + item_detail.id + "\" data-id=\"" + item_detail.id + "\" name=\"atasan_id[]\" class=\"select2\" multiple=\"multiple\" data-placeholder=\"Pilih Approval\" data-dropdown-css-class=\"select2-primary\" style=\"width: 100%;\">";
                                                            $.each(response.roles, function (index, item) {
                                                                data_approve += "<option>" + item.nama + "</option>"
                                                            });
                                                        data_approve += "</select>" +
                                                    "</div>" +
                                                "</div>" +
                                            "</div>";
                                        }
                                    });
                                data_approve += "" +
                                    "<div class=\"row mt-3\">" +
                                        "<div class=\"col-lg-12 col-md-12 col-sm-12 col-12\">" +
                                            "<button type=\"button\" class=\"btn btn-default\"><i class=\"fas fa-plus\"></i></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>";
                    });
                    $('.data-approve').append(data_approve);

            $('.select2').select2();
                }
            })
        }

        // create
        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('cuti_approve.create') }}",
                type: 'GET',
                success: function (response) {
                    // role
                    let value_role = "<option value=\"\">--Pilih Role--</option>";
                    $.each(response.roles, function (index, item) {
                        value_role += "<option value=\"" + item.id + "\">" + item.nama + "</opotion>";
                    });
                    $('#role_id').append(value_role);
                }
            });
            $('.modal-form').modal('show');
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#role_id').focus();
        });

        $(document).on('submit', '.form-create', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form')[0]);

            $.ajax({
                url: "{{ URL::route('cuti_approve.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    console.log(response);
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil ditambah'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // on change approver
        $(document).on('change', '.select2', function () {
            let id = $(this).attr('data-id');

            let formData = {
                id: id,
                hirarki: $('#hirarki_' + id).val(),
                atasan_id: $('#atasan_id_' + id).val()
            }

            $.ajax({
                url: "{{ URL::route('cuti_approve.update_approve') }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                }
            });
        });

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("cabang.delete_btn", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#delete_id').val(response.id);
                    $('.modal-delete').modal('show');
                }
            });
        });

        $('#form-delete').submit(function (e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('cabang.delete') }}",
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.btn-delete-spinner').css('display', 'block');
                    $('.btn-delete-yes').css('display', 'none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhar.statusText

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    });
</script>

@endsection
