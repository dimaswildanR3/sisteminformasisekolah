<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

//Route untuk user Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasPerpus,adminabsen,petugastu,walikelas,gurumapel,bk,PetugasAdministrasiKeuangan']], function () {

    Route::get('/guru/index', 'GuruController@index');
    Route::post('/guru/tambah', 'GuruController@tambah');
    Route::get('/guru/{id}/edit', 'GuruController@edit');
    Route::post('/guru/{id}/update', 'GuruController@update');
    Route::get('/guru/{id}/delete', 'GuruController@delete');


    Route::get('/tamu/index', 'TamuController@index')->name('tamu');
    Route::post('/tamu/{id}/status', 'TamuController@updatehStatus')->name('status.status');
    Route::post('/tamu/tambah', 'TamuController@tambah');
    Route::get('/tamu/{id}/edit', 'TamuController@edit');
    Route::post('/tamu/{id}/update', 'TamuController@update');
    Route::get('/tamu/{id}/delete', 'TamuController@delete');

    Route::get('/bk/index', 'BKController@index')->name('bk');;
    Route::get('/bk/create', 'BKController@create');
    Route::post('/bk/store', 'BKController@store');
    Route::get('/bk/{id}/edit', 'BKController@edit');
    Route::post('/bk/{id}/update', 'BKController@update');
    Route::get('/bk/{id}/delete', 'BKController@delete');

    Route::get('/absen/index', 'AbsenController@index')->name('absen');;
    Route::get('/absen/create', 'AbsenController@create');
    Route::post('/absen/store', 'AbsenController@store');
    Route::get('/absen/{id}/edit', 'AbsenController@edit');
    Route::post('/absen/{id}/update', 'AbsenController@update');
    Route::get('/absen/{id}/delete', 'AbsenController@delete');
    Route::post('/absen/index','AbsenController@inputToAbsensi')->name('input.absensi');
    Route::get('/filter-absensia', 'AbsenController@filterAbsensi')->name('filter.absensia');


    Route::get('/nilai/index', 'NilaiController@index')->name('nilai');;
    Route::get('/nilai/create', 'NilaiController@create');
    Route::post('/nilai/store', 'NilaiController@store');
    Route::get('/nilai/{id}/edit', 'NilaiController@edit');
    Route::post('/nilai/{id}/update', 'NilaiController@update');
    Route::get('/nilai/{id}/delete', 'NilaiController@delete');
    Route::get('/filter-absensi', 'NilaiController@filter')->name('filter.absensi');


    Route::get('/pembayaran/transaksipembayaran/{id}/siswaindex', 'AbsenController@siswa');

    Route::get('/tendik/index', 'TendikController@index');
    Route::post('/tendik/tambah', 'TendikController@tambah');
    Route::get('/tendik/{id}/edit', 'TendikController@edit');
    Route::post('/tendik/{id}/update', 'TendikController@update');
    Route::get('/tendik/{id}/delete', 'TendikController@delete');

    Route::get('/rombel/index', 'RombelController@index');
    Route::post('/rombel/tambah', 'RombelController@tambah');
    Route::get('/rombel/{id}/anggota', 'RombelController@anggota');
    Route::get('/rombel/{rombel}/tambahAnggota', 'RombelController@tambahAnggota');
    Route::post('/rombel/{id_rombel}/simpanAnggota', 'RombelController@simpanAnggota');
    Route::get('/rombel/{id}/edit', 'RombelController@edit');
    Route::post('/rombel/{id}/update', 'RombelController@update');
    Route::get('/rombel/{id}/delete', 'RombelController@delete');

    Route::get('/tapel/index', 'TapelController@index');
    Route::post('/tapel/tambah', 'TapelController@tambah');
    Route::get('/tapel/{id}/edit', 'TapelController@edit');
    Route::post('/tapel/{id}/update', 'TapelController@update');
    Route::get('/tapel/{id}/delete', 'TapelController@delete');

    Route::get('/perpus/anggota/index', 'AnggotaPerpusController@index')->name('anggota');
    Route::get('/perpus/anggota/create', 'AnggotaPerpusController@create');
    Route::post('/perpus/anggota/store', 'AnggotaPerpusController@store');
    Route::get('/perpus/anggota/{id}/edit', 'AnggotaPerpusController@edit');
    Route::post('/perpus/anggota/{id}/update', 'AnggotaPerpusController@update');
    Route::get('/perpus/anggota/{id}/delete', 'AnggotaPerpusController@delete');
    Route::get('/perpus/anggota/{id}/show', 'AnggotaController@show');
    

    Route::get('/perpus/buku/index', 'BukuController@index')->name('buku');
    Route::get('/perpus/buku/create', 'BukuController@create');
    Route::post('/perpus/buku/store', 'BukuController@store');
    Route::get('/perpus/buku/{id}/edit', 'BukuController@edit');
    Route::post('/perpus/buku/{id}/update', 'BukuController@update');
    Route::get('/perpus/buku/{id}/show', 'BukuController@show');
    Route::get('/perpus/buku/{id}/delete', 'BukuController@delete');
    Route::post('/buku/import_excel', 'BukuController@import_excel');

    Route::get('/perpus/transaksi/index', 'TransaksiPerpusController@index')->name('transaksi');
    Route::get('/perpus/transaksi/bukukembali', 'TransaksiPerpusController@indexx')->name('anggota');
    Route::get('/perpus/transaksi/create', 'TransaksiPerpusController@create');
    Route::post('/perpus/transaksi/store', 'TransaksiPerpusController@store');
    Route::get('/perpus/transaksi/{id}/edit', 'TransaksiPerpusController@edit');
    Route::post('/perpus/transaksi/{id}/update', 'TransaksiPerpusController@update');
    Route::get('/perpus/transaksi/{id}/show', 'TransaksiPerpusController@show');
    Route::get('/perpus/transaksi/{id}/delete', 'TransaksiPerpusController@delete');
    Route::get('/perpus/transaksi/export_excel', 'TransaksiPerpusController@export_excel');


    Route::get('/pesdik/index', 'PesdikController@index');
    Route::get('/pesdik/create', 'PesdikController@create');
    Route::post('/pesdik/tambah', 'PesdikController@tambah');
    Route::get('/pesdik/{id}/edit', 'PesdikController@edit');
    Route::post('/pesdik/{id}/update', 'PesdikController@update');
    Route::get('/pesdik/{id}/delete', 'PesdikController@delete');
    Route::post('/pesdik/import_excel', 'PesdikController@import_excel');

    Route::get('/pesdik/{id}/registrasi', 'PesdikController@registrasi');
    Route::post('/pesdik/{id}/keluar', 'PesdikController@keluar');
    Route::get('/pesdik/keluarindex', 'PesdikController@keluarindex');
    Route::post('/pesdik/{id}/alumni', 'PesdikController@alumni');
    Route::get('/pesdik/alumniindex', 'PesdikController@alumniindex');
    

    Route::get('/pengumuman/{id}/edit', 'PengumumanController@edit');
    Route::post('/pengumuman/{id}/update', 'PengumumanController@update');
    Route::get('/pengumuman/{id}/delete', 'PengumumanController@delete');

    //Route delete untuk admin
    Route::get('/suratmasuk/{id}/delete', 'SuratMasukController@delete');
    Route::get('/suratkeluar/{id}/delete', 'SuratKeluarController@delete');
    Route::get('/klasifikasi/{id}/delete', 'KlasifikasiController@delete');
    Route::delete('disposisi/{suratmasuk}/{id}', 'DisposisiController@destroy')->name('disposisi.destroy');
    Route::get('/keuangan/pemasukan/{id}/delete', 'PemasukanController@delete');
    Route::get('/keuangan/pemasukan/{id}/deletekategori', 'PemasukanController@deletekategori');
    Route::get('/keuangan/pengeluaran/{id}/delete', 'PengeluaranController@delete');
    Route::get('/keuangan/pengeluaran/{id}/deletekategori', 'PengeluaranController@deletekategori');
    Route::get('/tabungan/setor/{id}/delete', 'SetorController@delete');
    Route::get('/tabungan/tarik/{id}/delete', 'TarikController@delete');
    Route::get('/pembayaran/tagihan/{id}/delete', 'TagihanController@delete');

    //Route untuk instansi dan pengguna contoller
    Route::resource('/instansi', 'InstansiController');
    Route::resource('/pengguna', 'PenggunaController');
});

//Route untuk user Petugas Administrasi Keuangan dan Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan']], function () {

    Route::get('/pembayaran/tagihan/index', 'TagihanController@index')->name('pembayaran.tagihan.index');
    Route::get('/pembayaran/tagihan/create', 'TagihanController@create');
    Route::post('/pembayaran/tagihan/tambah', 'TagihanController@tambah')->name('pembayaran.tagihan.tambah');
    Route::get('/pembayaran/tagihan/{id}/edit', 'TagihanController@edit');
    Route::post('/pembayaran/tagihan/{id}/update', 'TagihanController@update');
    Route::post('/pembayaran/tagihan/filter', 'TagihanController@filter');
    Route::get('/pembayaran/tagihan/{filter}/print', 'TagihanController@print');

    Route::get('/pembayaran/transaksipembayaran/index', 'TransaksiPembayaranController@index')->name('pembayaran.transaksipembayaran.index');
    Route::post('/pembayaran/transaksipembayaran/cari_pesdik', 'TransaksiPembayaranController@cari_pesdik');
    Route::post('/pembayaran/transaksipembayaran/{id}/form_bayar', 'TransaksiPembayaranController@form_bayar');
    Route::post('/pembayaran/transaksipembayaran/bayar', 'TransaksiPembayaranController@bayar');
    Route::post('/pembayaran/transaksipembayaran/cetak_invoice', 'TransaksiPembayaranController@cetak_invoice');

    Route::get('/tabungan/setor/index', 'SetorController@index');
    Route::post('/tabungan/setor/tambah', 'SetorController@tambah');
    Route::get('/tabungan/setor/{id}/edit', 'SetorController@edit');
    Route::post('/tabungan/setor/{id}/update', 'SetorController@update');
    Route::get('/tabungan/setor/{id}/cetak', 'SetorController@cetak');
    Route::get('/tabungan/setor/{id}/cetakprint', 'SetorController@cetakprint');


    Route::get('/tabungan/tarik/index', 'TarikController@index');
    Route::post('/tabungan/tarik/tambah', 'TarikController@tambah');
    Route::get('/tabungan/tarik/{id}/edit', 'TarikController@edit');
    Route::post('/tabungan/tarik/{id}/update', 'TarikController@update');
    Route::get('/tabungan/tarik/{id}/cetak', 'TarikController@cetak');
    Route::get('/tabungan/tarik/{id}/cetakprint', 'TarikController@cetakprint');

    Route::get('/keuangan/pemasukan/index', 'PemasukanController@index');
    Route::post('/keuangan/pemasukan/tambah', 'PemasukanController@tambah');
    Route::get('/keuangan/pemasukan/{id}/edit', 'PemasukanController@edit');
    Route::post('/keuangan/pemasukan/{id}/update', 'PemasukanController@update');

    Route::post('/keuangan/pemasukan/tambahkategori', 'PemasukanController@tambahkategori');
    Route::get('/keuangan/pemasukan/{id}/deletekategori', 'PemasukanController@deletekategori');

    Route::get('/keuangan/pengeluaran/index', 'PengeluaranController@index');
    Route::post('/keuangan/pengeluaran/tambah', 'PengeluaranController@tambah');
    Route::get('/keuangan/pengeluaran/{id}/edit', 'PengeluaranController@edit');
    Route::post('/keuangan/pengeluaran/{id}/update', 'PengeluaranController@update');

    Route::post('/keuangan/pengeluaran/tambahkategori', 'PengeluaranController@tambahkategori');

    Route::get('/pembayaran/transaksipembayaran/index', 'TransaksiPembayaranController@index')->name('pembayaran.transaksipembayaran.index');
    Route::post('/pembayaran/transaksipembayaran/cari_pesdik', 'TransaksiPembayaranController@cari_pesdik');
    Route::post('/pembayaran/transaksipembayaran/{id}/form_bayar', 'TransaksiPembayaranController@form_bayar');
    Route::post('/pembayaran/transaksipembayaran/bayar', 'TransaksiPembayaranController@bayar');
    Route::post('/pembayaran/transaksipembayaran/cetak_invoice', 'TransaksiPembayaranController@cetak_invoice');

    Route::get('/laporankeuangan/transaksipembayaran/index', 'LaporanController@tPembayaranIndex')->name('laporankeuangan.transaksipembayaran.index');
    Route::post('/laporankeuangan/transaksipembayaran/filterByNama', 'LaporanController@tPembayaranfilterByNama')->name('laporankeuangan.transaksipembayaran.filterByNama');
    Route::post('/laporankeuangan/transaksipembayaran/filterByKelas', 'LaporanController@tPembayaranfilterByKelas')->name('laporankeuangan.transaksipembayaran.filterByKelas');
    Route::post('/laporankeuangan/transaksipembayaran/filterByTanggal', 'LaporanController@tPembayaranfilterByTanggal')->name('laporankeuangan.transaksipembayaran.filterByTanggal');
    Route::get('/laporankeuangan/transaksipembayaran/DownloadExcel', 'LaporanController@tPembayaranDownloadExcel')->name('laporankeuangan.transaksipembayaran.DownloadExcel');
    Route::post('/laporankeuangan/transaksipembayaran/cetak', 'LaporanController@tPembayaranCetak');

    Route::get('/laporankeuangan/setortariktunai/index', 'LaporanController@tSetorTarikIndex')->name('laporankeuangan.setortariktunai.index');
    Route::post('/laporankeuangan/setortariktunai/filterByNama', 'LaporanController@tSetorTarikfilterByNama')->name('laporankeuangan.setortariktunai.filterByNama');
    Route::post('/laporankeuangan/setortariktunai/filterByKelas', 'LaporanController@tSetorTarikfilterByKelas')->name('laporankeuangan.setortariktunai.filterByKelas');
    Route::post('/laporankeuangan/setortariktunai/filterByTanggal', 'LaporanController@tSetorTarikfilterByTanggal')->name('laporankeuangan.setortariktunai.filterByTanggal');
    Route::get('/laporankeuangan/setortariktunai/DownloadExcel', 'LaporanController@tSetorTarikDownloadExcel')->name('laporankeuangan.setortariktunai.DownloadExcel');
    Route::post('/laporankeuangan/setortariktunai/cetak', 'LaporanController@tSetorTarikCetak');

    Route::get('/laporankeuangan/keuangansekolah/index', 'LaporanController@tKeuanganSekolahIndex')->name('laporankeuangan.keuangansekolah.index');
    Route::post('/laporankeuangan/keuangansekolah/filterByKategori', 'LaporanController@tKeuanganSekolahfilterByKategori')->name('laporankeuangan.keuangansekolah.filterByKategori');
    Route::post('/laporankeuangan/keuangansekolah/filterByTanggal', 'LaporanController@tKeuanganSekolahfilterByTanggal')->name('laporankeuangan.keuangansekolah.filterByTanggal');
    Route::get('/laporankeuangan/keuangansekolah/DownloadExcel', 'LaporanController@tKeuanganSekolahDownloadExcel')->name('laporankeuangan.keuangansekolah.DownloadExcel');
    Route::post('/laporankeuangan/keuangansekolah/cetak', 'LaporanController@tKeuanganSekolahCetak');
});

