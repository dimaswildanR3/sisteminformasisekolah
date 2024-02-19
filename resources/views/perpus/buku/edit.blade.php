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
        <form action="/perpus/buku/{{$data->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Buku</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="judul">Judul</label>
                    <input value="{{$data->judul}}" name="judul" type="text" class="form-control" id="judul" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="isbn">Nomer Buku</label>
                    <input value="{{$data->isbn}}" name="isbn" type="text" class="form-control" id="isbn" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="pengarang">Pengarang</label>
                    <input value="{{$data->pengarang}}" name="pengarang" type="text" class="form-control" id="pengarang" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="penerbit">Penerbit</label>
                    <input value="{{$data->penerbit}}" name="penerbit" type="text" class="form-control" id="penerbit" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input value="{{$data->tahun_terbit}}" name="tahun_terbit" type="number" class="form-control" id="tahun_terbit" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <!-- <label for="ebook">Ebook</label>
                    <select name="ebook" class="form-control my-1 mr-sm-1 bg-light" id="ebook" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="{{$data->ebook}}">{{$data->ebook}}</option>
                        <option value="iya">Iya</option>
                        <option value="tidak">Tidak</option>
                    </select> -->
                    
                </div>
                <div class="col-md-6">
                    <!-- <label for="jumlah_buku">Jumlah Buku</label>
                    <input value="{{$data->jumlah_buku}}" name="jumlah_buku" type="number" class="form-control" id="jumlah_buku" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="deskripsi">Deskripsi</label>
                    <input value="{{$data->deskripsi}}" name="deskripsi" type="text" class="form-control" id="deskripsi" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="lokasi">Lokasi</label>
                    <input value="{{$data->lokasi}}" name="lokasi" type="text" class="form-control" id="lokasi" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="cover">Cover</label> -->
                    <input value="{{$data->cover}}" name="cover" type="file" class="form-control" id="cover">
                    @if( in_array(pathinfo($data->cover, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                    <img src="{{asset('cover_upload')}}/{{$data->cover}}" style="height: 250px;width:200px;">
                                    {{-- @else
                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                    style="height: 100%;width:100%;"> --}}
                                @endif
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/perpus/buku/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection