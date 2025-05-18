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
          <span class="info-box-number jml_siswa">0</span>
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
          <span class="info-box-number jml_jurusan">0 </span>
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
          <span class="info-box-number jml_guru">0</span>
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
              <h3 class="high-risk">0<sup>%</sup></h3>

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
              <h3 class="mid-risk"><sup style="font-size: 20px">%</sup></h3>

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
              <h3 class="low-risk">44<sup style="font-size: 20px">%</sup></h3>

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
            <button class="btn btn-sm btn-success" data-target="#modal-lg" data-toggle="modal"><i
                class="fa fa-plus"></i>Tambah Data</button>

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
            <button class="btn btn-sm btn-success" data-target="#modal-tambah-thajar" data-toggle="modal"><i
                class="fa fa-plus"></i>Tambah Data</button>

            <div class="modal fade" id="modal-tambah-thajar">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Tahun Ajaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="">Tahun<sup>*</sup></label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="number" class="form-control upper" id="insert-tahun-ajar"
                            placeholder="masukan Masukan Tahun Ajaran">
                          <input type="hidden" class="token" value="{{ csrf_token() }}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="">Periode Ajaran<sup>*</sup></label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="fa fa-times"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control upper" id="insert-periode"
                            placeholder="masukan Masukan Periode Ajaran">
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
                        <button type="button" style="width: 100%" class="btn btn-primary btn-tambah-thajar"
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
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Periode Ajaran</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <div class="modal fade" id="modal-update-thajar">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h4 class="modal-title">Update Data Tahun Ajaran</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="">Tahun<sup>*</sup></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </div>
                        <input type="number" class="form-control upper" id="update-tahun-ajar"
                          placeholder="masukan Masukan Tahun Ajaran">
                        <input type="hidden" class="token" value="{{ csrf_token() }}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="">Periode Ajaran<sup>*</sup></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-times"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control upper" id="update-periode"
                          placeholder="masukan Masukan Periode Ajaran">
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
                      <button type="button" style="width: 100%" class="btn btn-warning btn-proses-update-thajar"
                        data-dismiss="modal" data-dismiss="modal"><i class="fa fa-save"></i>Update
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
</div>
@endsection
@section('js')
<script type="module" src="{{ asset('js/dashboard/app.js') }}"></script>
<script type="module" src="{{ asset('js/semester/app.js') }}"></script>
<script type="module" src="{{ asset('js/tahun_ajaran/app.js') }}"></script>
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

        
    });
    $(function () {
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