@extends('layouts.master')
@section('content')
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
<section class="content card" style="padding: 10px 10px 20px 20px  ">
    <div class="box">
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Tamu</h4>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahGuru"><i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>NoNomor HP</th>
                                <th>Tujuan</th>
                                <th>Bertemu Siapa</th>
                                <th>Kedatangan</th>
                                <th>Pulang</th>
                                <th>status</th>
                                <th>KTP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $guru)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$guru->nama}}</td>
                                <td>{{$guru->alamat}}</td>
                                <td>{{$guru->no_telp}}</td>
                                <td>{{$guru->tujuan}}</td>
                                <td>{{$guru->bertemu}}</td>
                              
                                <td>{{$guru->created_at}}</td>
                                <td>{{$guru->updated_at}}</td>
                                 <td>                        
                                        <form action="{{ route('status.status', $guru->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $guru->status }}">
                                            <button type="submit" class="btn {{ $guru->status === 'pulang' ? 'btn-success' : 'btn-danger' }} btn-xs" onclick="return confirm('Anda yakin data ini akan di{{ $guru->status === 'pulang' ? 'ubah' : 'ubah' }} ?')">
                                                {{ $guru->status === 'pulang' ? 'Pulang' : 'Datang' }}
                                            </button>
                                        </form>
                                    </td>
                                
                                 <td>
                                    @if($guru->ktp)
                                    {{-- @if( in_array(pathinfo($guru->foto, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG'])) --}}
                                    <img src="{{ asset('ktp_upload/'.$guru->ktp) }}" alt="" title=""style="height: 150px;width:100px;">
                                    @else
                                    <p>Tidak ada foto.</p>
                                    @endif
                                </td>
                              
                                    <td>
                                    <!-- <a href="/tamu/{{$guru->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a> -->
                                    
                                    <a href="/tamu/{{$guru->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-graduation-cap my-1 btn-sm-1"></i> Tambah Data Tamu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/tamu/tambah" method="POST"enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <label for="nama">Nama Lengkap</label>
                                    <input value="{{old('nama')}}" name="nama" type="text" class="form-control bg-light" id="nama" placeholder="Nama Lengkap" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">                                    
                                    <label for="tujuan">Tujuan</label>
                    <input name="tujuan" class="form-control bg-light" type="text" id="tujuan" rows="2" placeholder="tujuan" value="{{old('tujuan')}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')"></input>                   
                    <label for="bertemu">Bertemu dengan</label>
                    <input name="bertemu" type="bertemu" class="form-control bg-light" id="bertemu" placeholder="bertemu" value="{{old('bertemu')}}" required  oninvalid="this.setCustomValidity('Pastikan anda sudah mengisikan email dengan benar !')" oninput="setCustomValidity('')">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control bg-light" id="alamat" rows="2" placeholder="Alamat Lengkap" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')"></textarea>
                                    <label for="no_telp">Nomor HP</label>
                                    <input value="{{old('no_telp')}}" name="no_telp" type="number" class="form-control bg-light" id="no_telp" placeholder="Nomor HP" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                   <label for="ktp">KTP</label>
                    <input name="ktp" type="file" accept="image/*" capture="user" class="form-control" id="ktp" required>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                                    SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection