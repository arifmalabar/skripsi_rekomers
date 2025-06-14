@extends('template.headmaster_layout.layout')
@section('status')
active
@endsection
@section('judul')
Penilaian
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-book"></i>
                    &nbsp;
                    Data Penilaian Siswa
                </h3>
                <div class="card-tools">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-plus"></i>Tambah Data</button>

                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Penilaian</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Mata Pelajaran<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-address-card"></i>
                                                    </span>
                                                </div>
                                                <select name="" id="insert-mapel" class="form-control cb-mapel">
                                                    <option value="">Pilih asMapel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Tahun Ajaran<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <select name="" id="insert-thajaran" class="form-control cb-thajar">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                </select>
                                                <input type="hidden" value="{{ csrf_token() }}" class="token">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Semester<sup>*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-book"></i>
                                                    </span>
                                                </div>
                                                <select name="" id="insert-semester" class="form-control cb-semester">
                                                    <option value="">Pilih Semester</option>
                                                </select>
                                                <input type="hidden" value="{{ csrf_token() }}" class="token">
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
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Semster</th>
                            <th>Tahun Ajaran</th>
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
                                <h4 class="modal-title">Update Data Penilaian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Mata Pelajaran<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                            </div>
                                            <select name="" id="update-mapel" class="form-control cb-mapel">
                                                <option value="">Pilih Mapel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Tahun Ajaran<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                            <select name="" id="update-thajaran" class="form-control cb-thajar">
                                                <option value="">Pilih Tahun Ajaran</option>
                                            </select>
                                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Semester<sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-book"></i>
                                                </span>
                                            </div>
                                            <select name="" id="update-semester" class="form-control cb-semester">
                                                <option value="">Pilih Semester</option>
                                            </select>
                                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                                            <input type="hidden" value="" id="last_course_id">
                                            <input type="hidden" id="last_year">
                                            <input type="hidden" id="last_semester">
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
<script type="module" src="{{ asset('js/penilaian/app.js') }}"></script>
@endsection