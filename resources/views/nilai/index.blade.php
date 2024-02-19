@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
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
         <!-- Bagian pesan -->
   
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
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Nilai</h3>
                <hr>
            </div>
        </div>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
        <div>
           <div class="form-group">
                <form action="{{ route('filter.absensi') }}" method="get">
                    @csrf
                    <label for="mapel">Filter berdasarkan Mata Pelajaran:</label>
                    <select name="mapel" id="mapel" class="form-control">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mapels as $mapelOption)
                        <option value="{{ $mapelOption }}">{{ $mapelOption }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm my-1 mr-sm-1">Filter</button>
                </form>
            </div>
        </div>
          <div class="col">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahGuru"><i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th><div style="width:110px;">Nama Lengkap</div></th>
                                <th><div style="width:110px;">Kelas</div></th>
                                <th><div style="width:110px;">mapel</div></th>
                                <th><div style="width:70px;">Nilai 1</div></th>
                                <th><div style="width:70px;">Nilai 2</div></th>
                                <th><div style="width:70px;">Nilai 3</div></th>
                                <th><div style="width:70px;">Nilai 4 </div></th>
                                <th><div style="width:70px;">Nilai 5</div></th>
                                <th><div style="width:70px;">Nilai 6</div></th>
                                <th><div style="width:70px;">Nilai 7</div></th>
                                <th><div style="width:70px;">Nilai 8</div></th>
                                <th><div style="width:70px;">Nilai 9</div></th>
                                <th><div style="width:70px;">Nilai 10</div></th>
                                <th><div style="width:70px;">semester</div></th>
                                <th><div style="width:70px;">rata_rata</div></th>
                                <th><center> Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php $no = 0; ?>
                             @foreach($datas as $absen)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$absen->Pesdik->nama}}</td>
                                
                                <td>{{$absen->kelas}}</td>
                                <td>{{$absen->mapel}}</td>
                               <td>{{ $absen->nilai1 ?? '-' }}</td>
<td>{{ $absen->nilai2 ?? '-' }}</td>
<td>{{ $absen->nilai3 ?? '-' }}</td>
<td>{{ $absen->nilai4 ?? '-' }}</td>
<td>{{ $absen->nilai5 ?? '-' }}</td>
<td>{{ $absen->nilai6 ?? '-' }}</td>
<td>{{ $absen->nilai7 ?? '-' }}</td>
<td>{{ $absen->nilai8 ?? '-' }}</td>
<td>{{ $absen->nilai9 ?? '-' }}</td>
<td>{{ $absen->nilai10 ?? '-' }}</td>
<td>{{ $absen->semester }}</td>
<td>{{ $absen->rata_rata }}</td>

                                <td>
                                    <center>
                                    <div class="ok"style="width:220px;">
                                    <a href="/nilai/{{$absen->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    <!-- @if (auth()->user()->role == 'admin') -->
                                    <!-- <a href="/nilai/{{$absen->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a>
                                    {{-- <a href="/bk/{{$bk->id}}/registrasi" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-child"></i> Detail</a> --}} -->
                                    <!-- @endif -->
                                </div>
                            </center>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

            <div class="modal fade" id="tambahGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-graduation-cap my-1 btn-sm-1"></i> Tambah Data Nilai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/nilai/store" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                     <label for="id_pesdik">Nama Murid</label>
                    <select name="id_pesdik" class="form-control my-1 mr-sm-2 bg-light" id="id_pesdik"  oninput="setCustomValidity('')">
                        <option value="">-- Pilih Nama Murid --</option>
                        @foreach($Pesdik as $ayah)
                        <option value="{{$ayah->id}}"> {{$ayah->nama}}
                        </option>
                        @endforeach
                    </select> 
                                      <label for="kelas">Kelas</label>
                                      <!-- <input value="{{old('nama')}}" name="nama" type="text" class="form-control bg-light" id="nama" placeholder="Nama Lengkap" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')"> -->
                    <input value="{{old('kelas')}}" name="kelas" type="number" class="form-control bg-light" id="kelas" placeholder="Kelas" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="mapel">Mapel</label>
                    <input value="{{old('mapel')}}" name="mapel" type="text" class="form-control bg-light" id="mapel" placeholder="Mata Pelajaran" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="nilai1">Nilai 1</label>
                    <input value="{{old('nilai1')}}" name="nilai1" type="text" class="form-control bg-light" id="nilai1" placeholder="Nilai 1" >
                    <label for="nilai2">Nilai 2</label>
                    <input value="{{old('nilai2')}}" name="nilai2" type="text" class="form-control bg-light" id="nilai2" placeholder="Nilai 2" >
                    <label for="nilai3">Nilai 3</label>
                    <input value="{{old('nilai3')}}" name="nilai3" type="text" class="form-control bg-light" id="nilai3" placeholder="Nilai 3" >
                    <label for="nilai4">Nilai 4</label>
                    <input value="{{old('nilai4')}}" name="nilai4" type="text" class="form-control bg-light" id="nilai4" placeholder="Nilai 4" >
                    <label for="nilai5">Nilai 5</label>
                    <input value="{{old('nilai5')}}" name="nilai5" type="text" class="form-control bg-light" id="nilai5" placeholder="Nilai 5" >
                    <label for="nilai6">Nilai 6</label>
                    <input value="{{old('nilai6')}}" name="nilai6" type="text" class="form-control bg-light" id="nilai6" placeholder="Nilai 6" >
                    <label for="nilai7">Nilai 7</label>
                    <input value="{{old('nilai7')}}" name="nilai7" type="text" class="form-control bg-light" id="nilai7" placeholder="Nilai 7" >
                    <label for="nilai8">Nilai 8</label>
                    <input value="{{old('nilai8')}}" name="nilai8" type="text" class="form-control bg-light" id="nilai8" placeholder="Nilai 8" >
                    <label for="nilai9">Nilai 9</label>
                    <input value="{{old('nilai9')}}" name="nilai9" type="text" class="form-control bg-light" id="nilai9" placeholder="Nilai 9" >
                    <label for="nilai10">Nilai 10</label>
                    <input value="{{old('nilai10')}}" name="nilai10" type="text" class="form-control bg-light" id="nilai10" placeholder="Nilai 10" >
                     

                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                                    SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</section>
@endsection