//Route untuk user Petugas Administrasi Surat dan Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiSurat']], function () {

    Route::get('/suratmasuk', 'SuratMasukController@index');
    Route::get('/suratmasuk/index', 'SuratMasukController@index');
    Route::get('/suratmasuk/create', 'SuratMasukController@create');
    Route::post('/suratmasuk/tambah', 'SuratMasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil', 'SuratMasukController@tampil');
    Route::get('viewAlldownloadfile', 'SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit', 'SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update', 'SuratMasukController@update');

    Route::get('/suratmasuk/agenda', 'SuratMasukController@agenda')->name('suratmasuk.agenda');
    Route::post('/suratmasuk/filter_agenda', 'SuratMasukController@filter_agenda');
    Route::post('/suratmasuk/cetakagenda', 'SuratMasukController@cetakagenda');

    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri', 'SuratMasukController@galeri');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index', 'SuratKeluarController@index');
    Route::get('/suratkeluar/create', 'SuratKeluarController@create');
    Route::post('/suratkeluar/tambah', 'SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil', 'SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile', 'SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit', 'SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update', 'SuratKeluarController@update');

    Route::get('/suratkeluar/agenda', 'SuratKeluarController@agenda')->name('suratkeluar.agenda');
    Route::post('/suratkeluar/filter_agenda', 'SuratKeluarController@filter_agenda');
    Route::post('/suratkeluar/cetakagenda', 'SuratKeluarController@cetakagenda');
    Route::get('/suratkeluar.agendakeluardownload_excel', 'SuratKeluarController@agendakeluardownload_excel')->name('suratkeluar.downloadexcel');
    Route::get('/suratkeluar/galeri', 'SuratKeluarController@galeri');


    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index', 'KlasifikasiController@index');
    Route::get('/klasifikasi/create', 'KlasifikasiController@create');
    Route::post('/klasifikasi/tambah', 'KlasifikasiController@tambah');
    Route::get('/klasifikasi/{id}/edit', 'KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update', 'KlasifikasiController@update');

    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

    Route::get('disposisi/{suratmasuk}', 'DisposisiController@index')->name('disposisi.index');
    Route::post('disposisi/{suratmasuk}', 'DisposisiController@store')->name('disposisi.store');
    Route::get('disposisi/{suratmasuk}/create', 'DisposisiController@create')->name('disposisi.create');
    Route::get('disposisi/{suratmasuk}/{id}/edit', 'DisposisiController@edit')->name('disposisi.edit');
    Route::get('disposisi/{suratmasuk}/{id}', 'DisposisiController@update')->name('disposisi.update');
    Route::get('/disposisi/{suratmasuk}/{id}/download', 'DisposisiController@download')->name('disposisi.download');
});

