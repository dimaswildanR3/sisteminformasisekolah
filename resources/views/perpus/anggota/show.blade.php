@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="fas fa-check"></i> Sukses :</h5>
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('warning'))
        <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
            <h5><i class="fas fa-info"></i> Informasi :</h5>
            {{session('warning')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if ($errors->any())
        <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
            <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Anggota Perpus</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <ul class="list-group list-group mb-3">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src={{$data->image}} alt="User profile picture" style="max-height: 100px;max-width:100px">
                                    </div>
                                    <h3 class="profile-username text-center"><b>{{$data->nama}}</b></h3>
                                <br>
                                <li class="list-group-item">
                                    <b>Tempat, Tenggal lahir</b>
                                    <a class="float-right">{{$data->tempat_lahir}}, {{$data->tanggal_lahir}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b> <a class="float-right">{{$data->jenis_kelamin}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>NISN</b>
                                    <a class="float-right">{{$data->nisn}}</a>
                                </li>
                                    <li class="list-group-item">
                                        <b>Tingkat kelas</b> <a class="float-right">{{$data->tingkat_kelas}}</a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        
                    </div>
</section>
@endsection