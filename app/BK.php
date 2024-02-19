<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BK extends Model
{
    protected $table = 'bk';
    protected $fillable = ['id_pesdik', 'permasalahan','status', 'tanggal'];

    //function relasi ke rombel
    public function pesdik()
    {
        return $this->belongsTo(Pesdik::class, 'id_pesdik');
    }
}
