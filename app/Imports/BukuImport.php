<?php

namespace App\Imports;

use App\Buku;
use Maatwebsite\Excel\Concerns\ToModel;

class BukuImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buku([
            'judul' => $row[1],
            'isbn' => $row[2],
            'pengarang' => $row[3],
            'penerbit' => $row[4],
            'tahun_terbit' => $row[5],
            'ebook' => $row[6],
            'cover' => $row[7],
        ]);
    }
}
