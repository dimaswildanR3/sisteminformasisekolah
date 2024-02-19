<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman_siswa extends Model
{
    protected $table = 'pengumuman_siswa';
    protected $fillable = ['judul','isi','users_id', 'status','tanggal'];
}
