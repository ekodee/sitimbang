<?php

namespace App\Exports;

use App\Models\Timbangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TimbangansExport implements FromView
{
    public function view(): View
    {
        $timbangans = array(
            'timbangans' => Timbangan::with(['truks', 'supirs'])->get()
        );
        return view('laporan.excel', $timbangans);
    }
}
