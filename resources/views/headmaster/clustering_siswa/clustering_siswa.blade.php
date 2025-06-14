@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Clustering Siswa
@endsection
@section('css')
<style>
    sup {
        color: red;
    }
    .align-kiri {
        text-align: left !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible information-status">
            <h5><i class="icon fas fa-ban information-title"></i></h5>
            <p class="information-message">Siswa termasuk dalam risiko tinggi lemah di dalam mata pelajaran, segera
                lakukan perbaikan</p>
        </div>
    </div>
    <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <button class="btn btn-success btn-xl">
                        <i class="fa fa-chart-bar"></i>
                    </button>
                    &nbsp;
                    Biodata Siswa
                </h3>
            </div>
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/dist/img/student.png') }}"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center biodata-nama">Ridho ArifW</h3>

                <p class="text-muted text-center">Siswa</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nama</b> <b class="float-right biodata-nama">Ridho Arif W</b>
                    </li>
                    <li class="list-group-item">
                        <b>ID/NISN</b> <b class="float-right biodata-nisn">543</b>
                    </li>
                    <li class="list-group-item">
                        <b>Status Siswa</b> <span class="badge badge-danger float-right biodata-risiko">High Risk</span>
                    </li>
                    <li class="list-group-item">
                        <strong><u>Catatan Khusus: </u></strong>

                        <p class="text-muted">
                            Siswa Memerlukan perbaikan di mata pelajaran
                            <b class="color-red rekomendasi-belajar" style="color: red">IOT, PWPB</b>
                        </p>
                    </li>
                    <li class="list-group-item rekomendasi-tambah-nilai">

                    </li>
                </ul>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i
                                class="fa fa-user"></i>&nbsp;Cluster Siswa</a>

                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mapel</th>
                                    <th>Th Ajaran</th>
                                    <th>Semester</th>
                                    <th>Cluster</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection
@section('js')
<script type="module" src="{{ asset('js/detail_clustering_siswa/app.js') }}"></script>
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
    
  });
</script>

@endsection