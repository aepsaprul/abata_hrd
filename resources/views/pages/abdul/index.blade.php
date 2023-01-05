@extends('layouts.app')

@section('style')

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
</div>

@endsection

@section('script')

<script>
  $(document).ready(function () {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
    tampil();

    function tampil() {
      $.ajax({
        url: "{{ URL::route('abdul.tampil') }}",
        success: function (response) {
          $('.content-wrapper').html(response);
        }
      })
    }

    $(document).on('click', '.btn-pengajuan', function (e) {
      e.preventDefault();
      
      $.ajax({
        url: "{{ URL::route('abdul.form_pengajuan') }}",
        success: function (response) {
          $('.content-wrapper').html(response);
        }
      })
    })

    $(document).on('click', '.btn-kembali', function (e) {
      e.preventDefault();

      $.ajax({
        url: "{{ URL::route('abdul.tampil') }}",
        success: function (response) {
          $('.content-wrapper').html(response);
        }
      })
    })

    $(document).on('click', '.btn-submit', function (e) {
      e.preventDefault();
      let nomor = $('#nomor').val();
      let karyawan_id = $('#karyawan_id').val();
      let pinjaman = $('#pinjaman').val();
      let keperluan = $('#keperluan').val();
      let gaji = $('#gaji').val();
      let angsuran = $('#angsuran').val();
      let metode_bayar = $('input[name="metode_bayar"]:checked').val();
      let metode_bayar_des;

      if (metode_bayar == 2) {
        if ($('#metode_bayar_des').val() == "") {
          $('.text-warning-metode-bayar').removeClass('d-none');

          Toast.fire({
            icon: 'error',
            title: 'Gagal'
          });
        } else {
          metode_bayar_des = $('#metode_bayar_des').val();
          kirim();
        }
      } else {
        metode_bayar_des = "";
        kirim();
      }

      function kirim() {
        let formData = {
          nomor: nomor,
          karyawan_id: karyawan_id,
          pinjaman: pinjaman,
          keperluan: keperluan,
          gaji: gaji,
          angsuran: angsuran,
          metode_bayar: metode_bayar,
          metode_bayar_des: metode_bayar_des
        }

        $.ajax({
          url: "{{ URL::route('abdul.store') }}",
          type: "post",
          data: formData,
          beforeSend: function () {
            $('.btn-spinner').removeClass('d-none');
            $('.btn-submit').addClass('d-none');
          },
          success: function (response) {
            Toast.fire({
              icon: 'success',
              title: 'Berhasil'
            });
            
            tampil();
          }
        })
      }

    })
  });
</script>

@endsection
