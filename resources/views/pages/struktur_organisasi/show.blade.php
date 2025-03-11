@extends('layouts.app')
@section('style')
<!-- Plugin OrgChart.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.0/css/jquery.orgchart.min.css">
<style>
  .orgchart {
    background: transparent !important;
  }
  #chart-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Agar vertikal di tengah */
    overflow-x: auto; /* Supaya bisa digeser jika terlalu besar */
  }
  #chart-container { width: 100%; height: auto; text-align: center; }
  .orgchart .node {
      padding: 10px;
      border-radius: 10px;
      text-align: center;
      color: white;
      position: relative;
  }
  .orgchart .node .button-container {
      margin-top: 5px;
  }
  .orgchart .node .button-container button {
      padding: 5px 10px;
      border: none;
      cursor: pointer;
      font-size: 12px;
      border-radius: 5px;
  }
  .btn-view { background-color: #007BFF; color: white; }
  .btn-edit { background-color: #28A745; color: white; }
  .btn-delete { background-color: #DC3545; color: white; }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header"></section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div id="chart-container"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.0/js/jquery.orgchart.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      url: "{{ route('struktur.get') }}",
      type: 'GET',
      dataType: 'json',
      success: function(data) {        
        // $('#chart-container').orgchart({
        //   'data': data[0],
        //   'nodeContent': 'title',
        //   'pan': true,
        //   'zoom': true
        // });
        let orgData = transformData(data);
        console.log(orgData);
        
        $('#chart-container').orgchart({
            'data': orgData[0],
            'nodeContent': 'title',
            'pan': true,
            'zoom': true,
            'createNode': function($node, data) {
                $node.css('background-color', data.color); // Atur warna latar belakang

                // Tambahkan tombol dalam node
                let buttons = `
                    <div class="button-container">
                        <button class="btn-view" onclick="viewDetail(${data.id})">Lihat</button>
                        <button class="btn-edit" onclick="editNode(${data.id})">Edit</button>
                        <button class="btn-delete" onclick="deleteNode(${data.id})">Hapus</button>
                    </div>
                `;
                $node.append(buttons);
            }
        });
      },
      error: function(xhr, status, error) {
        console.error('Gagal mengambil data:', error);
      }
    });

    function transformData(data) {
        return data.map(item => ({
            id: item.id,
            name: item.name,
            title: item.title,
            color: item.color,
            children: item.children.length > 0 ? transformData(item.children) : []
        }));
    }

    function viewDetail(id) {
        alert('Melihat detail ID: ' + id);
    }

    function editNode(id) {
        alert('Mengedit ID: ' + id);
    }

    function deleteNode(id) {
        if (confirm('Hapus ID ' + id + '?')) {
            alert('ID ' + id + ' berhasil dihapus.');
        }
    }
    // var chartData = {
    //     'id': '1',
    //     'name': 'CEO',
    //     'title': 'tes',
    //     'children': [
    //         { 'name': 'gg 1', 'children': [
    //             { 'name': 'Employee 1', 'children' : [
    //               { 'name': 'Employee 2' },
    //               { 'name': 'Employee 2' },
    //               { 'name': 'Employee 2' }
    //             ]},
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' },
    //             { 'name': 'Employee 2' }
    //         ]},
    //         { 'name': 'Manager 2', 'children': [
    //             { 'name': 'Employee 3' }
    //         ]}
    //     ]
    // };

    // $('#chart-container').orgchart({
    //     'data' : chartData,
    //     'nodeContent': 'title'
    // });
  });
</script>
@endsection