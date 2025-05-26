@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Mata Pelajaran
@endsection
@section('css')
<style>
    sup {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-book"></i>
                    &nbsp;
                    Data Mata Pelajaran
                </h3>
                <div class="card-tools">

                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-plus"></i>Tambah Data</button>

                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Mapel</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Nama Mapel<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-address-card"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control upper" id="insert-nm-mapel"
                                                    placeholder="Masukan Nama Mapel">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Semester<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-book"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control cb-semester" id="insert-semester">
                                                    <option value="">Pilih Smt</option>
                                                </select>
                                                <input type="hidden" value="{{ csrf_token() }}" class="token">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Tahun Ajaran<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control cb-thajar" id="insert-thajar">
                                                    <option value="">Pilih Th Ajaran</option>
                                                </select>
                                                <input type="hidden" value="{{ csrf_token() }}" class="token">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Kelas<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control cb-kelas" id="insert-kelas">
                                                    <option value="">Pilih Kelas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Guru<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control cb-guru" id="insert-guru">
                                                    <option value="">Pilih Guru</option>
                                                </select>
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
                                                data-dismiss="modal"><i class="fa fa-plus"></i>Tambah
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
                <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mapel</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="modal fade" id="modal-update">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h4 class="modal-title">Update Data Guru</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nama Mapel<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control upper" id="update-nm-mapel"
                                                placeholder="Masukan Nama Mapel">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Semester<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-book"></i>
                                                </span>
                                            </div>
                                            <select class="form-control cb-semester" id="update-semester">
                                                <option value="">Pilih Smt</option>
                                            </select>
                                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tahun Ajaran<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                            <select class="form-control cb-thajar" id="update-thajar">
                                                <option value="">Pilih Th Ajaran</option>
                                            </select>
                                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kelas<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-home"></i>
                                                </span>
                                            </div>
                                            <select class="form-control cb-kelas" id="update-kelas">
                                                <option value="">Pilih Kelas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Guru<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-home"></i>
                                                </span>
                                            </div>
                                            <select class="form-control cb-guru" id="update-guru">
                                                <option value="">Pilih Guru</option>
                                            </select>
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
                                        <button type="button" style="width: 100%"
                                            class="btn btn-warning btn-proses-update" data-dismiss="modal"><i
                                                class="fa fa-save"></i>Update
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
</div>
@endsection
@section('js')
<script type="module" src="{{ asset('js/course/app.js') }}"></script>
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