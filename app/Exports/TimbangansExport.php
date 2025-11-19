<?php

namespace App\Exports;

use App\Models\Timbangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TimbangansExport implements FromView, WithStyles, ShouldAutoSize
{
    protected $timbangans;
    protected $start_date;
    protected $end_date;
    protected $truk_id;
    protected $summary;

    public function __construct($start_date = null, $end_date = null, $truk_id = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->truk_id = $truk_id;

        $query = Timbangan::with(['truks', 'supirs']);

        // Filter tanggal
        if ($start_date && $end_date) {
            $query->whereBetween('waktu_masuk', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59'
            ]);
        } elseif ($start_date) {
            $query->whereDate('waktu_masuk', '>=', $start_date);
        } elseif ($end_date) {
            $query->whereDate('waktu_masuk', '<=', $end_date);
        }

        // Filter truk
        if ($truk_id) {
            $query->where('truk_id', $truk_id);
        }

        $this->timbangans = $query->latest()->get();
        $this->summary = $this->getSummaryData($this->timbangans, $start_date, $end_date);
    }

    protected function getSummaryData($timbangans, $start_date = null, $end_date = null)
    {
        if ($timbangans->count() === 0) {
            return [
                'total_transaksi' => 0,
                'total_berat_sampah' => 0,
                'rata_rata_berat' => 0,
                'berat_tertinggi' => 0,
                'berat_terendah' => 0,
                'periode' => $this->getPeriodeText($start_date, $end_date),
                'tanggal_dibuat' => now('Asia/Jakarta')->format('d-m-Y H:i:s'),
            ];
        }

        return [
            'total_transaksi' => $timbangans->count(),
            'total_berat_sampah' => $timbangans->sum('berat_sampah'),
            'rata_rata_berat' => $timbangans->avg('berat_sampah'),
            'berat_tertinggi' => $timbangans->max('berat_sampah'),
            'berat_terendah' => $timbangans->min('berat_sampah'),
            'periode' => $this->getPeriodeText($start_date, $end_date),
            'tanggal_dibuat' => now('Asia/Jakarta')->format('d-m-Y H:i:s'),
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

    public function view(): View
    {
        return view('laporan.excel', [
            'timbangans' => $this->timbangans,
            'summary' => $this->summary
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Header laporan (3 baris pertama)
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        $sheet->mergeCells('A3:H3');
        $sheet->getStyle('A1:H3')->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'font' => ['bold' => true, 'size' => 14],
        ]);

        // Header tabel (dikenali dari baris 13)
        $headerRow = 13;
        $sheet->getStyle("A{$headerRow}:I{$headerRow}")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);

        // Border hanya untuk data tabel
        $dataStart = $headerRow + 1;
        $dataEnd = $dataStart + count($this->timbangans);
        if ($this->timbangans->count() > 0) {
            $sheet->getStyle("A{$dataStart}:I{$dataEnd}")->applyFromArray([
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
            ]);
        }

        return [];
    }
}
