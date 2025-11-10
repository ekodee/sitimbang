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

      // Tambahkan method ini di LaporanController
      protected function getSummaryData($timbangans, $start_date = null, $end_date = null)
      {
            if ($timbangans->count() === 0) {
                  return [
                        'total_transaksi' => 0,
                        'total_berat_sampah' => 0,
                        'total_berat_sampah_ton' => 0,
                        'rata_rata_berat' => 0,
                        'berat_tertinggi' => 0,
                        'berat_terendah' => 0,
                        'truk_terbanyak' => null,
                        'jumlah_truk' => 0,
                        'periode' => $this->getPeriodeText($start_date, $end_date),
                        'tanggal_dibuat' => now('Asia/Jakarta')->format('d-m-Y H:i:s'),
                  ];
            }

            $totalBeratSampah = $timbangans->sum('berat_sampah');
            $rataRata = $timbangans->avg('berat_sampah');

            // Analisis per truk
            $trukSummary = $timbangans->groupBy('truk_id')->map(function ($items) {
                  return [
                        'nama' => $items->first()->truks->no_polisi,
                        'total_berat' => $items->sum('berat_sampah'),
                        'jumlah_transaksi' => $items->count()
                  ];
            })->sortByDesc('total_berat');

            $trukTerbanyak = $trukSummary->first();

            return [
                  'total_transaksi' => $timbangans->count(),
                  'total_berat_sampah' => $totalBeratSampah,
                  'total_berat_sampah_ton' => $totalBeratSampah / 1000,
                  'rata_rata_berat' => $rataRata,
                  'berat_tertinggi' => $timbangans->max('berat_sampah'),
                  'berat_terendah' => $timbangans->min('berat_sampah'),
                  'truk_terbanyak' => $trukTerbanyak,
                  'jumlah_truk' => $trukSummary->count(),
                  'periode' => $this->getPeriodeText($start_date, $end_date),
                  'tanggal_dibuat' => now('Asia/Jakarta')->format('d-m-Y H:i:s')
            ];
      }

      protected function getPeriodeText($start_date, $end_date)
      {
            if ($start_date && $end_date) {
                  return \Carbon\Carbon::parse($start_date)->format('d-m-Y') . ' s/d ' .
                        \Carbon\Carbon::parse($end_date)->format('d-m-Y');
            } elseif ($start_date) {
                  return 'Mulai ' . \Carbon\Carbon::parse($start_date)->format('d-m-Y');
            } elseif ($end_date) {
                  return 'Sampai ' . \Carbon\Carbon::parse($end_date)->format('d-m-Y');
            } else {
                  return 'Semua Tanggal';
            }
      }

      public function filter(Request $request)
      {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $truk_id = $request->truk_id;

            $query = Timbangan::with(['truks', 'supirs']);

            if ($start_date && $end_date) {
                  $query->whereBetween('waktu_masuk', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            } elseif ($start_date) {
                  $query->whereDate('waktu_masuk', '>=', $start_date);
            } elseif ($end_date) {
                  $query->whereDate('waktu_masuk', '<=', $end_date);
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

            $fileName = now()->format('d-m-Y_H-i-s');
            return Excel::download(new TimbangansExport($start_date, $end_date, $truk_id), 'laporan_timbangan_' . $fileName . '.xlsx');
      }

      public function pdf(Request $request)
      {
            $start_date = $request->query('start_date');
            $end_date = $request->query('end_date');
            $truk_id = $request->query('truk_id');

            $query = Timbangan::with(['truks', 'supirs']);

            if ($start_date && $end_date) {
                  $query->whereBetween('waktu_masuk', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            } elseif ($start_date) {
                  $query->whereDate('waktu_masuk', '>=', $start_date);
            } elseif ($end_date) {
                  $query->whereDate('waktu_masuk', '<=', $end_date);
            }


            if ($truk_id) {
                  $query->where('truk_id', $truk_id);
            }

            $timbangans = $query->latest()->get();
            $fileName = now()->format('d-m-Y_H-i-s');

            $data = [
                  'timbangans' => $timbangans,
                  'start_date' => $start_date,
                  'end_date' => $end_date,
                  'summary' => $this->getSummaryData($timbangans, $start_date, $end_date) // TAMBAH INI
            ];

            $pdf = Pdf::loadView('laporan.pdf', $data);
            return $pdf->download('laporan_timbangan_' . $fileName . '.pdf');
      }
}
