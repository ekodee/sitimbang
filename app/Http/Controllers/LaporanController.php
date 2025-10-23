<?php

namespace App\Http\Controllers;

use App\Exports\TimbangansExport;
use App\Models\Timbangan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
      public function index()
      {
            $timbangans = Timbangan::with(['truks', 'supirs'])->latest()->get();
            return view('laporan.index', compact('timbangans'));
      }

      public function filter(Request $request)
      {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $query = Timbangan::with(['truks', 'supirs']);

            if ($start_date && $end_date) {
                  $query->whereBetween('created_at', [$start_date, $end_date]);
            } elseif ($start_date) {
                  $query->whereDate('created_at', '>=', $start_date);
            } elseif ($end_date) {
                  $query->whereDate('created_at', '<=', $end_date);
            }

            $timbangans = $query->get();
            return view('laporan.index', compact('timbangans'));
      }

      public function excel()
      {
            return Excel::download(new TimbangansExport, 'laporan-timbangan.xlsx');
      }
}
