<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdik extends Model
{
    protected $table = 'pesdik';
    protected $fillable = ['status', 'nama', 'kelas','tapel', 'jenis_kelamin', 'nisn', 'induk', 'tempat_lahir', 'tanggal_lahir', 'jenis_pendaftaran', 'tanggal_masuk','bank_untuk_pip','data_ayah_kandung','data_ibu_kandung','data_wali_murid','kontak'];

    //function relasi ke rombel
    
   

    public function wali()
    {
        return $this->belongsTo('App\Wali','data_ayah_kandung');
    }
    public function walii()
    {
        return $this->belongsTo('App\Wali','data_ibu_kandung');
    }
    public function waliii()
    {
        return $this->belongsTo('App\Wali','data_wali_murid');
    }
   

    public function pesdikkeluar()
    {
        return $this->hasOne('App\Pesdikkeluar');
    }

    public function pesdikalumni()
    {
        return $this->hasOne('App\Pesdikalumni');
    }

    public function transaksipembayaran()
    {
        return $this->hasMany('App\TransaksiPembayaran');
    }

    public function tarik()
    {
        return $this->hasMany('App\Tarik');
    }

    public function setor()
    {
        return $this->hasMany('App\Setor');
    }
    public function transaksiperpus()
    {
        return $this->hasMany('App\transaksiperpus');
    }
    public function BK()
    {
        return $this->hasMany('App\BK');
    }
    public function absen()
    {
        return $this->hasMany('App\absen');
    }
}
