<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    protected $table = 'absen';
    protected $fillable = ['id_pesdik', 'absen', 'pulang','tanggal','kelas','keterangan'];

    //function relasi ke rombel
    public function pesdik()
    {
        return $this->belongsTo(Pesdik::class, 'id_pesdik');
    }
}
