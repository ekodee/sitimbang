<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use App\Models\Truk;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:supir-list|supir-create|supir-edit|supir-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:supir-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:supir-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:supir-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supirs = Supir::with('truks')->get();
        return view('supir.index', compact('supirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $truks = Truk::get();
        return view('supir.create', compact('truks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->toArray());
        $request->validate([
            'nama'     => 'required|string|max:100',
            'no_hp'    => 'required|numeric|digits_between:10,15|unique:supirs,no_hp',
            'no_ktp'   => 'required|digits:16|unique:supirs,no_ktp',
            'truk_id'  => 'nullable|exists:truks,truk_id',
        ], [
            'nama.required'   => 'Nama supir wajib diisi.',
            'no_hp.required'  => 'Nomor HP wajib diisi.',
            'no_hp.numeric'   => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10–15 digit.',
            'no_hp.unique'    => 'Nomor HP sudah terdaftar.',
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.digits'   => 'Nomor KTP harus 16 digit.',
            'no_ktp.unique'   => 'Nomor KTP sudah terdaftar.',
            'truk_id.exists'  => 'Truk yang dipilih tidak valid.',
        ]);

        Supir::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'truk_id' => $request->no_polisi,
        ]);
        toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('supir.index');
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
        $supir = Supir::find($id);
        return view('supir.edit', compact('supir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supir $supir)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'no_hp'    => 'required|numeric|digits_between:10,15|unique:supirs,no_hp,' . $supir->supir_id . ',supir_id',
            'no_ktp'   => 'required|digits:16|unique:supirs,no_ktp,' . $supir->supir_id . ',supir_id',
            'truk_id'  => 'nullable|exists:truks,truk_id',
        ]);

        $supir->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
        ]);
        toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('supir.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supir = Supir::findOrFail($id);
        $supir->delete();

        toast('Data berhasil dihapus!', 'success');
        return redirect()->route('supir.index')->with('success', 'Data supir berhasil dihapus');
    }
}
