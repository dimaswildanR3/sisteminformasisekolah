<?php

namespace App\Http\Controllers;

use App\absen;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AbsenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
    {
        // if(Auth::user()->level == 'user') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/');
        // }
 $kelas = Absen::distinct('kelas')->get(['kelas']);;
        $datas = Absen::orderBy('id', 'desc')->get();
        // $datas = Pesdik::get();
        return view('absen.index', compact('datas','kelas'));
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
        $datas = \App\Pesdik::get();
        return view('absen.create',['datas' => $datas]);
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
            $absen = new Absen;        
            $absen->id_pesdik       = $request->input('id_pesdik');
            
            $absen->kelas       = $request->input('kelas');
            $absen->absen       = $request->input('absen');
            $absen->pulang       = $request->input('pulang');
            $absen->tanggal       = $request->input('tanggal');            
            $absen->keterangan       = $request->input('keterangan');            
            $absen->save();
        return redirect()->route('absen')->with('sukses', 'Data absen Berhasil Ditambah');

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

        $data = Absen::findOrFail($id);

        return view('/absen/show', compact('data'));
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
        $data = Absen::findOrFail($id);
        $datas = Pesdik::find($data->id_pesdik);
        // dd($datas);
        // $users = User::get();
    
        return view('absen/edit', ['data'=> $data ,'datas' => $datas]);

    
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

        $data = \App\Absen::find($id);
        $data->update($request->all());
        // dd($data);
        $data->save();
        // $data =Absen::where('id', $id)->first();
        // $data->id_pesdik       = $request->input('id_pesdik');
        // $data->absen       = $request->input('absen');
        // $data->tanggal       = $request->input('tanggal');                  
        // $data->update();
        // $data->save();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('absen/index')->with('sukses', 'Data absen Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        Absen::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('absen')->with('sukses', 'Data absen Berhasil Dihapus');
    }

    public function inputToAbsensi()
    {
        $sourceData = Pesdik::all();
        $newDataCount = 0;
    
        foreach ($sourceData as $data) {
            // Check if data for the same date already exists
            $existingAbsen = Absen::where('id_pesdik', $data->id)
                ->whereDate('tanggal', now())
                ->first();
    
            if (!$existingAbsen) {
                Absen::create([
                    'id_pesdik' => $data->id,
                    'kelas' => $data->kelas,
                    'tanggal' => now(),
                ]);
                $newDataCount++;
            }
        }
    
        if ($newDataCount > 0) {
            $message = $newDataCount . ' data absensi baru berhasil diinputkan.';
        } else {
            $message = 'Tidak ada data absensi baru yang diinputkan karena sudah ada data pada tanggal ini.';
        }
    
        return redirect()->route('absen')->with('message', $message);
    
    }



    public function filterAbsensi(Request $request)
    {
         $ok = $request->input('kelas');

    // Query data berdasarkan nilai 'mapel' jika 'mapel' tidak kosong
    $query = Absen::orderBy('id', 'desc');

    if (!empty($ok)) {
        $query->where('kelas', $ok);
    }

    // Mengambil data sesuai query
    $datas = $query->get();

    // Mendapatkan daftar mata pelajaran (mapel)
    $kelas = Absen::distinct('kelas')->get(['kelas']);
// dd($datas);
    // Mengirimkan data ke tampilan
    return view('absen.index', compact('datas', 'kelas'));
    }


}