//Route untuk user siswa
Route::group(['middleware' => ['auth', 'checkRole:Siswa']], function () {
    Route::get('/{id}/siswadashboard', 'DashboardController@siswadashboard')->name('siswadashboard');
    Route::get('/tabungan/setor/{id}/siswaindex', 'SetorController@siswaindex');
    Route::get('/tabungan/tarik/{id}/siswaindex', 'TarikController@siswaindex');
    Route::get('/pembayaran/transaksipembayaran/{id}/siswaindex', 'TransaksiPembayaranController@siswaindex');
    Route::post('/pembayaran/transaksipembayaran/{id}/update-status', 'TransaksiPembayaranController@updatePublishStatus')->name('updateStatus');
    Route::get('/pembayaran/transaksipembayaran/{id}/pulangindex', 'TransaksiPembayaranController@pulangindex');
    Route::post('/pembayaran/transaksipembayaran/{id}/update-statuss', 'TransaksiPembayaranController@updatePublishStatuss')->name('updateStatuss');
    Route::get('/pembayaran/transaksipembayaran/{id}/rekap', 'TransaksiPembayaranController@rekap');
    Route::get('/pembayaran/transaksipembayaran/{id}/rekappembayaran', 'SetorController@rekap');
    Route::get('/pembayaran/transaksipembayaran/{id}/rekaptarik', 'TarikController@rekap');
    Route::get('kuitansi/{id}/print', 'SetorController@print')->name('kuitansi.print');
    Route::get('kuitansi/{id}/prints', 'TarikController@print')->name('kuitansi.prints');

     Route::get('/bk/{id}/siswa', 'BKController@siswa');
    Route::post('/bk/{id}/storesis', 'BKController@storesis')->name('siswa');
    // Route::get('/pembayaran/transaksipembayaran/{id}/siswaindex', 'TransaksiPembayaranController@updatePublishStatus');
});

//Route untuk user Admin, Petugas Administrasi Surat dan Petugas Administrasi Keuangan
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasAdministrasiSurat,PetugasPerpus,walikelas,gurumapel,petugastu,adminabsen,bk']], function () {
    Route::get('/', function () {
        return view('/dashboard');
    });
    
    Route::get('/dashboard', 'DashboardController@index');
    
    Route::get('/pengumuman/index', 'PengumumanController@index');
    Route::post('/pengumuman/tambah', 'PengumumanController@tambah');
});

//Route untuk user Admin, Petugas Administrasi Surat, Petugas Administrasi Keuangan dan Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasPerpus,walikelas,gurumapel,petugastu,adminabsen,Siswa,bk']], function () {
    Route::get('/auths/{id}/gantipassword', 'AuthController@gantipassword');
    Route::post('/auths/{id}/simpanpassword', 'AuthController@simpanpassword');
});

    // Route::get('/', function () {
    //     return view('/siswadashboard');
    // });