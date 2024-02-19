<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'tamu';
    protected $fillable = ['nama', 'alamat', 'no_telp', 'tujuan','bertemu','ktp','status'];


}
