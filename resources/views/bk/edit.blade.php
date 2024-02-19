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
        <form action="/bk/{{$data->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Konseling</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                   <label for="id_pesdik">Nama</label>
    <input value="{{$data->pesdik->nama}}" name="nama_pesdik" type="text" class="form-control" id="nama_pesdik" placeholder="Nama" disabled>
    <input value="{{$data->id}}" name="id_pesdik" type="hidden">

                  <label for="permasalahan">PERMASALAHAN</label>
                    <input value="{{$data->permasalahan}}" name="permasalahan" type="text" class="form-control" id="permasalahan" placeholder="permasalahan" disabled>
<input value="{{$data->permasalahan}}" name="permasalahan" type="hidden">
                    
                    <label for="tanggal">Tanggal Konseling</label>
                    <input value="{{$data->tanggal}}" name="tanggal" type="date" class="form-control" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                     <label for="status">Status</label>
                    <select name="status" class="form-control my-1 mr-sm-1 bg-light" id="status" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="{{$data->status}}">{{$data->status}}</option>
                        <option value="belum diproses">Belum Diproses</option>
                        <option value="masih ditangani walas">Masih Ditangani Walas</option>
                        <option value="sudah proses bk 25%">Sudah Proses BK 25%</option>
                        <option value="sudah proses bk 50 %">Sudah Proses BK 50 %</option>
                        <option value="sedang dikoordinasikan eksternal">Sedang Dikoordinasikan Eksternal</option>
                        <option value="dikembalikan ke ortu">Dikembalikan ke Ortu</option>
                        <option value="sudah selesai 100%">Sudah Selesai 100%</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                        <div id="inputLainnya" style="display:none;">
                            <label for="lainnya">Isi opsi lainnya:</label>
                            <input type="text" name="lainnya" id="lainnya">
                    </div>
                    

                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/bk/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection