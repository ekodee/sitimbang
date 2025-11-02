<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'persenBerat'
        ));
    }
}
