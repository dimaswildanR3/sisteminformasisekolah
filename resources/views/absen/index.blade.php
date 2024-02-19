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
         <!-- Bagian pesan -->
   
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
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Absen</h3>
                <hr>
            </div>
        </div>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
        <div class=""style="margin-bottom:5px;">
            <div class="col">
                <form action="{{ route('input.absensi') }}" method="post">
                    @csrf
                    <button type="submit"class="btn btn-primary btn-sm my-1 mr-sm-1">Input Data Absensi</button>
                </form>
                <br>
            </div>
            <div class="row">
    <div class="col">
        <form action="{{ route('filter.absensia') }}" method="get">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="kelas">Tampilkan per Kelas:</label>
                    <select id="kelas" name="kelas" class="form-control">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $kelasOption)
                            <option value="{{ $kelasOption->kelas}}">{{ $kelasOption->kelas}}</option>
                        @endforeach
                    </select>
                
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
    </div>

        </div>
        
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th><div style="width:110px;">Nama Lengkap</div></th>
                                <th><div style="width:90px;">Absen</div></th>
                                <th><div style="width:90px;">kelas</div></th>
                                <th><div style="width:90px;">Pulang</div></th>
                                <th><div style="width:70px;">Tanggal</div></th>
                                <th><div style="width:90px;">Keterangan</div></th>
                                <th><center> Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $absen)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$absen->Pesdik->nama}}</td>
                                <td>{{$absen->Pesdik->kelas}}</td>
                                
                                <td>{{$absen->absen}}</td>
                                <td>{{$absen->pulang}}</td>
                                <td>{{$absen->tanggal}}</td>
                                <td>{{$absen->keterangan}}</td>
                                <td>
                                    <center>
                                    <div class="ok"style="width:220px;">
                                    <a href="/absen/{{$absen->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    <!-- @if (auth()->user()->role == 'admin') -->
                                    <!-- <a href="/absen/{{$absen->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a> -->
                                    {{-- <a href="/bk/{{$bk->id}}/registrasi" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-child"></i> Detail</a> --}}
                                    <!-- @endif -->
                                </div>
                            </center>
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