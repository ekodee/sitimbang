@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Form Edit Data Timbangan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('timbangan.update', $timbangan->timbangan_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Kolom 1 --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="no_polisi">Plat Nomer Truk</label>
                            <select class="form-select myselect" id="no_polisiForm" name="no_polisi" required>
                                <option value="">-- Pilih Plat Nomer --</option>
                                @foreach ($truks as $truk)
                                    <option value="{{ $truk->truk_id }}"
                                        {{ old('no_polisi', $timbangan->truk_id) == $truk->truk_id ? 'selected' : '' }}>
                                        {{ $truk->no_polisi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('no_polisi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_supir">Nama Supir</label>
                            <select class="form-select" id="nama_supirForm" name="nama_supir">
                                <option value="{{ old('nama_supir', $timbangan->nama_supir) }}">
                                </option>
                            </select>
                            @error('nama_supir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" id="jam_masuk"
                                value="{{ old('jam_masuk', now('Asia/Jakarta')->format('H:i')) }}" readonly>
                            @error('jam_masuk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="time" class="form-control" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', now('Asia/Jakarta')->format('Y-m-d')) }}" readonly>
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
                                value="{{ old('berat_total', $timbangan->berat_total) }}"">
                            @error('berat_total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_truk">Berat Truk</label>
                            <input type="number" name="berat_truk" id="berat_trukForm"
                                class="form-control @error('berat_truk') is-invalid @enderror"
                                value="{{ old('berat_truk', $timbangan->berat_truk) }}">
                            @error('berat_truk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_sampah">Berat Sampah</label>
                            <input type="number" name="berat_sampah" id="berat_sampah" class="form-control"
                                value="{{ old('berat_sampah', $timbangan->berat_sampah) }}" readonly>
                            @error('berat_sampah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas" class="form-control"
                                value="{{ old('nama_petugas', Auth::user()->name) }}">
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
