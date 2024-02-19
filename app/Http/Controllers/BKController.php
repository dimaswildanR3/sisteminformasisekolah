<?php

namespace App\Http\Controllers;

use App\BK;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class BKController extends Controller
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

        $datas = BK::get();
        return view('bk.index', compact('datas'));
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
        return view('bk.create',['datas' => $datas]);
    }
    public function siswa($id)
    {
        // if(Auth::user()->level == 'user') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/');
        // }
        $datas = \App\BK::where('id_pesdik', $id)->get();
       $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();
        return view('bk.siswa',compact('datas','id_pesdik_login','pesdik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesis(Request $request)
    {
            $request->validate([
        'id_pesdik' => 'required',
        'permasalahan' => 'required',
        // 'tanggal' => 'required',
        // 'status' => 'required',
    ]);      
            $bk = new BK;        
            $bk->id_pesdik       = $request->input('id_pesdik');
            $bk->permasalahan       = $request->input('permasalahan');
            // $bk->tanggal       = $request->input('tanggal');            
            $bk->status       = 'Belum Diproses';            
            

   
            $bk->save();
       return redirect()->back()->with('sukses', 'Status absen berhasil diubah menjadi Masuk.');

    }
    public function store(Request $request)
    {
            $request->validate([
        'id_pesdik' => 'required',
        'permasalahan' => 'required',
        'tanggal' => 'required',
        'status' => 'required',
    ]);      
            $bk = new BK;        
            $bk->id_pesdik       = $request->input('id_pesdik');
            $bk->permasalahan       = $request->input('permasalahan');
            $bk->tanggal       = $request->input('tanggal');            
            

             if ($request->input('status') === 'lainnya') {
        $bk->status = 'lainnya';
        // Setel kolom "lainnya" dengan nilai yang diinputkan oleh pengguna
        $bk->status = $request->input('lainnya');
    } else {
        // Jika "Status" bukan "lainnya," setel kolom "status" dengan nilai yang dipilih
        $bk->status = $request->input('status');
    }            
            $bk->save();
        return redirect()->route('bk')->with('sukses', 'Data BK Berhasil Ditambah');

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

        $data = BK::findOrFail($id);

        return view('/bk/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {   
        // if(Auth::user()->level == 'user') {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }
        $data = BK::findOrFail($id);
        $datas = Pesdik::get();
        // $users = User::get();
    
        return view('bk/edit', compact(['data','datas']));

    
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
         $request->validate([
        'id_pesdik' => 'required',
        'permasalahan' => 'required',
        'tanggal' => 'required',
        'status' => 'required',
         ]);
         
        $data = BK::where('id', $id)->first();
        $data->id_pesdik       = $request->input('id_pesdik');
            $data->permasalahan       = $request->input('permasalahan');
            $data->tanggal       = $request->input('tanggal');               
            
            if ($request->input('status') === 'lainnya') {
        // Jika "Status" adalah "lainnya", setel kolom "status" dengan nilai dari input "lainnya"
        $data->status = $request->input('lainnya');
    } else {
        // Jika "Status" bukan "lainnya," setel kolom "status" dengan nilai yang dipilih
        $data->status = $request->input('status');
    }

    $data->update();


        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('/bk/index')->with('sukses', 'Data BK Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        BK::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('bk')->with('sukses', 'Data BK Berhasil Dihapus');
    }
}
