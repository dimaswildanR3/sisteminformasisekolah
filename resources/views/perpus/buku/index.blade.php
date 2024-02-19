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
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Buku Perpustakaan</h3>
                <hr>
            </div>
        </div>
        <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
			IMPORT EXCEL
		</button>
 
		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/buku/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>

        <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">                                
                                <th><div style="width:110px;">No.</div></th>
                                <th><div style="width:110px;">Judul</div></th>
                                <th><div style="width:110px;">Nomer Buku</div></th>
                                <th><div style="width:100px;">Pengarang</div></th>
                                <th><div style="width:100px;">Penerbit</div></th>
                                <th><div style="width:60px;">Tahun</div></th>
                                <th><div style="width:50px;">PDF</div></th>
                                <!-- <th><div style="width:100px;">Jumlah Buku</div></th>
                                <th><div style="width:100px;">Deskripsi</div></th> -->
                                <!-- <th><div style="width:100px;">Lokasi</div></th> -->
                                <th><div style="width:100px;">Cover</div></th>
                                <th><center> Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($datas as $buku)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>                                
                                <td>{{$buku->judul}}</td>
                                <td>{{$buku->isbn}}</td>                                                                
                                <td>{{$buku->pengarang}}</td>
                                <td>{{$buku->penerbit}}</td>
                                <td>{{$buku->tahun_terbit}}</td>
                                  <td>
    @if ($buku->ebook)
        <a href="{{ asset('ebook_upload/' . $buku->ebook) }}" target="_blank">Buka PDF</a>
    @else
        <!-- Tidak ada ebook yang tersedia -->
        Tidak ada PDF
    @endif
</td>

                                <!-- <td>{{$buku->jumlah_buku}}</td>                            
                                <td>{{$buku->deskripsi}}</td>                             -->
                                <!-- <td>{{$buku->lokasi}}</td>                             -->
                                <td>
                                    @if( in_array(pathinfo($buku->cover, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                    <img src="{{asset('cover_upload')}}/{{$buku->cover}}" style="height: 250px;width:200px;">
                                    @else
                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                    style="height: 100%;width:100%;">
                                @endif
                                </td>                            
                                <td>
                                    <div class="ok"style="width:220px;">
                                    <a href="/perpus/buku/{{$buku->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    {{-- @if (auth()->user()->role == 'admin') --}}
                                    <a href="/perpus/buku/{{$buku->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                        Hapus</a>
                                    <a href="/perpus/buku/{{$buku->id}}/show" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-child"></i> Detail</a>
                                    {{-- @endif --}}
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
@endsection