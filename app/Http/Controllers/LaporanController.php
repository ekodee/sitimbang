<?php

namespace App\Http\Controllers;

use App\Models\Truk;
use App\Models\Timbangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TimbangansExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
      public function __construct()
      {
            $this->middleware(['permission:laporan-list|laporan-create|laporan-edit|laporan-delete'], ['only' => ['index', 'show']]);
            $this->middleware(['permission:laporan-create'], ['only' => ['create', 'store']]);
            $this->middleware(['permission:laporan-edit'], ['only' => ['edit', 'update']]);
            $this->middleware(['permission:laporan-delete'], ['only' => ['destroy']]);
      }
      public function index()
      {
            $timbangans = Timbangan::with(['truks', 'supirs'])->latest()->get();
            $truks = Truk::orderBy('no_polisi', 'asc')->get();
            return view('laporan.index', compact('timbangans', 'truks'));
      }

      public function filter(Request $request)
      {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $truk_id = $request->truk_id;

            $query = Timbangan::with(['truks', 'supirs']);

            if ($start_date && $end_date) {
                  $query->whereBetween('created_at', [$start_date, $end_date . ' 23:59:59']);
            } elseif ($start_date) {
                  $query->whereDate('created_at', '>=', $start_date);
            } elseif ($end_date) {
                  $query->whereDate('created_at', '<=', $end_date);
            }

            if ($truk_id) {
                  $query->where('truk_id', $truk_id);
            }

            $timbangans = $query->get();
            $truks = Truk::orderBy('no_polisi', 'asc')->get();
            return view('laporan.index', compact('timbangans', 'truks', 'start_date', 'end_date', 'truk_id'));
      }

      public function excel(Request $request)
      {
            $start_date = $request->query('start_date');
            $end_date = $request->query('end_date');
            $truk_id = $request->query('truk_id');


            $fileName = now()->format('d-m-Y_H:i:s');
            return Excel::download(new TimbangansExport($start_date, $end_date, $truk_id), 'laporan_timbangan_' . $fileName . '.xlsx');
      }

      public function pdf(Request $request)
      {
            $start_date = $request->query('start_date');
            $end_date = $request->query('end_date');
            $truk_id = $request->query('truk_id');

            $query = Timbangan::with(['truks', 'supirs']);

            if ($start_date && $end_date) {
                  $query->whereBetween('created_at', [$start_date, $end_date . ' 23:59:59']);
            } elseif ($start_date) {
                  $query->whereDate('created_at', '>=', $start_date);
            } elseif ($end_date) {
                  $query->whereDate('created_at', '<=', $end_date);
            }

            if ($truk_id) {
                  $query->where('truk_id', $truk_id);
            }

            $timbangans = $query->latest()->get();
            $fileName = now()->format('d-m-Y_H:i:s');

            // 3. Masukkan variabel filter ke data view
            $data = [
                  'timbangans' => $timbangans,
                  'start_date' => $start_date,
                  'end_date' => $end_date,
            ];

            $pdf = Pdf::loadView('laporan/pdf', $data);
            return $pdf->download('laporan_timbangan_' . $fileName . '.pdf');
      }
}
