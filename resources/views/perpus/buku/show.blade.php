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
        <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Data Buku</h4>
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
                                    <b>Cover</b>
                                    <br>
                                    <img src="{{asset('cover_upload')}}/{{$data->cover}}" style="height: 100%;width:100%;">
                                </div>
                                <br>
                                <li class="list-group-item">
                                    <b>Judul</b>
                                    <a class="float-right">{{$data->judul}}</a>
                                </li>
                                    <li class="list-group-item">
                                        <b>Nomer Buku</b>
                                        <a class="float-right">{{$data->isbn}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pengarang</b> <a class="float-right">{{$data->pengarang}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Penerbit</b> <a class="float-right">{{$data->penerbit}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tahun Terbit</b> <a class="float-right">{{$data->tahun_terbit}}</a>
                                    </li>
                                    <!-- <li class="list-group-item">
                                        <b>Jumlah Buku</b> <a class="float-right">{{$data->jumlah_buku}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Deskripsi</b> <a class="float-right">{{$data->deskripsi}}</a>
                                        
                                    </li>
                                    <li class="list-group-item">
                                        <b>Lokasi</b> <a class="float-right">{{$data->lokasi}}</a>
                                    </li> -->
                                </ul>
                            </div>
                            
                        </div>
                        
                    </div>
</section>
@endsection