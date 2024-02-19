<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggotarombel extends Model
{
    protected $table = 'anggotarombel';
    protected $fillable = ['rombel_id'];

   

    public function rombel()
    {
        return $this->belongsTo('App\Rombel');
    }
}
