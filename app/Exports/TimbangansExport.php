<?php

namespace App\Exports;

use App\Models\Timbangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// styling
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TimbangansExport implements FromView, WithStyles, ShouldAutoSize
{
    protected $timbangans;
    protected $start_date;
    protected $end_date;
    protected $truk_id;

    public function __construct($start_date = null, $end_date = null, $truk_id = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->truk_id = $truk_id;

        // --- PINDAHKAN LOGIKA QUERY KE SINI ---
        $query = Timbangan::with(['truks', 'supirs']);

        // Filter Tanggal
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date . ' 23:59:59']);
        } elseif ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        } elseif ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        // Filter Plat Nomor
        if ($truk_id) {
            $query->where('truk_id', $truk_id);
        }

        $this->timbangans = $query->latest()->get();
    }

    public function view(): View
    {
        return view('laporan.excel', [
            'timbangans' => $this->timbangans,
            'start_date' => $this->start_date,
            'end_date'  => $this->end_date,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        $sheet->mergeCells('A3:H3');
        $sheet->getStyle('A1:H3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:H3')->getFont()->setBold(true);

        $sheet->getStyle('A4:H4')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFFF00',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        ]);

        $lastRow = count($this->timbangans) + 4;

        $cellRange = 'A1:H' . $lastRow;

        return [
            $cellRange => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}
