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
        <form action="/guru/{{$guru->id}}/update" method="POST">
            <h4><i class="nav-icon fas fa-graduation-cap my-1 btn-sm-1"></i> Edit Data Guru</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="nama">Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control bg-light" id="nama" placeholder="Nama Lengkap" value="{{$guru->nama}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="alamat">alamat</label>
                    <input name="alamat" type="text" class="form-control bg-light" id="alamat" placeholder="alamat Lengkap" value="{{$guru->alamat}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                   
                    <!-- <label for="tempat_lahir">Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control bg-light" id="tempat_lahir" placeholder="Tempat Lahir" value="{{$guru->tempat_lahir}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="date" class="form-control bg-light" id="tanggal_lahir" value="{{$guru->tanggal_lahir}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')"> -->
                </div>
                <div class="col-md-6">
                    <label for="tujuan">Tujuan</label>
                    <textarea name="tujuan" class="form-control bg-light" id="tujuan" rows="2" placeholder="tujuan" value="{{$guru->tujuan}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$guru->alamat}}</textarea>
                    <label for="no_telp">Nomor HP</label>
                    <input name="no_telp" type="number" class="form-control bg-light" id="no_telp" placeholder="Nomor HP" value="{{$guru->no_hp}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="bertemu">Bertemu dengan</label>
                    <input name="bertemu" type="bertemu" class="form-control bg-light" id="bertemu" placeholder="bertemu" value="{{$guru->bertemu}}" required email oninvalid="this.setCustomValidity('Pastikan anda sudah mengisikan email dengan benar !')" oninput="setCustomValidity('')">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/guru/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection