@extends('template/headmaster_layout/layout')
@section('status')
active
@endsection
@section('judul')
Detail Clustering

@endsection
@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small card -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $count["C1"] }}</h3>

                <p>Sangat Lemah</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $count["C2"] }}</h3>

                <p>Kelemahan Menengah</p>
            </div>
            <div class="icon">
                <i class="fa fa-pen"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $count["C3"] }}</h3>

                <p>Tidak Lemah</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-book"></i>
                    &nbsp;
                    Hasil Clustering
                </h3>
                <div class="card-tools">
                    <a class="btn btn-sm btn-success" target="_blank" href="/kakomli/clustering/detail/export"><i
                            class="fa fa-table"></i>&nbsp;Export Ke Excel</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <label for="">Sholuete Score : {{ $data["siholuete"] }}</label>
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
                            <td style="text-align: start">{{ $key["name"] }}</td>

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
                            <th width="8%">Tugas</th>
                            <th width="8%">Projek</th>
                            <th width="8%">Ujian</th>
                            <th width="8%">Presensi</th>
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
                        @foreach($item["data_jarak"] as $key)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $key["student_id"] }}</td>
                            <td style="text-align: start">{{ $key["name"] }}</td>
                            <td>{{ $key["assignment"] }}</td>
                            <td>{{ $key["project"] }}</td>
                            <td>{{ $key["exams"] }}</td>
                            <td>{{ $key["attendance_presence"] }}</td>
                            <td>{{ $key["centroid1"] }}</td>
                            <td>{{ $key["centroid2"] }}</td>
                            <td>{{ $key["centroid3"] }}</td>
                            <td>{{ $key["cluster"] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="6" rowspan="3">Centroid Lama</th>
                            <th>{{ round($item["centroid_lama"][0][0], 2) }}</th>
                            <th>{{ round($item["centroid_lama"][0][1], 2) }}</th>
                            <th>{{ round($item["centroid_lama"][0][2], 2) }}</th>
                            <th>{{ round($item["centroid_lama"][0][3], 2) }}</th>
                        </tr>
                        <tr>
                            <th>{{ round($item["centroid_lama"][1][0],2) }}</th>
                            <th>{{ round($item["centroid_lama"][1][1],2) }}</th>
                            <th>{{ round($item["centroid_lama"][1][2],2) }}</th>
                            <th>{{ round($item["centroid_lama"][1][3],2) }}</th>
                        </tr>
                        <tr>
                            <th>{{ round($item["centroid_lama"][2][0],2) }}</th>
                            <th>{{ round($item["centroid_lama"][2][1],2) }}</th>
                            <th>{{ round($item["centroid_lama"][2][2],2) }}</th>
                            <th>{{ round($item["centroid_lama"][2][3],2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" rowspan="3">Centroid Baru</th>
                            <th>{{ $item["centroid_baru"][0][0] }}</th>
                            <th>{{ $item["centroid_baru"][0][1] }}</th>
                            <th>{{ $item["centroid_baru"][0][2] }}</th>
                            <th>{{ $item["centroid_baru"][0][3] }}</th>
                        </tr>
                        <tr>
                            <th>{{ $item["centroid_baru"][1][0] }}</th>
                            <th>{{ $item["centroid_baru"][1][1] }}</th>
                            <th>{{ $item["centroid_baru"][1][2] }}</th>
                            <th>{{ $item["centroid_baru"][1][3] }}</th>
                        </tr>
                        <tr>
                            <th>{{ $item["centroid_baru"][2][0] }}</th>
                            <th>{{ $item["centroid_baru"][2][1] }}</th>
                            <th>{{ $item["centroid_baru"][2][2] }}</th>
                            <th>{{ $item["centroid_baru"][2][3] }}</th>
                        </tr>
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
</script>
@endsection