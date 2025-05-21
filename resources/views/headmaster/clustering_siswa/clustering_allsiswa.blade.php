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
                    Clustering All Siswa
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
                            <th>Nama</th>
                            <th>Cluster</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
</div>
@endsection
@section('js')
<script type="module" src="{{ asset('js/detail_clustering_allsiswa/app.js') }}"></script>

@endsection