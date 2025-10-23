@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Form Edit Data Timbangan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('timbangan.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Kolom 1 --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="plat_nomer">Plat Nomer Truk</label>
                            <input type="text"
                                class="form-control @error('plat_nomer')
                                is-invalid
                            @enderror"
                                name="plat_nomer" id="plat_nomer" value="{{ $timbangan->plat_nomer }}">
                            @error('plat_nomer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_supir">Nama Supir</label>
                            <input type="text"
                                class="form-control @error('nama_supir')
                                is-invalid
                            @enderror"
                                name="nama_supir" id="nama_supir" value="{{ $timbangan->nama_supir }}">
                            @error('nama_supir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="datetime"
                                class="form-control @error('jam_masuk')
                                'is-invalid'
                            @enderror"
                                name="jam_masuk" id="jam_masuk" value="{{ $timbangan->created_at->format('H:i') }}"
                                readonly>
                            @error('jam_masuk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text"
                                class="form-control @error('tanggal')
                                is-invalid
                            @enderror"
                                name="tanggal" id="tanggal" value="{{ $timbangan->created_at->format('Y-m-d') }}"
                                readonly>
                            @error('tanggal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom 2 --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="berat_total">Berat Total</label>
                            <input type="number" name="berat_total" id="berat_total"
                                class="form-control @error('berat_total')
                                is-invalid
                            @enderror"
                                value="{{ $timbangan->berat_total }}">
                            @error('berat_total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_truk">Berat Truk</label>
                            <input type="number" name="berat_truk" id="berat_truk"
                                class="form-control @error('berat_truk')
                                is-invalid
                            @enderror"
                                value="{{ $timbangan->berat_truk }}">
                            @error('berat_truk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_sampah">Berat Sampah</label>
                            <input type="number" name="berat_sampah" id="berat_sampah"
                                class="form-control @error('berat_sampah')
                                'is-invalid'
                            @enderror"
                                readonly value="{{ $timbangan->berat_sampah }}">
                            @error('berat_sampah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas"
                                class="form-control @error('nama_petugas')
                                'is-invalid'
                            @enderror"
                                value="{{ Auth::user()->name }}">
                            @error('nama_petugas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('timbangan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- funtion untuk perhitungan otomatis --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const beratTotalInput = document.getElementById('berat_total');
        const beratTrukInput = document.getElementById('berat_truk');
        const beratSampahInput = document.getElementById('berat_sampah');

        function hitungBeratSampah() {
            const total = parseFloat(beratTotalInput.value) || 0;
            const truk = parseFloat(beratTrukInput.value) || 0;
            const sampah = total - truk;

            beratSampahInput.value = sampah;
        }

        beratTotalInput.addEventListener('input', hitungBeratSampah);
        beratTrukInput.addEventListener('input', hitungBeratSampah);
    });
</script>
