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
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: @php echo json_encode($label); @endphp,
      datasets: [{
        label: 'Data Pengunjung',
        data: <?php echo json_encode($data); ?>,
        backgroundColor: '',
        borderColor: '#176BB3',
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>

@endsection

