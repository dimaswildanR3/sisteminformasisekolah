<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use App\Imports\BukuImport;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
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

        $datas = Buku::get();
        return view('/perpus/buku.index', compact('datas'));
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

        return view('/perpus/buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//  $validator = Validator::make($request->all(), [
//         'judul' => 'required|string',
//         'isbn' => 'required|string',
//         'pengarang' => 'required|string',
//         'penerbit' => 'required|string',
//         'tahun_terbit' => 'required|integer',
//         'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Cover bisa dikosongkan
//         'ebook' => 'sometimes|mimes:pdf|max:2048', // Ebook bisa dikosongkan
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

    // Inisialisasi data buku
    $buku = new Buku;
    $buku->judul = $request->input('judul');
    $buku->isbn = $request->input('isbn');
    $buku->pengarang = $request->input('pengarang');
    $buku->penerbit = $request->input('penerbit');
    $buku->tahun_terbit = $request->input('tahun_terbit');

    // Proses file cover jika diunggah
    if ($request->hasFile('cover')) {
        $cover = $request->file('cover');
        $nama_cover = $cover->getClientOriginalName();
        $cover->move('cover_upload', $nama_cover);
        $buku->cover = $nama_cover;
    }

    // Proses file ebook jika diunggah
    if ($request->hasFile('ebook')) {
        $ebook = $request->file('ebook');
        $nama_ebook = $ebook->getClientOriginalName();
        $ebook->move('ebook_upload', $nama_ebook);
        $buku->ebook = $nama_ebook;
    }

    // Simpan data buku
    $buku->save();


return redirect()->route('buku')->with('sukses', 'Data Buku Perpustakaan Berhasil Ditambah');

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

        $data = Buku::findOrFail($id);

        return view('/perpus/buku/show', compact('data'));
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
        $data = Buku::findOrFail($id);
        // $users = User::get();
    
        return view('/perpus/buku/edit', compact('data'));

    
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
        $data = Buku::where('id', $id)->first();
        $data->judul       = $request->input('judul');
        $data->isbn       = $request->input('isbn');
        $data->pengarang       = $request->input('pengarang');
        $data->penerbit       = $request->input('penerbit');
        $data->tahun_terbit       = $request->input('tahun_terbit');
        $data->ebook       = $request->input('ebook');
        // $data->jumlah_buku       = $request->input('jumlah_buku');
        // $data->deskripsi       = $request->input('deskripsi');
        // $data->lokasi       = $request->input('lokasi');
        if($request->file('cover') == "")
        {
           $data->cover =$data->cover;
        } 
        else
        {
            // $data = Buku::delete('cover_upload/'.$data->cover);
        
            $file       = $request->file('cover');
            $fileName   = $file->getClientOriginalName();
            $request->file('cover')->move("cover_upload/", $fileName);
           $data->cover = $fileName;
        }
        
       $data->update();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('/perpus/buku/index')->with('sukses', 'Data Buku Perpustakaan Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        Buku::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('buku')->with('sukses', 'Data Buku Perpustakaan Berhasil Dihapus');
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_buku',$nama_file);
 
		// import data
		Excel::import(new BukuImport, public_path('/file_buku/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Buku Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/perpus/buku/index');
	}
}