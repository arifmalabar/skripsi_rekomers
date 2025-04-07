@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Dashboard
@endsection
@section('content')
<div class="row">
  <div class="row">
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Siswa</span>
          <span class="info-box-number">240</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Jurusan</span>
          <span class="info-box-number">4</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="far fa-copy"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Guru</span>
          <span class="info-box-number">5</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            <button class="btn btn-success btn-xl">
              <i class="fa fa-chart-bar"></i>
            </button>
            &nbsp;
            Distribusi Tingkat Risiko Siswa
          </h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas id="barChart"
              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 765px;"
              width="765" height="250" class="chartjs-render-monitor"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-lg-12 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>50<sup>%</sup></h3>

              <p>Risiko Tinggi</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Cek <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>11<sup style="font-size: 20px">%</sup></h3>

              <p>Risiko Rendah</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Cek <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44<sup style="font-size: 20px">%</sup></h3>

              <p>Risiko Menengah</p>
            </div>
            <div class="icon">
              <i class="fa fa-chart-bar"></i>
            </div>
            <a href="#" class="small-box-footer">Cek <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
      </div>
    </div>


    <div class="col-md-6">
      <div class="card card-info card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-book"></i>
            &nbsp;
            Semester
          </h3>
          <div class="card-tools">
            <button class="btn btn-sm btn-success" data-target="#modal-lg" data-toggle="modal"><i class="fa fa-plus"></i>Tambah Data</button>
            
            <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Tambah Data Semester</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <label for="">Semester<sup>*</sup></label>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fa fa-address-card"></i>
                                          </span>
                                      </div>
                                      <input type="text" class="form-control upper" id="insert-semester"
                                          placeholder="masukan Masukan Semester">
                                          <input type="hidden" class="token" value="{{ csrf_token() }}">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <div class="row" style="width: 100%; text-align: center">
                              <div class="col-md-6">
                                  <button type="button" style="width: 100%" class="btn btn-outline-primary"
                                      data-dismiss="modal">Close</button>
                              </div>
                              <div class="col-md-6">
                                  <button type="button" style="width: 100%" class="btn btn-primary btn-tambah"
                                      data-dismiss="modal" data-dismiss="modal"><i class="fa fa-plus"></i>Tambah
                                      Data</button>
                              </div>
                          </div>


                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Ganjil</td>
                <td style="text-align: center">
                  <button class="btn btn-outline-warning btn-sm">
                    <i class="fa fa-edit"></i>
                    Update
                  </button>
                  <button class="btn btn-outline-danger btn-sm">
                    <i class="fa fa-trash"></i>
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="modal fade" id="modal-update-semester">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Update Data Semester</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Semester<sup>*</sup></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-address-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control upper" id="update-semester"
                                        placeholder="masukan Masukan Semester">
                                        <input type="hidden" class="token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row" style="width: 100%; text-align: center">
                            <div class="col-md-6">
                                <button type="button" style="width: 100%" class="btn btn-outline-warning"
                                    data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" style="width: 100%" class="btn btn-warning btn-proses-update"
                                    data-dismiss="modal" data-dismiss="modal"><i class="fa fa-plus"></i>Update
                                    Data</button>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-6">
      <div class="card card-info card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-book"></i>
            &nbsp;
            Tahun Ajaran
          </h3>
          <div class="card-tools">
            <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Tambah Data</button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Th Ajaran</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>2024-2025</td>
                <td style="text-align: center">
                  <button class="btn btn-outline-warning btn-sm">
                    <i class="fa fa-edit"></i>
                    Update
                  </button>
                  <button class="btn btn-outline-danger btn-sm">
                    <i class="fa fa-trash"></i>
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="module" src="{{ asset("js/semester/app.js") }}"></script>
<script>
  $(function () {
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
        labels  : ['Risiko Tinggi', 'Risiko Tengah', 'Risiko Rendah'],
        datasets: [
            {
            label               : 'Digital Goods',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [28, 48, 40, 19, 86, 27, 90]
            },
            {
            label               : 'Electronics',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [65, 59, 80, 81, 56, 55, 40]
            },
        ]
        }

        var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
            gridLines : {
                display : false,
            }
            }],
            yAxes: [{
            gridLines : {
                display : false,
            }
            }]
        }
        }

        
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
        }

        new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
        })
    });
    $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection