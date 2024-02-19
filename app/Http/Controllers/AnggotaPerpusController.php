<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AnggotaPerpus;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaPerpusController extends Controller
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
        $datas = AnggotaPerpus::get();
        $users = User::get();
        return view('/perpus/anggota.index', ['users' => $users,'datas' => $datas]);
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

        $users = User::WhereNotExists(function($query) {
                        $query->select(DB::raw(1))
                        ->from('anggota_perpus')
                        ->whereRaw('anggota_perpus.users_id = users.id');
                     })->get();
        return view('/perpus/anggota.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request, [
            ]);
            
            $image           = $request->file('image');
            //mengambil nama image
            $nama_image      = $image->getClientOriginalName();
            
            //memindahkan cover ke folder tujuan
            $image->move('image_upload',$image->getClientOriginalName());
            $anggota = new AnggotaPerpus;
            $anggota->image          = $nama_image;
            $anggota->nisn           = $request->input('nisn');
            $anggota->nama           = $request->input('nama');
            $anggota->tempat_lahir   = $request->input('tempat_lahir');
            $anggota->tgl_lahir      = $request->input('tgl_lahir');
            $anggota->jk             = $request->input('jk');
            $anggota->tingkat_kelas  = $request->input('tingkat_kelas');
            $anggota->save();
        return redirect()->to('/perpus/anggota/index')->with('sukses', 'Data Anggota Perpustakaan Berhasil Ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = AnggotaPerpus::findOrFail($id);

        return view('/perpus/anggota/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = AnggotaPerpus::findOrFail($id);
        $users = User::get();
        return view('/perpus/anggota/edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $anggota = AnggotaPerpus::where('id', $id)->first();
        $anggota->nisn           = $request->input('nisn');
        $anggota->nama           = $request->input('nama');
        $anggota->tempat_lahir   = $request->input('tempat_lahir');
        $anggota->tgl_lahir      = $request->input('tgl_lahir');
        $anggota->jk             = $request->input('jk');
        $anggota->tingkat_kelas  = $request->input('tingkat_kelas');
        if($request->file('image') == "")
        {
           $anggota->image =$anggota->image;
        } 
        else
        {
        
            $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("image_upload/", $fileName);
           $anggota->image = $fileName;
        }
        
       $anggota->update();

        return redirect()->to('/perpus/anggota/index')->with('sukses', 'Data Anggota Perpustakaan Berhasil Diubah');;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        AnggotaPerpus::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->to('/perpus/anggota/index')->with('sukses', 'Data Anggota Perpustakaan Berhasil Dihapus');
    }
}
