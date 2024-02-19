@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
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
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Anggota Perpustakaan</h3>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">                                
                                <th><div style="width:110px;">No.</div></th>
                                <th><div style="width:100px;">Image</div></th>
                                <th><div style="width:110px;">Nama Lengkap</div></th>
                                <th><div style="width:110px;">NISN</div></th>
                                <th><div style="width:100px;">Tempat Lahir</div></th>
                                <th><div style="width:100px;">Tanggal Lahir</div></th>
                                <th><div style="width:110px;">Jenis Kelamin</div></th>
                                <th><div style="width:100px;">Tingkat Kelas</div></th>
                                <th><center> Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $anggota_perpus)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                            <td>
                                @if( in_array(pathinfo($anggota_perpus->image, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                    <img src="{{asset('image_upload')}}/{{$anggota_perpus->image}}" style="height: 250px;width:200px;">
                                @endif 
                            </td>                               
                                <td>{{$anggota_perpus->nama}}</td>
                                <td>{{$anggota_perpus->nisn}}</td>                                                                
                                <td>{{$anggota_perpus->tempat_lahir}}</td>
                                <td>{{$anggota_perpus->tgl_lahir}}</td>
                                <td>{{$anggota_perpus->jk}}</td>
                                <td>{{$anggota_perpus->tingkat_kelas}}</td>                            
                                <td>
                                    <div class="ok"style="width:220px;">
                                    <a href="/perpus/anggota/{{$anggota_perpus->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    {{-- @if (auth()->user()->role == 'admin') --}}
                                    <a href="/perpus/anggota/{{$anggota_perpus->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a>
                                    {{-- <a href="/perpus/anggota/{{$anggota_perpus->id}}/show" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-child"></i> Detail</a> --}}
                                    {{-- @endif --}}
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection