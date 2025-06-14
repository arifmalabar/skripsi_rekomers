@extends('template/headmaster_layout/layout')
@section('css')
<style>
    span {
        width: 28%;
        text-transform: uppercase
    }

    .align-kiri {
        text-align: left !important;
    }
</style>
@endsection
@section('status')
active
@endsection
@section('judul')
Intepretasi

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-book"></i>
                    &nbsp;
                    Interpretasi Siswa
                </h3>
                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th style="width: 10%">NISN</th>
                            <th style="width: 50%">Nama</th>
                            <th style="width: 30%">Risiko</th>
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