<?php

namespace App\Imports;

use App\Pesdik;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class PesdikImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $user = User::create([
            'name' => $row[2],
            'email' => $row[4],
            'password' => Hash::make($row[4]),
            'role' => 'siswa',
        ]);
       return new Pesdik([
            'status' => $row[1],
            'nama' => $row[2],
            'jenis_kelamin' => $row[3],
            'nisn' => $row[4],
            'kelas' => $row[5],
            'bank_untuk_pip' => $row[6],
            'data_wali_murid' => $row[8],
            'data_ayah_kandung' => $row[9],
            'data_ibu_kandung' => $row[10],
            'kontak' => $row[11],
            'induk' => $row[12],
            'tempat_lahir' => $row[13],
            'tanggal_lahir' => $row[14],
            'jenis_pendaftaran' => $row[15],
            'tanggal_masuk' => $row[16],
        ]);
      
        return $pesdik;
        // Menghubungkan Pesdik dengan User
     
    }
    
}
