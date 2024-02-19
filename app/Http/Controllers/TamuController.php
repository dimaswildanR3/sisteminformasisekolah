n<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tamu;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $datas = Tamu::get();
        return view('tamu.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('tamu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatehStatus(Request $request)
    {
        $id = $request->id;
        $guru = Tamu::findOrFail($id);

        // Toggle the publish status
        $guru->status = $guru->status === 'datang' ? 'pulang' : 'datang';

        $guru->save();
        // dd($mentor);

        return redirect()->back()->with('sukses', 'Status publish berhasil diubah.');
    }
    public function tambah(Request $request)
    {
            $this->validate($request, [
                // 'ktp' => 'required|file',
            ]);

             $cover           = $request->file('ktp');
            //  dd($cover);
            //mengambil nama cover
            $nama_cover      = $cover->getClientOriginalName();
    
            //memindahkan cover ke folder tujuan
            $cover->move('ktp_upload',$cover->getClientOriginalName());
            $tamu = new Tamu;
            $tamu->ktp       = $nama_cover;
            $tamu->nama       = $request->input('nama');
            $tamu->alamat       = $request->input('alamat');
            $tamu->no_telp       = $request->input('no_telp');
            $tamu->tujuan       = $request->input('tujuan');
            $tamu->bertemu       = $request->input('bertemu');
            $tamu->status       = 'datang';
            // $tamu->jumlah_tamu       = $request->input('jumlah_tamu');
            // $tamu->deskripsi       = $request->input('deskripsi');
            // $tamu->lokasi       = $request->input('lokasi');
            $tamu->save();
        return redirect()->route('tamu')->with('sukses', 'Data tamu Perpustakaan Berhasil Ditambah');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/'); 
        }

        $data = tamu::findOrFail($id);

        return view('/perpus/tamu/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }
        $data = tamu::findOrFail($id);
        // $users = User::get();
    
        return view('/perpus/tamu/edit', compact('data'));

    
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
        $data = tamu::where('id', $id)->first();
        $data->judul       = $request->input('judul');
        $data->isbn       = $request->input('isbn');
        $data->pengarang       = $request->input('pengarang');
        $data->penerbit       = $request->input('penerbit');
        $data->tahun_terbit       = $request->input('tahun_terbit');
        // $data->jumlah_tamu       = $request->input('jumlah_tamu');
        // $data->deskripsi       = $request->input('deskripsi');
        // $data->lokasi       = $request->input('lokasi');
        if($request->file('cover') == "")
        {
           $data->cover =$data->cover;
        } 
        else
        {
            // $data = tamu::delete('cover_upload/'.$data->cover);
        
            $file       = $request->file('cover');
            $fileName   = $file->getClientOriginalName();
            $request->file('cover')->move("cover_upload/", $fileName);
           $data->cover = $fileName;
        }
        
       $data->update();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('/perpus/tamu/index')->with('sukses', 'Data tamu Perpustakaan Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        tamu::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('tamu')->with('sukses', 'Data tamu Perpustakaan Berhasil Dihapus');
    }
}