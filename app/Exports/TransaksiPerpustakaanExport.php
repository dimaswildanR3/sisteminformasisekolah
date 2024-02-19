<?php

namespace App\Exports;

use App\TransaksiPerpus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransaksiPerpustakaanExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
    //     $datas = TransaksiPerpus::all();
    
    // return view('/perpus/transaksi/index', compact('datas'));
        return view('perpus/transaksi/export_excel', [
            'datas' => TransaksiPerpus::orderBy('status', 'kembali')->get(),
            // 'total_transaksi' => TransaksiPerpus::all()->sum('jumlah_bayar'),
        ]);
    }
}
