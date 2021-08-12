@extends('layouts.app')

@section('style')

<script type="text/javascript" src="{{ asset('plugins/chart/chartjs/Chart.js') }}"></script>

@endsection

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-4 text-center">
            <h1 class="text-uppercase">Selamat Datang</h1>
            <h1 class="text-uppercase">{{ Auth::user()->name }}</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection

@section('script')

<script>

</script>

@endsection

