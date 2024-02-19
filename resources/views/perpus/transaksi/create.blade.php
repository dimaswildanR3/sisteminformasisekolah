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
        <form action="/perpus/transaksi/store" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Tambah Data Transaksi</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="kode_transaksi">Kode Transaksi</label>
                    <input value="{{old('kode_transaksi')}}" name="kode_transaksi" type="text" class="form-control" id="kode_transaksi" placeholder="kode transaksi" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    {{-- <label for="judul">Judul</label> --}}
                    
                    <label for="pesdik_id">Nama</label>
                    <select name="pesdik_id" class="form-control my-1 mr-sm-2 bg-light" id="pesdik_id"  oninput="setCustomValidity('')">
                        <option value="">-- Pilih Pesdik --</option>
                        @foreach($anggotas as $ibui)
                        <option value="{{$ibui->id}}"> {{$ibui->nama}}
                        </option>
                        @endforeach
                    </select>
                    <label for="buku_id">Buku</label>
                    <select name="buku_id" class="form-control my-1 mr-sm-2 bg-light" id="buku_id"  oninput="setCustomValidity('')">
                        <option value="">-- Pilih Buku --</option>
                        @foreach($bukus as $ibui)
                        <option value="{{$ibui->id}}"> {{$ibui->judul}}
                        </option>
                        @endforeach
                    </select>
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input value="{{old('tgl_pinjam')}}" name="tgl_pinjam" type="date" class="form-control" id="tgl_pinjam" placeholder="tgl_pinjam" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                </div>
                <div class="col-md-6">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input value="{{old('tgl_kembali')}}" name="tgl_kembali" type="date" class="form-control" id="tgl_kembali" placeholder="Jumlah Buku" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="status">Status</label>
                    <input value="pinjam" name="nama" type="text" class="form-control" id="nama" placeholder="Nama Siswa" disabled>
                    <label for="ket">Keteranga</label>
                    <input value="{{old('ket')}}" name="ket" type="text" class="form-control" id="ket" placeholder="ket" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                   
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection