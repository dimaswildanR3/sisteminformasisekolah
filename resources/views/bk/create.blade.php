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
        <form action="/bk/store" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Tambah Data Konseling</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="id_pesdik">Nama Lengkap</label>
                    <select name="id_pesdik" class="form-control my-1 mr-sm-2 bg-light" id="id_pesdik" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="">-- Pilih Nama Pesdik --</option>
                        @foreach($datas as $nama)
                        <option value="{{$nama->id}}">{{$nama->nama}}
                        @endforeach
                    </select>
                    <label for="permasalahan">Permasalahan</label>
                    <input value="{{old('permasalahan')}}" name="permasalahan" type="text" class="form-control" id="permasalahan" placeholder="PERMASALAHAN" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tanggal">Tanggal Konseling</label>
                    <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">                    

                   
                    <label for="status">Status</label>
                    <select name="status" class="form-control my-1 mr-sm-1 bg-light" id="status" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Diproses">Belum Diproses</option>
                        <option value="Masih Ditangani Walas">Masih Ditangani Walas</option>
                        <option value="Sudah Proses BK 25%">Sudah Proses BK 25%</option>
                        <option value="Sudah Proses BK 25%">Sudah Proses BK 25%</option>
                        <option value="Sedang Dikoordinasikan Eksternal">Sedang Dikoordinasikan Eksternal</option>
                        <option value="Dikembalikan ke Ortu">Dikembalikan ke Ortu</option>
                        <option value="Sudah Selesai 100%">Sudah Selesai 100%</option>
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
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
<script>
    document.getElementById('status').addEventListener('change', function () {
        var inputLainnya = document.getElementById('inputLainnya');
        if (this.value === 'lainnya') {
            inputLainnya.style.display = 'block';
        } else {
            inputLainnya.style.display = 'none';
        }
    });
</script>
@endsection