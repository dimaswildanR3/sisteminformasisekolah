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
        <form action="/perpus/anggota/{{$data->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Peserta Didik</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    
                    <input value="{{$data->image}}" name="image" type="file" class="form-control" id="image" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    @if( in_array(pathinfo($data->image, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                    <img src="{{asset('image_upload')}}/{{$data->image}}" style="height: 250px;width:200px;">
                    @endif
                    <br>
                    <label for="nama">Nama</label>
                    <input value="{{$data->nama}}" name="nama" type="text" class="form-control" id="nama" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                      
                        {{-- @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}}
                        </option>
                        @endforeach
                    </select> --}}
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" class="form-control" id="jk" required>
                        <option value="L" @if ($data->jk == 'L') selected @endif>Laki-Laki</option>
                        <option value="P" @if ($data->jk == 'P') selected @endif>Perempuan</option>
                    </select>
                    <label for="nisn">NISN</label>
                    <input value="{{$data->nisn}}" name="nisn" type="number" class="form-control" id="nisn" placeholder="NISN" disabled>        
                </div>
                <div class="col-md-6">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input value="{{$data->tempat_lahir}}" name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input value="{{$data->tanggal_lahir}}" name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    {{-- <label for="jenis_pendaftaran">Jenis Pendaftaran</label>                 --}}
                    <label for="tingkat_kelas">Kelas</label>
                    <input value="{{$data->tingkat_kelas}}" name="tingkat_kelas" type="text" class="form-control" id="tingkat_kelas" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/perpus/anggota/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection