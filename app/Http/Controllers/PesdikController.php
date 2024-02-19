<?php

namespace App\Http\Controllers;

use App\Pesdik;
use App\Pesdikkeluar;
use App\Pesdikalumni;
use App\User;
use App\Wali;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\PesdikImport;
use Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PesdikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pesdik = \App\Pesdik::where('status', 'Aktif')->orderByRaw('nama ASC')->get();
        return view('pesdik.index', ['data_pesdik' => $data_pesdik]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $tapel_terakhir = \App\Rombel::max('tapel_id');
        
        $data_ayah = \App\Wali::where('jenis_wali_murid','Ayah Kandung')->orderBy('jenis_wali_murid','Ayah Kandung')->get();
        $ibu = \App\Wali::where('jenis_wali_murid','Ibu Kandung')->orderBy('jenis_wali_murid','Ibu Kandung')->get();
        $data_wali = \App\Wali::where('jenis_wali_murid','Wali')->orderBy('jenis_wali_murid','Wali')->get();
        return view('pesdik.create' ,['data_ayah' => $data_ayah,'ibu' => $ibu,'data_wali' => $data_wali] );
        
    }

    //function untuk tambah
  public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'min:5',
            'nisn' => 'unique:pesdik|size:10',
            'induk' => 'unique:pesdik|min:2|max:6',
 'kontak' => 'unique:pesdik|min:2|max:12',
        ]);
        //Menambah data ke tabel pesdik
        $pesdik = new Pesdik();
        $pesdik->status             = 'Aktif';
        $pesdik->nama               = $request->input('nama');
        $pesdik->jenis_kelamin      = $request->input('jenis_kelamin');
        $pesdik->nisn               = $request->input('nisn');
        $pesdik->kelas               = $request->input('kelas');
        $pesdik->tapel               = $request->input('tapel');
        $pesdik->bank_untuk_pip     = $request->input('bank_untuk_pip');
        $pesdik->data_wali_murid    = $request->input('data_wali_murid');
        $pesdik->data_ayah_kandung    = $request->input('data_ayah_kandung');
        $pesdik->data_ibu_kandung    = $request->input('data_ibu_kandung');
        $pesdik->kontak              = $request->input('kontak');
        $pesdik->induk              = $request->input('induk');
        $pesdik->tempat_lahir       = $request->input('tempat_lahir');
        $pesdik->tanggal_lahir      = $request->input('tanggal_lahir');
        $pesdik->jenis_pendaftaran  = $request->input('jenis_pendaftaran');
        $pesdik->tanggal_masuk      = $request->input('tanggal_masuk');
        $pesdik->save();

        

        // Menambah acount user dengan role Siswa
        $nisn = $request->input('nisn');
        // $extensi = "@siswa.com";
        $buatUsername = $nisn ;
        $role = "Siswa";
        $pengguna = User::create([
            'name' => $request->input('nama'),
            'email' => $buatUsername,
            'password' => Hash::make($request->input('nisn')),
            'role' => $role,
        ]);
        return redirect('/pesdik/index')->with("sukses", "Data Peserta Didik Berhasil Ditambahkan");
    }

    //function untuk masuk ke modal
    public function registrasi($id_pesdik)
    {
        $pesdik = \App\Pesdik::find($id_pesdik);
        
        $data_wali = \App\Wali::all();
        return view('pesdik/registrasi', ['pesdik' => $pesdik], ['data_wali' => $data_wali]);
    }

    //function untuk registrasi keluar
    public function keluar(Request $request, $id_pesdik)
    {
        $request->validate([
            'alasan_keluar' => 'min:10',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $reg      = 'Keluar';

        $pesdikkeluar = new Pesdikkeluar();
        $pesdikkeluar->pesdik_id        = $id_pesdik;
        $pesdikkeluar->keluar_karena    = $request->input('keluar_karena');
        $pesdikkeluar->tanggal_keluar   = $request->input('tanggal_keluar');
        $pesdikkeluar->alasan_keluar    = $request->input('alasan_keluar');
        $pesdikkeluar->save();

        $pesdik->status = $reg;
        $pesdik->update();
        return redirect('pesdik/index')->with('sukses', 'Registrasi Peserta Didik Keluar, Berhasil !');
    }

    //function untuk masuk ke view pesdik keluar
    public function keluarindex()
    {
        $data_pesdikkeluar = \App\Pesdikkeluar::orderByRaw('pesdik_id ASC')->get();
        return view('pesdik.keluarindex', compact('data_pesdikkeluar'));
    }

    //function untuk registrasi alumni
    public function alumni(Request $request, $id_pesdik)
    {
        $request->validate([
            'keterangan' => 'min:10',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $reg      = 'Lulus';

        $pesdikalumni = new Pesdikalumni();

        $pesdikalumni->pesdik_id        = $id_pesdik;
        $pesdikalumni->tanggal_lulus    = $request->input('tanggal_lulus');
        $pesdikalumni->melanjutkan_ke   = $request->input('melanjutkan_ke');
        $pesdikalumni->keterangan       = $request->input('keterangan');
        $pesdikalumni->save();
        $pesdik->status = $reg;
        $pesdik->update();
        return redirect('pesdik/index')->with('sukses', 'Registrasi Peserta Didik Lulus, Berhasil !');
    }

    //function untuk masuk ke view pesdik alumni
    public function alumniindex()
    {
        $data_pesdikalumni = \App\Pesdikalumni::orderByRaw('pesdik_id ASC')->get();
        return view('pesdik.alumniindex', ['data_pesdikalumni' => $data_pesdikalumni]);
    }

  public function edit($id_pesdik)
    {
        $pesdik = \App\Pesdik::find($id_pesdik);
        $data_rombel = \App\Rombel::all();
        $data_ayah = \App\Wali::where('jenis_wali_murid','Ayah Kandung')->orderBy('jenis_wali_murid','Ayah Kandung')->get();
        $ibu = \App\Wali::where('jenis_wali_murid','Ibu Kandung')->orderBy('jenis_wali_murid','Ibu Kandung')->get();
        $data_wali = \App\Wali::where('jenis_wali_murid','Wali')->orderBy('jenis_wali_murid','Wali')->get();
        return view('pesdik/edit', ['pesdik' => $pesdik,'data_rombel' => $data_rombel,'data_ayah' => $data_ayah,'ibu' => $ibu,'data_wali' => $data_wali]);
    }
    public function update(Request $request, $id_pesdik)
    {
        $request->validate([
            'nama' => 'min:5',
            'nisn' => 'size:10',
            'induk' => 'min:2|max:6',
            'kontak' => 'min:2|max:12',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $pesdik->update($request->all());
        $pesdik->save();
        return redirect('pesdik/index')->with('sukses', 'Data Peserta Didik Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
       
        try {
            $pesdik = \App\Pesdik::find($id);
            $pesdik->delete();
            return redirect('pesdik/index')->with('sukses', 'Data Tahun Pelajaran Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang tersambung dengan data ini!');
        }
    }
    public function import_excel(Request $request) 
    {
        // Validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
    
        // Menangkap file excel
        $file = $request->file('file');
    
        // Membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
    
        // Upload ke folder file_pesdik di dalam folder public
        $file->move('file_pesdik', $nama_file);
    
        // Impor data
        Excel::import(new PesdikImport, public_path('/file_pesdik/' . $nama_file));
    
        // Notifikasi dengan session
        Session::flash('sukses', 'Data Pesdik Berhasil Diimport!');
    
        // Alihkan halaman kembali
        return redirect('/pesdik/index');
    }
    
    
}
