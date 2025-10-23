<?php

namespace App\Http\Controllers;

use App\Models\Truk;
use Illuminate\Http\Request;

class TrukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $truks = Truk::latest()->get();
        return  view('truk.index', compact('truks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('truk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_polisi' => 'required|string|max:20|unique:truks,no_polisi',
            'jenis_truk' => 'required|string|max:50',
            'berat_truk' => 'required|numeric|gt:0|max:99999999',
        ], [
            'no_polisi.required'  => 'Nomor polisi wajib diisi.',
            'no_polisi.unique'    => 'Nomor polisi ini sudah terdaftar.',
            'no_polisi.max'       => 'Nomor polisi tidak boleh lebih dari 20 karakter.',
            'jenis_truk.required' => 'Jenis truk harus dipilih.',
            'berat_truk.required' => 'Berat truk wajib diisi.',
            'berat_truk.numeric'  => 'Berat truk harus berupa angka.',
            'berat_truk.max'      => 'Berat truk melebihi kapasitas sistem (maksimal 99.999.999,99).',
        ]);

        $trimmedNoPolisi = str_replace(' ', '', $request->no_polisi);

        Truk::create([
            'no_polisi' => $trimmedNoPolisi,
            'jenis_truk' => $request->jenis_truk,
            'berat_truk' => $request->berat_truk,
        ]);

        toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('truk.index');
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
        $truk = Truk::findOrFail($id);
        return view('truk.edit', compact('truk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Truk $truk)
    {
        $request->validate([
            'no_polisi' => 'required|string|max:20',
            'jenis_truk' => 'required|string|max:50',
            'berat_truk' => 'required|numeric|gt:0|max:99999999',
        ], [
            'no_polisi.required'  => 'Nomor polisi wajib diisi.',
            'no_polisi.max'       => 'Nomor polisi tidak boleh lebih dari 20 karakter.',
            'jenis_truk.required' => 'Jenis truk harus dipilih.',
            'berat_truk.required' => 'Berat truk wajib diisi.',
            'berat_truk.numeric'  => 'Berat truk harus berupa angka.',
        ]);

        $trimmedNoPolisi = str_replace(' ', '', $request->no_polisi);

        $truk->update([
            'no_polisi' => $trimmedNoPolisi,
            'jenis_truk' => $request->jenis_truk,
            'berat_truk' => $request->berat_truk,
        ]);

        toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('truk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truk = Truk::findOrFail($id);
        $truk->delete();

        toast('Data berhasil dihapus!', 'success');
        return redirect()->route('truk.index');
    }
}
