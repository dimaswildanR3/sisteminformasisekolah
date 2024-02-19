<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaPerpus extends Model
{
    protected $table = 'anggota_perpus';
    protected $fillable = ['users_id', 'nisn', 'nama', 'tempat_lahir', 'tgl_lahir', 'jk', 'tingkat_kelas', 'image'];


    /**
     * Method One To One 
     */
    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(TransaksiPerpus::class);
    }
}
