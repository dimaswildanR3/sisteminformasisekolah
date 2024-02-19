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
        <form action="/nilai/{{$data->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Nilai</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <!-- <label for="id_pesdik">Nama</label>                    
                    <select name="id_pesdik" id="id_pesdik" class="form-control"disabled>
                       
                        
                        {{-- <option value="Siswa Baru" @if ($pesdik->jenis_pendaftaran == 'Siswa Baru') selected @endif>Siswa Baru</option> --}}
                        <option value="{{$datas->id}}" selected>{{$datas->nama}}
                        </option>
                        
                    </select> -->

                     <label for="kelas">Kelas</label>
                    <input value="{{$data->kelas}}" name="kelas" type="number" class="form-control" id="kelas" placeholder="Kelas" >
                    <label for="mapel">Mapel</label>
                    <input value="{{$data->mapel}}" name="mapel" type="text" class="form-control" id="mapel" placeholder="Mata Pelajaran" >
                     <label for="nilai1">Nilai 1</label>
                    <input value="{{$data->nilai1}}" name="nilai1" type="text" class="form-control" id="nilai1" placeholder="Nilai 1" >
                     <label for="nilai2">Nilai 2</label>
                    <input value="{{$data->nilai2}}" name="nilai2" type="text" class="form-control" id="nilai2" placeholder="Nilai 2" >
                     <label for="nilai3">Nilai 3</label>
                    <input value="{{$data->nilai3}}" name="nilai3" type="text" class="form-control" id="nilai3" placeholder="Nilai 3" >
                     <label for="nilai4">Nilai 4</label>
                    <input value="{{$data->nilai4}}" name="nilai4" type="text" class="form-control" id="nilai4" placeholder="Nilai 4" >
                    
                    </div>

                    <div class="col-md-6"> 
                    <label for="nilai5">Nilai 5</label>
                    <input value="{{$data->nilai5}}" name="nilai5" type="text" class="form-control" id="nilai5" placeholder="Nilai5" >
                     <label for="nilai6">Nilai 6</label>
                    <input value="{{$data->nilai6}}" name="nilai6" type="text" class="form-control" id="nilai6" placeholder="Nilai 6" >
                     <label for="nilai7">Nilai 7</label>
                    <input value="{{$data->nilai7}}" name="nilai7" type="text" class="form-control" id="nilai7" placeholder="Nilai 7" >
                     <label for="nilai8">Nilai 8</label>
                    <input value="{{$data->nilai8}}" name="nilai8" type="text" class="form-control" id="nilai8" placeholder="Nilai 8" >
                     <label for="nilai9">Nilai 9</label>
                    <input value="{{$data->nilai9}}" name="nilai9" type="text" class="form-control" id="nilai9" placeholder="Nilai 9" >
                    <label for="nilai10">Nilai 10</label>
                   <input value="{{$data->nilai10}}" name="nilai10" type="text" class="form-control" id="nilai10" placeholder="Nilai 10" >
                    <label for="semester">Semester</label>
                   <input value="{{$data->semester}}" name="semester" type="text" class="form-control" id="semester" placeholder="Semester" >
                    <label for="rata_rata">Rata-Rata</label>
                   <input value="{{$data->rata_rata}}" name="rata_rata" type="text" class="form-control" id="rata_rata" placeholder="Rata-Rata" >
                    
                    <!-- <label for="absen">Absensi</label>
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
                     -->
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/nilai/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection