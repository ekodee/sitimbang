<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timbangans = Timbangan::with(['truks', 'supirs'])->get();
        return view('timbangan.index', compact('timbangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $truks = Truk::with('supirs')->get();
        return view('timbangan.create', compact('truks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_polisi'    => 'required|integer|exists:truks,truk_id',
            'nama_supir'   => 'nullable|integer|exists:supirs,supir_id',
            'berat_total'  => 'required|numeric|gt:0|max:99999999.99', // batas 8 digit sebelum koma
            'berat_truk'   => 'required|numeric|gt:0|max:99999999.99',
            'berat_sampah' => 'required|numeric|gt:0|max:99999999.99',
            'nama_petugas' => 'required|string|max:100',
        ], [
            'no_polisi.required'   => 'Nomor polisi wajib diisi.',
            'no_polisi.exists'     => 'Truk yang dipilih tidak ditemukan.',
            'nama_supir.exists'    => 'Supir yang dipilih tidak valid.',
            'berat_total.required' => 'Berat total wajib diisi.',
            'berat_total.max'      => 'Nilai berat total terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_truk.max'       => 'Nilai berat truk terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_sampah.max'     => 'Nilai berat sampah terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_sampah.max'     => 'Nilai berat sampah terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_sampah.gt'     => 'Berat sampah tidak boleh negatif.',
            'berat_truk.gt'     => 'Berat truk tidak boleh negatif.',
            'berat_total.gt'     => 'Berat total tidak boleh negatif.',
            'nama_petugas.required' => 'Nama petugas wajib diisi.',
        ]);

        Timbangan::create([
            "truk_id" => $request->no_polisi,
            "supir_id" => $request->nama_supir,
            "status" => 'pending',
            "berat_total" => $request->berat_total,
            "berat_truk" => $request->berat_truk,
            "berat_sampah" => $request->berat_sampah,
            "nama_petugas" => $request->nama_petugas,
        ]);

        toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('timbangan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timbangan = Timbangan::findOrFail($id);
        return view('timbangan.edit', compact('timbangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_polisi'    => 'required|integer|exists:truks,truk_id',
            'nama_supir'   => 'nullable|integer|exists:supirs,supir_id',
            'berat_total'  => 'required|numeric|gt:0|max:99999999.99',
            'berat_truk'   => 'required|numeric|gt:0|max:99999999.99',
            'berat_sampah' => 'required|numeric|gt:0|max:99999999.99',
            'nama_petugas' => 'required|string|max:100',
            'status'       => 'required|string|in:pending,selesai,dibatalkan',
        ], [
            'no_polisi.required'   => 'Nomor polisi wajib diisi.',
            'no_polisi.exists'     => 'Truk yang dipilih tidak ditemukan.',
            'nama_supir.exists'    => 'Supir yang dipilih tidak valid.',
            'berat_total.required' => 'Berat total wajib diisi.',
            'berat_total.max'      => 'Nilai berat total terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_truk.max'       => 'Nilai berat truk terlalu besar (maksimal 99.999.999,99 kg).',
            'berat_sampah.max'     => 'Nilai berat sampah terlalu besar (maksimal 99.999.999,99 kg).',
            'nama_petugas.required' => 'Nama petugas wajib diisi.',
            'status.in'            => 'Status hanya boleh: pending, selesai, atau dibatalkan.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timbangan = Timbangan::findOrFail($id);
        $timbangan->delete($id);

        toast('Data berhasil dihapus!', 'success');
        return redirect()->route('timbangan.index');
    }

    public function getWeight($id = 0)
    {
        $data = Truk::where('truk_id', $id)->firstOrFail();
        return response()->json($data);
    }

    public function getDriver($id = 0)
    {
        $supir = Supir::where('truk_id', $id)->get();
        return response()->json($supir);
    }
}
