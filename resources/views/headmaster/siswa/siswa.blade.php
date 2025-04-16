@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
XII RPL D
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
        <div class="row">
            <div class="col-md-6">
                <!-- small card -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Jenis Kelamin Pria</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-mars"></i>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <!-- small card -->
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Jenis Kelamin Wanita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-venus"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-users"></i>
                    &nbsp;
                    Data Siswa
                </h3>
                <div class="card-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-upload"></i> Upload Excel Data</button>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-plus"></i> Tambah Data</button>

                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Siswa</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">NISN<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-id-card"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control insert-nisn"
                                                    placeholder="masukan NISN siswa">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Nama<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control upper insert-nama"
                                                    placeholder="masukan nama siswa">
                                                <input type="hidden" class="token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Jenis Kelamin</label>
                                            <select class="form-control insert-gender">
                                                <option value="">Pilih gender</option>
                                                <option value="pria">pria</option>
                                                <option value="wanita">wanita</option>
                                            </select>
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

                <table id="example2" style="text-align: center;" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jns Kelamin</th>
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
                                <h4 class="modal-title">Update Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">NISN<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-id-card"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control update-nisn"
                                                placeholder="masukan NISN siswa">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Nama<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control upper update-nama"
                                                placeholder="masukan nama siswa">
                                            <input type="hidden" class="token" value="{{ csrf_token() }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Jenis Kelamin</label>
                                        <select class="form-control update-gender">
                                            <option value="">Pilih gender</option>
                                            <option value="pria">pria</option>
                                            <option value="wanita">wanita</option>
                                        </select>
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
                                                class="fa fa-save"></i> Update
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
<script type="module" src="{{ asset('js/siswa/app.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
@endsection