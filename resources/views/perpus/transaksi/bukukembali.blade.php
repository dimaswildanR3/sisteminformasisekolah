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
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data pengembali Buku Perpustakaan</h3>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="index" role="button"><i class="fas fa-folder"></i>  Data Pinjam</a>
                {{-- <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i> Tambah Data</a> --}}
              <br>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id=''>
                        <thead>
                            <tr class="bg-light">                                
                                <th><div style="width:110px;">No.</div></th>
                                <th><div style="width:110px;">Kode Transaksi</div></th>
                                <th><div style="width:110px;">Buku</div></th>
                                
                                <th><div style="width:110px;">Nama Pesdik</div></th>
                                <th><div style="width:100px;">Tanggal Pinjam</div></th>
                                <th><div style="width:100px;">Tanggal Kembali</div></th>
                                <th><div style="width:110px;">Status</div></th>
                                {{-- <th><div style="width:100px;">Action</div></th> --}}
                                <th><center> Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $data)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>                                
                                <td>{{$data->kode_transaksi}}</td>
                                <td>{{$data->buku->judul}}</td>                                                                
                                
                                <td>{{$data->pesdik->nama}}</td>
                                <td>{{date('d/m/y', strtotime($data->tgl_pinjam))}}</td>
                                <td>{{date('d/m/y', strtotime($data->tgl_kembali))}}</td>
                                <td>
                          @if($data->status == 'pinjam')
                            <label class="badge badge-warning">Pinjam</label>
                          @else
                            <label class="badge badge-success">Kembali</label>
                          @endif
                          </td>                         
                               <td>
                          @if(Auth::user()->level == 'admin')
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                          @if($data->status == 'kembali')
                          <form action="{{ route('transaksi', $data->id.'update') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin data ini sudah kembali?')"> Sudah Kembali
                            </button>
                          </form>
                          @endif
                            <form action="{{ route('/perpus/transaksi/',$data->id,'/delete') }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                          </div>
                        </div>
                        @else
                        @if($data->status == 'pinjam')
                        <a href="/perpus/transaksi/{{$data->id}}/edit" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button class="btn btn-info btn-xs" onclick="return confirm('Anda yakin data ini sudah kembali?')">Sudah Kembali
                            </button>
                          </form>
                          @else
                          -
                          @endif
                        @endif
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