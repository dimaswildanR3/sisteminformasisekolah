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
        <form action="/bk/{id}/storesis" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Tambah Data Konseling</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="id_pesdik">Nama Lengkap</label>
                    <select name="id_pesdik" class="form-control my-1 mr-sm-2 bg-light" id="id_pesdik" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="">-- Pilih Nama Pesdik --</option>
                        @foreach($pesdik as $nama)
                        <option value="{{$nama->id}}">{{$nama->nama}}
                        @endforeach
                    </select>
                    <label for="permasalahan">Permasalahan</label>
                    <input value="{{old('permasalahan')}}" name="permasalahan" type="text" class="form-control" id="permasalahan" placeholder="PERMASALAHAN" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    
                        <div id="inputLainnya" style="display:none;">
                            <label for="lainnya">Isi opsi lainnya:</label>
                            <input type="text" name="lainnya" id="lainnya">
                    </div>
                </div>
            </div>
            
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <!-- <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a> -->
        </form>
    </div>

    <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th><div style="width:110px;">Nama Lengkap</div></th>
                                <th><div style="width:110px;">Permasalahan</div></th>
                                <!-- <th><div style="width:70px;">Tanggal</div></th> -->
                                <th><div style="width:70px;">Status</div></th>
                                <!-- <th><center> Aksi</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $bk)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$bk->Pesdik->nama}}</td>
                                
                                <td>{{$bk->permasalahan}}</td>
                                <!-- <td>{{$bk->tanggal}}</td> -->
                                <td>{{$bk->status}}</td>
                                <td>
                                    @if (auth()->user()->role == 'admin')
                                    <div class="ok"style="width:220px;">
                                    <a href="/bk/{{$bk->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    <a href="/bk/{{$bk->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a>
                                    {{-- <a href="/bk/{{$bk->id}}/registrasi" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-child"></i> Detail</a> --}}
                                    @endif
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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