<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    protected $table = 'wali_murid';
    protected $fillable = ['jenis_wali_murid', 'nama','NIK', 'jenis_kelamin', 'nama_anak', 'tempat_lahir', 'tanggal_lahir', 'alamat'];



    public function pesdik()
  {
    return $this->hasMany('App\Pesdik');
  }
  
}