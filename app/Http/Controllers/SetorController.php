<?php

namespace App\Http\Controllers;

use App\Setor;
use App\Pesdik;
use App\pengumuman_siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetorController extends Controller
{
    public function index()
    {
        $data_setor = \App\Setor::orderByRaw('created_at DESC')->get();
        $data_pesdik = \App\Pesdik::orderByRaw('nama ASC')->get();
        return view('/tabungan/setor/index', compact('data_setor', 'data_pesdik'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $pilih_pesdik = $request->input('pesdik_id');
        //Mengambil nilai rombel id
        $pesdik = \App\Pesdik::where('id', $pilih_pesdik)->get();
        $data = $pesdik->first();
        

        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Setor();
        $data_setor->pesdik_id           = $pilih_pesdik;
        // $data_setor->rombel_id           = $rombel_id;
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->users_id            = Auth::id();
        $data_setor->save();

pengumuman_siswa::create([
                        'judul' => "iuran Personal",
                        'isi' => $data_setor->jumlah,
                        'users_id' =>  $pilih_pesdik,
                        'status' => "sudah di bayar",
                        // 'isi_notifikasi' => addslashes($curhatan->judul_curhatan) ,
                        // 'status' => 'like',
                    ]);
//         $data_lain = new \App\pengumuman_siswa();
// $data_lain->judul = $request->'setatus pembayaran'; 
// $data_lain->isi = $request->; 
// $data_lain->users_id = $request->$pilih_pesdik; 
// $data_lain->status = $request->sudah; 
// $data_lain->save();

$setor = \App\Setor::find($data_setor->id);
        $setor = \App\Setor::find($data_setor->id);
        return view('/tabungan/setor/cetak', compact('setor'));
    }

    //function untuk masuk ke view edit
    public function edit($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/edit', compact('setor'));
    }
    public function update(Request $request, $id_setor)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $setor = \App\Setor::find($id_setor);
        $setor->update($request->all());
        $setor->save();
        return redirect('/tabungan/setor/index')->with('sukses', 'Data Setor Tunai Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $setor = \App\Setor::find($id);
        $setor->delete();
        return redirect('/tabungan/setor/index')->with('sukses', 'Data Setor Tunai Berhasil Dihapus');
    }

    //function untuk masuk ke view cetak
    public function cetak($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/cetak', compact('setor'));
    }

    //function untuk masuk ke view cetak
    public function cetakprint($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/cetakprint', compact('setor'));
    }

    public function siswaindex($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $data_pesdik = \App\Pesdik::where('id', $id)->get();
        $data_setor = \App\Setor::where('pesdik_id', $id)->orderByRaw('created_at DESC')->get();
        return view('/tabungan/setor/siswaindex', compact('data_pesdik', 'data_setor', 'id_pesdik_login'));
    }

     public function rekap($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $pesdik = \App\Anggotarombel::groupBy('pesdik_id')->orderByRaw('updated_at - created_at DESC')->get();
        $data = \App\Anggotarombel::where('pesdik_id', $id)->get();
        $data_pesdik = $data->last();

        //Mencari Data Tagihan Per Siswa
        $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $id)->get();
        $pesdik_jk = \App\Pesdik::select('jenis_kelamin')->where('id', $id)->first();
        $pilih_jk =  \App\Tagihan::whereIn('jenis_kelamin', $pesdik_jk)->orWhere('jenis_kelamin', 'Semua')->get();

        // $id_tagihan_terbayar = \App\TransaksiPembayaran::select('tagihan_id')->where('pesdik_id', $id)->get();
        $ok = \App\Setor::where('pesdik_id', $id)->get();
        // dd($tagihan_siswa);
        $tagihan_terbayar = \App\TransaksiPembayaran::where('pesdik_id', $id)
            ->leftJoin('tagihan', function ($join) {
                $join->on('transaksipembayaran.tagihan_id', '=', 'tagihan.id');
            })
            ->orderByRaw('transaksipembayaran.rombel_id DESC')->get();
        $jumlah_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
            ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
        $jumlah_terbayar =  \App\TransaksiPembayaran::where('pesdik_id', $id)
            ->sum('jumlah_bayar');

        return view('/pembayaran/transaksipembayaran/rekappembayaran', compact('id_pesdik_login', 'data_pesdik', 'ok', 'tagihan_terbayar', 'jumlah_tagihan', 'jumlah_terbayar','pesdik'));
    }
     public function print($id)
    {
        // Fetch the kuitansi by ID
         $setor = \App\Setor::find($id);

        if (!$setor) {
            abort(404); // Handle kuitansi not found
        }

        // Load a view to display the kuitansi for printing
        return view('kuitansi.print', compact('setor'));
    }
}
