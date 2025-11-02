<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\TimbanganController;
use App\Http\Controllers\TrukController;
use App\Http\Controllers\UserController;
use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Transaksi;
use App\Models\Truk;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // operator
    Route::resource('timbangan', TimbanganController::class);
    Route::get('get/weight/{id}', [TimbanganController::class, 'getWeight'])->name('getWeight');
    Route::get('get/driver/{id}', [TimbanganController::class, 'getDriver'])->name('getDriver');

    // admin
    Route::resource('supir', SupirController::class);
    Route::resource('truk', TrukController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::get('laporan/excel', [LaporanController::class, 'excel'])->name('laporan.excel');
    Route::get('laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');

    // superadmin
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::post('user-update-role', [UserController::class, 'updateRole'])->name('users.update-role');
});


Route::get('test', function () {
    // $truks = DB::table('truks')->where('truk_id', 1)->firstOrFail();

    // $supirs = Supir::with('truks')->get();
    // $truks = Truk::with('supirs')->get();

    // $test = Supir::where('truk_id', 1)->get();

    // $beratSampah = DB::table('timbangans')->max('berat_sampah');
    // $timbangan = Timbangan::with('truks')->get();
    // $truks = DB::table('truks')->where('truk_id', 1)->with('supirs')->first();
    // dd($test->toArray());
});
