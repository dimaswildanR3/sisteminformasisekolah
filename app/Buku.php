<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = ['judul', 'isbn', 'penerbit', 'pengarang', 'tahun_terbit', 'cover','ebook'];

    public function transaksi()
    {
    	return $this->hasMany(TransaksiPerpus::class);
    }
}
