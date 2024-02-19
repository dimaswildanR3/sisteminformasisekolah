<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPerpus extends Model
{
    protected $table = 'transaksi_perpus';
    protected $fillable = ['kode_transaksi', 'pesdik_id', 'buku_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];

    public function anggota()
    {
    	return $this->belongsTo(AnggotaPerpus::class);
    }

    public function buku()
    {
    	return $this->belongsTo(Buku::class);
    }
    public function pesdik()
  {
    return $this->belongsTo(Pesdik::class);
  }
}
