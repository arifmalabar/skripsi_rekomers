@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Kelas
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
                    Data Kelas
                </h3>
                <div class="card-tools">

                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-plus"></i> Tambah Data</button>

                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Jurusan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Nama Kelas<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-university"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control upper insert-nama-kelas"
                                                    placeholder="masukan nama kelas">
                                                    <input type="hidden" class="token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Jurusan<sup>*</sup></label>
                                            <select class="form-control select2bs4 list-jurusan insert-kode-jurusan" style="width: 100%;">
                                                <option selected="selected">Pilih Jurusan</option>
                                                
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
                                            <button type="button" style="width: 100%" class="btn btn-primary btn-tambah"><i
                                                   data-dismiss="modal" class="fa fa-plus"></i>Tambah Data</button>
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
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control list-jurusan" style="position: absolute; z-index: 10;">
                            <option selected="selected">Pilih Jurusan</option>
                            <option>RPL</option>
                            <option>TKJ</option>
                            <option>Metro</option>
                        </select>
                    </div>
                </div>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Jml Siswa</th>
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
                                <h4 class="modal-title">Update Data Jurusan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Nama Kelas<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-university"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control upper update-nama-kelas"
                                                placeholder="masukan nama kelas">
                                                <input type="hidden" class="token" value="{{ csrf_token() }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Jurusan<sup>*</sup></label>
                                        <select class="form-control list-jurusan update-kode-jurusan" style="width: 100%;">
                                            <option selected="selected">Pilih Jurusan</option>
                                            
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
                                        <button type="button" style="width: 100%" class="btn btn-warning btn-proses-update"><i
                                               data-dismiss="modal" class="fa fa-plus"></i>Update Data</button>
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
<script type="module" src="{{ asset("js/kelas/app.js") }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements

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