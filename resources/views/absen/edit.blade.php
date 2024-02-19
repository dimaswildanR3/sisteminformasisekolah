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
        <form action="/absen/{{$data->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Absen</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="id_pesdik">Nama</label>                    
                    <select name="id_pesdik" id="id_pesdik" class="form-control"disabled>
                       
                        
                        {{-- <option value="Siswa Baru" @if ($pesdik->jenis_pendaftaran == 'Siswa Baru') selected @endif>Siswa Baru</option> --}}
                        <option value="{{$datas->id}}" selected>{{$datas->nama}}
                        </option>
                        
                    </select>

                    <label for="absen">Absensi</label>
                    <select name="absen" class="form-control my-1 mr-sm-1 bg-light" id="absen">
                        <option value=""> Belum Absen </option>
                        <option value="masuk">Masuk</option>
                        <option value="izin">Izin</option>
                        <option value="alpa">Alpha</option>

                    </select>
                    <label for="pulang">Pulang</label>
                    <select name="pulang" class="form-control my-1 mr-sm-1 bg-light" id="pulang">
                        <option value=""> Belum pulang </option>
                        <option value="pulang">pulang</option>
                        {{-- <option value="izin">Izin</option>
                        <option value="alpa">Alpha</option> --}}

                    </select>
                  
                    <label for="tanggal">Tanggal Absen</label>
                    <input value="{{$data->tanggal}}" name="tanggal" type="date" class="form-control" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="keterangan">keterangan</label>
                    <input value="{{$data->keterangan}}" name="keterangan" type="text" class="form-control" id="keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/absen/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection