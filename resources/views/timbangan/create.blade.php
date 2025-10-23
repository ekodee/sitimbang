@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Form Tambah Data Timbangan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('timbangan.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Kolom 1 --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="no_polisi">Plat Nomer Truk</label>
                            <select class="form-select myselect" id="no_polisiForm" name="no_polisi">
                                <option value="">-- Pilih Plat Nomer --</option>
                                @foreach ($truks as $truk)
                                    <option value="{{ $truk->truk_id }}">{{ $truk->no_polisi }}</option>
                                @endforeach
                            </select>
                            @error('no_polisi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_supir">Nama Supir</label>
                            <select class="form-select" id="nama_supirForm" name="nama_supir">
                                <option value="">-- Pilih Plat Nomor Terlebih Dahulu --</option>
                            </select>
                            @error('nama_supir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="datetime" class="form-control" name="jam_masuk" id="jam_masuk"
                                value="{{ now('Asia/Jakarta')->format('H:i') }}" readonly>
                            @error('jam_masuk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" id="tanggal"
                                value="{{ now('Asia/Jakarta')->format('Y-m-d') }}" readonly>
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
                            @enderror">
                            @error('berat_total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_truk">Berat Truk</label>
                            <input type="number" name="berat_truk" id="berat_trukForm"
                                class="form-control @error('berat_truk') is-invalid @enderror">
                            @error('berat_truk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="berat_sampah">Berat Sampah</label>
                            <input type="number" name="berat_sampah" id="berat_sampah" class="form-control" readonly>
                            @error('berat_sampah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas" class="form-control"
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const beratTotalInput = document.getElementById('berat_total');
        const beratTrukInput = document.getElementById('berat_trukForm');
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
