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
        <form action="/perpus/buku/store" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Tambah Data Buku Perpus</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="judul">Judul</label>
                    <input value="{{old('judul')}}" name="judul" type="text" class="form-control" id="judul" placeholder="judul" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    {{-- <label for="judul">Judul</label> --}}
                    <label for="isbn">Nomer Buku</label>
                    <input value="{{old('isbn')}}" name="isbn" type="text" class="form-control" id="isbn" placeholder="isbn" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="pengarang">Pengarang</label>
                    <input value="{{old('pengarang')}}" name="pengarang" type="text" class="form-control" id="pengarang" placeholder="pengarang" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="penerbit">Penerbit</label>
                    <input value="{{old('penerbit')}}" name="penerbit" type="text" class="form-control" id="penerbit" placeholder="penerbit" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input value="{{old('tahun_terbit')}}" name="tahun_terbit" type="number" class="form-control" id="tahun_terbit" placeholder="tahun terbit" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                     <!-- <label for="ebook">Ebook</label>
                    <select name="ebook" class="form-control my-1 mr-sm-1 bg-light" id="ebook" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="">-- Pilih ebook --</option>
                        <option value="iya">Iya</option>
                        <option value="tidak">Tidak</option>
                    </select> -->

                </div>
                <div class="col-md-6">
                    <!-- <label for="jumlah_buku">Jumlah Buku</label>
                    <input value="{{old('jumlah_buku')}}" name="jumlah_buku" type="number" class="form-control" id="jumlah_buku" placeholder="Jumlah Buku" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="deskripsi">Deskripsi</label>
                    <input value="{{old('deskripsi')}}" name="deskripsi" type="text" class="form-control bg-light" id="deskripsi" placeholder="Deskripsi" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="lokasi">Lokasi</label>
                    <input value="{{old('lokasi')}}" name="lokasi" type="text" class="form-control" id="lokasi" placeholder="Lokasi" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')"> -->
                    <label for="cover">Cover</label>
                    <input value="{{old('cover')}}" name="cover" type="file" class="form-control" id="cover" placeholder="cover" style="height:45px;">
                    <label for="ebook">PDF</label>
                    <input value="{{old('ebook')}}" name="ebook" type="file" class="form-control" id="ebook" placeholder="PDF" style="height:45px;">
                   
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection