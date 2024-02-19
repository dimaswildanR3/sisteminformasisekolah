<?php

namespace App\Http\Controllers;

use App\Tarik;
use App\Pesdik; 
use App\pengumuman_siswa; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TarikController extends Controller
{
    public function index()
    {
        $data_tarik = \App\Tarik::orderByRaw('created_at DESC')->get();
        $data_pesdik = \App\Pesdik::orderByRaw('nama ASC')->get();
        return view('/tabungan/tarik/index', compact('data_tarik', 'data_pesdik'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $pilih_pesdik = $request->input('pesdik_id');
        //Mengambil nilai rombel id
        $pesdik = \App\Pesdik::where('id', $pilih_pesdik)->get();
        $data = $pesdik->first();
        $rombel_id = $data->rombel_id;

        //menghitung saldo tabungan
        $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $pilih_pesdik)
            ->sum('setor.jumlah');
        $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $pilih_pesdik)
            ->sum('tarik.jumlah');
        // $saldo_tabungan = $total_setor - $total_tarik;
        $jumlah_penarikan = $request->input('jumlah');

        
            $request->validate([
                'jumlah' => 'numeric',
            ]);
            $data_tarik = new Tarik();
            $data_tarik->pesdik_id           = $pilih_pesdik;
            // $data_tarik->rombel_id           = $rombel_id;
            $data_tarik->tanggal             = $request->input('tanggal');
            $data_tarik->jumlah              = $request->input('jumlah');
            $data_tarik->keterangan          = $request->input('keterangan');
            $data_tarik->users_id            = Auth::id();
            $data_tarik->save();
            pengumuman_siswa::create([
                        'judul' => "iuran Insidental",
                        'isi' => $data_tarik->jumlah,
                        'users_id' =>  $pilih_pesdik,
                        'status' => "sudah di bayar",
                        // 'isi_notifikasi' => addslashes($curhatan->judul_curhatan) ,
                        // 'status' => 'like',
                    ]);
            // return redirect('/tabungan/tarik/index')->with("sukses", "Data Tarik Tunai Berhasil Ditambahkan");
            $tarik = \App\Tarik::find($data_tarik->id);
            return view('/tabungan/tarik/cetak', compact('tarik'));
        
    }

    //function untuk masuk ke view edit
    public function edit($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/edit', compact('tarik'));
    }

    public function update(Request $request, $id_tarik)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $tarik = \App\Tarik::find($id_tarik);
        $tarik->update($request->all());
        $tarik->save();
        return redirect('/tabungan/tarik/index')->with('sukses', 'Data Tarik Tunai Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $tarik = \App\Tarik::find($id);
        $tarik->delete();
        return redirect('/tabungan/tarik/index')->with('sukses', 'Data Tarik Tunai Berhasil Dihapus');
    }

    //function untuk masuk ke view cetak
    public function cetak($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/cetak', compact('tarik'));
    }

    //function untuk masuk ke view cetak
    public function cetakprint($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/cetakprint', compact('tarik'));
    }

    public function siswaindex($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $data_pesdik = \App\Pesdik::where('id', $id)->get();
        $data_tarik = \App\Tarik::where('pesdik_id', $id)->orderByRaw('created_at DESC')->get();
        return view('/tabungan/tarik/siswaindex', compact('data_pesdik', 'data_tarik', 'id_pesdik_login'));
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

        return view('/pembayaran/transaksipembayaran/rekaptarik', compact('id_pesdik_login', 'data_pesdik', 'ok', 'tagihan_terbayar', 'jumlah_tagihan', 'jumlah_terbayar','pesdik'));
    }
     public function print($id)
    {
        // Fetch the kuitansi by ID
         $tarik = \App\Tarik::find($id);

        if (!$tarik) {
            abort(404); // Handle kuitansi not found
        }

        // Load a view to display the kuitansi for printing
        return view('kuitansi.prints', compact('tarik'));
    }
}
