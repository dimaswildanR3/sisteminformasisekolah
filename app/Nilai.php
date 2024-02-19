<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = ['id_pesdik', 'permasalahan','status', 'tanggal', 'semester', 'rata_rata'];

    public function pesdik()
    {
        return $this->belongsTo(Pesdik::class, 'id_pesdik');
    }
}
