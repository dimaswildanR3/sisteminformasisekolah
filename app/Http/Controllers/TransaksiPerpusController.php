<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pesdik;
use App\Buku;
use App\pengumuman_siswa;
use App\AnggotaPerpus;
use App\TransaksiPerpus;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiPerpustakaanExport;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiPerpusController extends Controller
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
        if(Auth::user()->level == 'user')
        {
            $datas = TransaksiPerpus::where('pesdik_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = TransaksiPerpus::where('status','pinjam')->get();
        }
        return view('/perpus/transaksi/index', compact('datas'));
    }
    public function indexx()
    {
        if(Auth::user()->level == 'user')
        {
            $datas = TransaksiPerpus::where('pesdik_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = TransaksiPerpus::where('status','kembali')->get();
        }
        return view('/perpus/transaksi/bukukembali', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $getRow = TransaksiPerpus::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        // $bukus = Buku::where('jumlah_buku', '>', 0)->get();
        $anggotas = Pesdik::get();
        $bukus = Buku::get();
        return view('perpus/transaksi/create', compact('bukus', 'kode', 'anggotas'));
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
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'pesdik_id' => 'required',

        ]);

        $transaksi = TransaksiPerpus::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_pinjam' => $request->get('tgl_pinjam'),
                'tgl_kembali' => $request->get('tgl_kembali'),
                'buku_id' => $request->get('buku_id'),
                'pesdik_id' => $request->get('pesdik_id'),
                'ket' => $request->get('ket'),
                'status' => 'pinjam'
            ]);

        $transaksi->buku->where('id', $transaksi->buku_id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku - 1),
                            ]);


                pengumuman_siswa::create([
                        'judul' => "Perpustakaan",
                        'tanggal' =>$transaksi->tgl_kembali,
                        'isi' => $transaksi->buku_id,
                        'users_id' =>  $transaksi->pesdik_id,
                        'status' => $transaksi->status,
                        // 'isi_notifikasi' => addslashes($curhatan->judul_curhatan) ,
                        // 'status' => 'like',
                    ]);

        // alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = TransaksiPerpus::findOrFail($id);


        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->pesdik_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        
        // $data = TransaksiPerpus::findOrFail($id);
        // if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }
        $transaksi = TransaksiPerpus::find($id);

        $transaksi->update([
                'status' => 'kembali'
                ]);
   pengumuman_siswa::create([
                        'judul' => "Perpustakaan",
                        'tanggal' =>$transaksi->tgl_kembali,
                        'isi' => $transaksi->buku_id,
                        'users_id' =>  $transaksi->pesdik_id,
                        'status' => "kembali",
                        // 'isi_notifikasi' => addslashes($curhatan->judul_curhatan) ,
                        // 'status' => 'like',
                    ]);
        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku + 1),
                            ]);

        // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi')->with('sukses', 'Data Anggota Perpustakaan Berhasil Diubah');

        // return view('/perpus/transaksi/index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id)
    {
        $datas = TransaksiPerpus::find($id);
   pengumuman_siswa::create([
                        'judul' => "Perpustakaan",
                        'tanggal' =>$datas->tgl_kembali,
                        'isi' => $datas->buku_id,
                        'users_id' =>  $datas->pesdik_id,
                        'status' => "kembali",
                        // 'isi_notifikasi' => addslashes($curhatan->judul_curhatan) ,
                        // 'status' => 'like',
                    ]);
        $transaksi->update([
                'status' => 'kembali'
                ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku + 1),
                            ]);
                     

        // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('/perpus/transaksi/index')->with('sukses', 'Data Anggota Perpustakaan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiPerpus::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
    public function export_excel()
	{
		return Excel::download(new TransaksiPerpustakaanExport, 'Transaksiperpus.xlsx');
	}
}
