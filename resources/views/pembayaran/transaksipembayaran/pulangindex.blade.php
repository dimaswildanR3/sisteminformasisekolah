@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <h4><i class="nav-icon fas fa-warehouse my-1 btn-sm-1"></i> Absensi Pulang</h4>
  <hr>
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
  @foreach($ok as $item_ins)
  <div class="row">
      <div class="col-md-12">
          <div class="card-body pt-0">
              <div class="row">
                  <div class="col-9">
                      <h3 class="font-weight-bold">{{ $item_ins->Pesdik->nama }}</h3>
                      <ul class="ml-4 mb-0 fa-ul text-black">
                          <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-user-tie"></i></span>
                              <h4>NISN     
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->Pesdik->nisn }}/{{ $item_ins->Pesdik->induk }}</h4>
                          </li>
                          <!-- <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span>
                              <h4>Kontak &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->Pesdik->kontak }}</h4>
                          </li> -->
                          <li><span class="fa-li"><i class="fas fa-lg fa-at"></i></span>
                              <h4>Kelas
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->Pesdik->kelas }}</h4>
                          </li>
                      </ul>
                  </div>
                  {{-- <a href="{{ asset($item_ins->file) }}" data-toggle="lightbox" data-title="Lihat Logo Instansi">
                      <center>
                          <img id="logo" src="{{ asset($item_ins->file) }}" alt="Logo Instansi" class="rounded" width="200"><br>
                      </center>
                  </a> --}}
              </div>
          </div>
          <hr>
          <div class="col-12 text-center">
            @foreach($ok as $item_ins)
    <!-- Display student details here -->
    @if ($item_ins->pulang === null)
        <form action="{{ route('updateStatuss', ['id' => $item_ins->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin ingin mengubah status absen menjadi pulang?')">
                Pulang
            </button>
        </form>
    @else
        <button class="btn btn-disabled" disabled>
            {{ $item_ins->pulang }}
        </button>
    @endif
@endforeach
          </div>
      </div>
  </div>
  @endforeach
  {{-- @else --}}
  {{-- <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('instansi.create') }}" role="button"><i class="fas fa-plus"></i> Setting Data Sekolah</a>
  </div> --}}
  {{-- @endif --}}
</section>
@endsection