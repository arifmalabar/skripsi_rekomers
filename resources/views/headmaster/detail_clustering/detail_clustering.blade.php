@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Detail Clustering

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-book"></i>
                    &nbsp;
                    Hasil Clustering
                </h3>
                <div class="card-tools">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-lg"><i
                            class="fa fa-sync"></i>&nbsp;Sinkronasi Data</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Centroid 1</th>
                            <th>Centroid 2</th>
                            <th>Centroid 3</th>
                            <th>Cluster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($data["hasil"] as $key)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><a href="{{ url("kakomli/detail_cluster/clustering_siswa/".$key["student_id"]."")}}">{{
                                    $key["student_id"] }}</a></td>
                            <td>{{ $key["name"] }}</td>
                            <td>{{ $key["centroid1"] }}</td>
                            <td>{{ $key["centroid2"] }}</td>
                            <td>{{ $key["centroid3"] }}</td>
                            <td>
                                @if($key["cluster"] == "C1")
                                <span class="badge badge-danger">{{ $key["cluster"] }}/High</span>
                                @elseif($key["cluster"] == "C2")
                                <span class="badge badge-warning">{{ $key["cluster"] }}/Medium</span>
                                @elseif($key["cluster"] == "C3")
                                <span class="badge badge-success">{{ $key["cluster"] }}/Less</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @php
        $iterasi = 1;
        @endphp
        @foreach ($data["jarak"] as $item)
        <div class="card card-success card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-info"></i>
                    &nbsp;
                    Jarak Iterasi Ke {{ $iterasi++ }}
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Centroid 1</th>
                            <th>Centroid 2</th>
                            <th>Centroid 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($item["data_jarak"] as $key)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $key["student_id"] }}</td>
                            <td>{{ $key["name"] }}</td>
                            <td>{{ $key["centroid1"] }}</td>
                            <td>{{ $key["centroid2"] }}</td>
                            <td>{{ $key["centroid3"] }}</td>
                        </tr>
                        @endforeach
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
        @endforeach
        <!-- /.card -->
    </div>
</div>
@endsection
@section('js')
<script>
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
</script>
@endsection