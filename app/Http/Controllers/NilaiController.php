<?php

namespace App\Http\Controllers;

use App\Nilai;
use App\Pesdik;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class NilaiController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request)
    {
        // Mengambil informasi pengguna yang sedang diautentikasi
        $user = Auth::user();

        // Inisialisasi variabel kelas
        $kelas = null;

        // Jika pengguna sudah diautentikasi, ambil nilai kelas
        if ($user) {
            $kelas = $user->kelas;
        }
$Pesdik = Pesdik::orderBy('id', 'desc')
   
    ->get();



        // Mengambil daftar mata pelajaran (mapel) yang tersedia
        $mapels = Nilai::distinct('mapel')->pluck('mapel');

        // Query data nilai berdasarkan nilai kelas dan mata pelajaran yang dipilih (jika ada)
        $datas = Nilai::orderBy('id', 'desc')
            ->when($kelas, function ($query, $kelas) {
                return $query->where('kelas', $kelas);
            })
            ->when($request->input('mapel'), function ($query) use ($request) {
                return $query->where('mapel', $request->input('mapel'));
            })
            ->get();

        return view('nilai.index', compact('datas', 'mapels','Pesdik'));
    }
 public function filter(Request $request)
{
    $Pesdik = Pesdik::orderBy('id', 'desc')->get();
    // Mendapatkan nilai 'mapel' dari formulir filter
    $mapel = $request->input('mapel');

    // Query data berdasarkan nilai 'mapel' jika 'mapel' tidak kosong
    $query = Nilai::orderBy('id', 'desc');

    if (!empty($mapel)) {
        $query->where('mapel', $mapel);
    }

    // Mengambil data sesuai query
    $datas = $query->get();

    // Mendapatkan daftar mata pelajaran (mapel)
    $mapels = Nilai::distinct('mapel')->pluck('mapel');

    // Mengirimkan data ke tampilan
    return view('nilai.index', compact('datas', 'mapels', 'Pesdik'));
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Auth::user()->level == 'user') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/');
        // }
        // $datas = \App\Pesdik::get();
        // return view('nilai.create',['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // $this->validate($request);        
            $nilai = new Nilai;
    $nilai->id_pesdik = $request->input('id_pesdik');
    $nilai->mapel = $request->input('mapel');
    $nilai->kelas = $request->input('kelas');
    $nilai->nilai1 = $request->input('nilai1');
    $nilai->nilai2 = $request->input('nilai2');
    $nilai->nilai3 = $request->input('nilai3');
    $nilai->nilai4 = $request->input('nilai4');
    $nilai->nilai5 = $request->input('nilai5');
    $nilai->nilai6 = $request->input('nilai6');
    $nilai->nilai7 = $request->input('nilai7');
    $nilai->nilai8 = $request->input('nilai8');
    $nilai->nilai9 = $request->input('nilai9');
    $nilai->nilai10 = $request->input('nilai10');
    $nilai->semester = $request->input('semester');

    // Menghitung rata-rata hanya jika ada nilai yang diisi
    $totalNilai = 0;
    $jumlahNilai = 0; // Jumlah total nilai yang diisi

    // Loop untuk menghitung total dan jumlah nilai yang diisi
    for ($i = 1; $i <= 10; $i++) {
        $nilaiInput = $request->input('nilai' . $i);
        
        if (!is_null($nilaiInput)) {
            $totalNilai += $nilaiInput;
            $jumlahNilai++;
        }
    }

    if ($jumlahNilai > 0) {
        $rataRata = $totalNilai / $jumlahNilai;
        $nilai->rata_rata = $rataRata;
    }

    $nilai->save();

        return redirect()->route('nilai')->with('sukses', 'Data nilai Berhasil Ditambah');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(Auth::user()->level == 'user') {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/'); 
        // }

        $data = nilai::findOrFail($id);

        return view('/nilai/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        // if(Auth::user()->level == 'user') {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }
        $data = Nilai::findOrFail($id);
        $datas = Pesdik::find($data->id_pesdik);
        // dd($datas);
        // $users = User::get();
    
        return view('nilai/edit', ['data'=> $data ,'datas' => $datas]);

    
    }
       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = Nilai::where('id', $id)->first();
        
        $data->kelas       = $request->input('kelas');
        $data->mapel       = $request->input('mapel');
        $data->nilai1       = $request->input('nilai1');
        $data->nilai2       = $request->input('nilai2');
        $data->nilai3       = $request->input('nilai3');
        $data->nilai4       = $request->input('nilai4');
        $data->nilai5       = $request->input('nilai5');
        $data->nilai6       = $request->input('nilai6');
        $data->nilai7       = $request->input('nilai7');
        $data->nilai8       = $request->input('nilai8');
        $data->nilai9       = $request->input('nilai9');
        $data->nilai10       = $request->input('nilai10');

          $totalNilai = 0;
    $jumlahNilai = 0; // Jumlah total nilai yang diisi

    // Loop untuk menghitung total dan jumlah nilai yang diisi
    for ($i = 1; $i <= 10; $i++) {
        $nilaiInput = $request->input('nilai' . $i);
        
        if (!is_null($nilaiInput)) {
            $totalNilai += $nilaiInput;
            $jumlahNilai++;
        }
    }

    if ($jumlahNilai > 0) {
        $rataRata = $totalNilai / $jumlahNilai;
        $data->rata_rata = $rataRata;
    }

    // $nilai->save();

        $data->save();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('nilai/index')->with('sukses', 'Data nilai Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        Nilai::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('nilai')->with('sukses', 'Data nilai Berhasil Dihapus');
    }

   
}
