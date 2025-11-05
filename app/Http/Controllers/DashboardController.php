<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTruk = Truk::count();
        $totalSupir = Supir::count();
        $totalTimbangan = Timbangan::count();
        $totalBeratSampah = Timbangan::sum('berat_sampah');

        $timbanganHariIni = Timbangan::whereDate('created_at', Carbon::today())->get();
        $totalHariIni = $timbanganHariIni->count();
        $totalBeratHariIni = $timbanganHariIni->sum('berat_sampah');

        $timbanganKemarin = Timbangan::whereDate('created_at', Carbon::yesterday())->get();
        $totalKemarin = $timbanganKemarin->count();
        $totalBeratKemarin = $timbanganKemarin->sum('berat_sampah');

        $persenJumlah = $totalKemarin > 0
            ? round((($totalHariIni - $totalKemarin) / $totalKemarin) * 100, 2)
            : 0;

        $persenBerat = $totalBeratKemarin > 0
            ? round((($totalBeratHariIni - $totalBeratKemarin) / $totalBeratKemarin) * 100, 2)
            : 0;

        $timbanganTerbaru = Timbangan::with(['truks', 'supirs'])
            ->latest()
            ->take(5)
            ->get();

        $beratPerKecamatan = Timbangan::join('supirs', 'timbangans.supir_id', '=', 'supirs.supir_id')
            ->join('kecamatans', 'supirs.kecamatan_id', '=', 'kecamatans.kecamatan_id')
            ->selectRaw('kecamatans.nama as nama_kecamatan, SUM(timbangans.berat_sampah) as total_berat')
            ->groupBy('kecamatans.nama')
            ->get();


        $chartData = $beratPerKecamatan->map(function ($item) {
            return [
                'name' => $item->nama_kecamatan,
                'y' => (float) $item->total_berat,
                'drilldown' => $item->nama_kecamatan,
            ];
        });

        $drilldownSeries = [];

        $bulanList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        foreach ($beratPerKecamatan as $item) {
            // Ambil total berat sampah per bulan untuk kecamatan tertentu
            $detailBulanan = Timbangan::join('supirs', 'timbangans.supir_id', '=', 'supirs.supir_id')
                ->join('kecamatans', 'supirs.kecamatan_id', '=', 'kecamatans.kecamatan_id')
                ->where('kecamatans.nama', $item->nama_kecamatan)
                ->selectRaw('MONTH(timbangans.created_at) as bulan, SUM(timbangans.berat_sampah) as total_berat')
                ->groupBy('bulan')
                ->pluck('total_berat', 'bulan')
                ->toArray();

            $dataLengkap = [];
            foreach ($bulanList as $index => $namaBulan) {
                $nomorBulan = $index + 1;
                $dataLengkap[] = [$namaBulan, (float) ($detailBulanan[$nomorBulan] ?? 0)];
            }

            // Masukkan ke dalam drilldown series
            $drilldownSeries[] = [
                'name' => $item->nama_kecamatan,
                'id' => $item->nama_kecamatan,
                'data' => $dataLengkap,
            ];
        }

        return view('dashboard.index', compact(
            'totalTruk',
            'totalSupir',
            'totalTimbangan',
            'totalBeratSampah',
            'timbanganHariIni',
            'timbanganKemarin',
            'timbanganTerbaru',
            'totalHariIni',
            'totalKemarin',
            'totalBeratHariIni',
            'totalBeratKemarin',
            'persenJumlah',
            'persenBerat',
            'beratPerKecamatan',
            'chartData',
            'drilldownSeries'
        ));
    }
}
