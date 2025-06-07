@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Guru
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
                    Data Guru
                </h3>
                <div class="card-tools">
                    <!--<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-upload"></i> Upload Data Excel</button>-->
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-plus"></i>Tambah Data</button>

                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Guru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 f-state">
                                            <div class="alert alert-info">
                                                <label for=""><i class="fa fa-info"></i>&nbsp;Perhatian!</label>
                                                <br>
                                                <b>Anda berada pada sesi kakomli, anda diminta untuk melakukan input username dan password untuk menambah sesi</b>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">NIP<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-address-card"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" id="insert-nip"
                                                    placeholder="masukan nip">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Nama<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" id="insert-nama"
                                                    placeholder="masukan nama">
                                                <input type="hidden" value="{{ csrf_token() }}" class="token">
                                            </div>
                                        </div>
                                        <div class="col-md-6 f-username">
                                            <label for="">Username<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" id="insert-username"
                                                    placeholder="masukan username">
                                            </div>
                                        </div>
                                        <div class="col-md-6 f-password">
                                            <label for="">Password<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" id="insert-password"
                                                    placeholder="masukan password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Role<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                                <select name="" id="insert-role" class="form-control">
                                                    <option value="guru">guru</option>
                                                    <option value="kakomli">kakomli</option>
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
                            <th>NIP</th>
                            <th>Nama</th>
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
                                    <div class="col-md-12 f-state">
                                        <div class="alert alert-warning">
                                            <label for=""><i class="fa fa-info"></i>&nbsp;Perhatian!</label>
                                            <br>
                                            <b>Anda berada pada sesi kakomli, anda diminta untuk melakukan ubah username dan password untuk menambah sesi</b>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">NIP<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control update-nip"
                                                placeholder="masukan nip">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control update-nama"
                                                placeholder="masukan nama">
                                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                                        </div>
                                    </div>
                                    <div class="col-md-6 f-username">
                                        <label for="">Username<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="update-username"
                                                placeholder="masukan username">
                                        </div>
                                    </div>
                                    <div class="col-md-6 f-password">
                                        <label for="">Password<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-key"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="update-password"
                                                placeholder="masukan password">
                                            <input type="hidden" class="form-control" id="update-old-password"
                                                placeholder="masukan password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Role<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-key"></i>
                                                </span>
                                            </div>
                                            <select name="" id="update-role" class="form-control">
                                                <option value="guru">guru</option>
                                                <option value="kakomli">kakomli</option>
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
                                                class="fa fa-plus"></i>Update
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
<script type="module" src="{{ asset('js/guru/app.js') }}"></script>
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