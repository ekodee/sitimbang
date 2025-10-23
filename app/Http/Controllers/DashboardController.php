<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTruk = Truk::count();
        $totalSupir = Supir::count();
        $totalTimbangan = Timbangan::count();

        $totalBeratSampah = Timbangan::sum('berat_sampah');

        $timbanganTerbaru = Timbangan::with(['truks', 'supirs'])
            ->take(5)
            ->latest()
            ->get();
        // dd($timbanganTerbaru)->toArray();

        return view('dashboard.index', compact(
            'totalTruk',
            'totalSupir',
            'totalTimbangan',
            'totalBeratSampah',
            'timbanganTerbaru'
        ));
    }
}
