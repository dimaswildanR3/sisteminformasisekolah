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
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-user my-1 btn-sm-1"></i>Rekap Pembayaran Personal</h4>
                <hr>
            </div>
        </div>
        <div>
            <!-- <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{ route('pengguna.create') }}" role="button"><i class="fas fa-plus"></i> Tambah Administrator</a>
                <br><br>
            </div> -->
        </div>
        <div class="row table-responsive">
            <div class="col-12">
                <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama</th>                            
                            <th>Tanggal</th>
                            <th>Keteranga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($ok as $pengguna)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$pengguna->pesdik->nama}}</td>                          
                            <td>{{$pengguna->tanggal}}</td>
                            <td>{{$pengguna->keterangan ?? '-'}}</td>
                            <td>{{$pengguna->jumlah}}</td>
                            <td>
            <a href="{{ route('kuitansi.print', ['id' => $pengguna->id]) }}" target="_blank" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="fas fa-print"></i> Cetak</a>
            <!-- Add other actions/buttons here if needed -->
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