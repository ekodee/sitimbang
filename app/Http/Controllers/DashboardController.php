<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter tahun dari request
        $selectedYear = $request->input('year');

        // Ambil daftar tahun unik dari data timbangan untuk mengisi dropdown
        $availableYears = Timbangan::selectRaw('YEAR(waktu_masuk) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // =================================================================
        // 1. Kueri yang TIDAK TERPENGARUH Filter
        // =================================================================
        $totalTruk = Truk::count();
        $totalSupir = Supir::count();

        // Data hari ini dan kemarin TIDAK TERPENGARUH filter tahun
        $timbanganHariIni = Timbangan::whereDate('waktu_masuk', Carbon::today())->get();
        $totalHariIni = $timbanganHariIni->count();
        $totalBeratHariIni = $timbanganHariIni->sum('berat_sampah');

        $timbanganKemarin = Timbangan::whereDate('waktu_masuk', Carbon::yesterday())->get();
        $totalKemarin = $timbanganKemarin->count();
        $totalBeratKemarin = $timbanganKemarin->sum('berat_sampah');

        $persenJumlah = $totalKemarin > 0 ? round((($totalHariIni - $totalKemarin) / $totalKemarin) * 100, 2) : 0;
        $persenBerat = $totalBeratKemarin > 0 ? round((($totalBeratHariIni - $totalBeratKemarin) / $totalBeratKemarin) * 100, 2) : 0;

        // Timbangan terbaru TIDAK TERPENGARUH filter tahun (selalu tampilkan 5 terbaru)
        $timbanganTerbaru = Timbangan::with(['truks', 'supirs'])
            ->latest('waktu_masuk')
            ->take(5)
            ->get();

        // =================================================================
        // 2. Kueri yang TERPENGARUH Filter Tahun
        // =================================================================
        $timbanganQuery = Timbangan::query();
        $beratPerKecamatanQuery = Timbangan::join('supirs', 'timbangans.supir_id', '=', 'supirs.supir_id')
            ->join('kecamatans', 'supirs.kecamatan_id', '=', 'kecamatans.kecamatan_id');

        // Terapkan filter TAHUN jika ada
        if ($selectedYear) {
            $timbanganQuery->whereYear('waktu_masuk', $selectedYear);
            $beratPerKecamatanQuery->whereYear('timbangans.waktu_masuk', $selectedYear);
        }

        // Eksekusi kueri yang sudah difilter
        $totalTimbangan = $timbanganQuery->count();
        $totalBeratSampah = $timbanganQuery->sum('berat_sampah');

        $beratPerKecamatan = $beratPerKecamatanQuery
            ->selectRaw('kecamatans.nama as nama_kecamatan, SUM(timbangans.berat_sampah) as total_berat')
            ->groupBy('kecamatans.nama')
            ->get();

        // Persiapan data chart
        $chartData = $beratPerKecamatan->map(function ($item) {
            return [
                'name' => $item->nama_kecamatan,
                'y' => (float) $item->total_berat,
                'drilldown' => $item->nama_kecamatan,
            ];
        });

        // Data Drilldown (TERPENGARUH filter tahun)
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
            $detailBulananQuery = Timbangan::join('supirs', 'timbangans.supir_id', '=', 'supirs.supir_id')
                ->join('kecamatans', 'supirs.kecamatan_id', '=', 'kecamatans.kecamatan_id')
                ->where('kecamatans.nama', $item->nama_kecamatan);

            // Terapkan filter TAHUN yang sama ke kueri drilldown
            if ($selectedYear) {
                $detailBulananQuery->whereYear('timbangans.waktu_masuk', $selectedYear);
            }

            $detailBulanan = $detailBulananQuery
                ->selectRaw('MONTH(timbangans.waktu_masuk) as bulan, SUM(timbangans.berat_sampah) as total_berat')
                ->groupBy('bulan')
                ->pluck('total_berat', 'bulan')
                ->toArray();

            $dataLengkap = [];
            foreach ($bulanList as $index => $namaBulan) {
                $nomorBulan = $index + 1;
                $dataLengkap[] = [$namaBulan, (float) ($detailBulanan[$nomorBulan] ?? 0)];
            }

            $drilldownSeries[] = [
                'name' => $item->nama_kecamatan,
                'id' => $item->nama_kecamatan,
                'data' => $dataLengkap,
            ];
        }

        // =================================================================
        // 3. Kirim data ke View
        // =================================================================
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
            'drilldownSeries',
            'availableYears',
            'selectedYear'
        ));
    }
}
