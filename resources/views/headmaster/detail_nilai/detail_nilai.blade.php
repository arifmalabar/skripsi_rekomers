@extends('template.headmaster_layout.layout')
@section('status')
active
@endsection
@section('judul')
Detail Penilaian
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
                    <button class="btn btn-sm btn-primary btn-refresh"><i class="fa fa-reload"></i> Refresh</button>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-upload"></i> Import Excel</button>

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
                                            <label for="">Input Nilai Siswa</label>
                                            <input type="file" class="form-control" id="input-nilai">
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
                                            <button type="button" style="width: 100%" class="btn btn-primary btn-upload"
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
                <div class="row">
                    <div class="col-md-12">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="15%">NISN</th>
                                    <th width="20%">Nama</th>
                                    <th>Tugas</th>
                                    <th>Proyek</th>
                                    <th>Ujian</th>
                                    <th>Presensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <input type="hidden" placeholder="Input Nilai Tugas token" class="form-control input-presensi">
                        <button class="btn btn-sm btn-outline-primary w-100 btn-tambah">Simpan Data Nilai</button>
                    </div>
                </div>
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
                                            <select name="" id="update-mapel" class="form-control">
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
                                            <select name="" id="update-thajaran" class="form-control">
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
                                            <select name="" id="update-mapel" class="form-control">
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
<script type="module" src="{{ asset('js/detail_nilai/app.js') }}"></script>
<!-- SheetJS CDN -->
<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
@endsection