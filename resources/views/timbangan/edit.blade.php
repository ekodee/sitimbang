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
                                <option value="">-- Pilih Plat Nomor Terlebih Dahulu --</option>
                            </select>
                            @error('nama_supir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" id="jam_masuk"
                                value="{{ old('jam_masuk', $timbangan->created_at->format('H:i')) }}" readonly>
                            @error('jam_masuk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', $timbangan->created_at->format('Y-m-d')) }}" readonly>
                            @error('tanggal')
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

                    {{-- Kolom 2 --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="berat_total">Berat Total</label>
                            <input type="number" name="berat_total" id="berat_total"
                                class="form-control @error('berat_total') is-invalid @enderror"
                                value="{{ old('berat_total', $timbangan->berat_total) }}">
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

                        <div class="form-group mb-3">
                            <label for="status">Ubah Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option disabled>Pilih Status</option>
                                <option value="Pending"
                                    {{ old('status', $timbangan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Selesai"
                                    {{ old('status', $timbangan->status) == 'verified' ? 'selesai' : '' }}>Selesai
                                </option>
                                <option value="Dibatalkan"
                                    {{ old('status', $timbangan->status) == 'ditolak' ? 'dibatalkan' : '' }}>Dibatalkan
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-end pt-4">
                            <a href="{{ route('timbangan.index') }}" class="btn btn-secondary">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const oldNoPolisi = "{{ old('no_polisi', $timbangan->truk_id) }}";
            const oldNamaSupir = "{{ old('nama_supir', $timbangan->supir_id ?? '') }}";

            // Fungsi reusable untuk load data truk & supir
            function loadTrukData(truk_id, selectedSupir = null) {
                if (!truk_id) return;

                const url1 = '{{ route('getWeight', ':id') }}'.replace(':id', truk_id);
                const url2 = '{{ route('getDriver', ':id') }}'.replace(':id', truk_id);

                // Ambil berat truk
                $.ajax({
                    url: url1,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            $('#berat_trukForm').val(response.berat_truk);
                        }
                    }
                });

                // Ambil data supir
                $.ajax({
                    url: url2,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            $('#nama_supirForm').empty().append(
                                '<option value="">Pilih Supir</option>');
                            $.each(response, function(_, supir) {
                                const selected = (supir.supir_id == selectedSupir) ?
                                    'selected' : '';
                                $('#nama_supirForm').append(
                                    `<option value="${supir.supir_id}" ${selected}>${supir.nama}</option>`
                                );
                            });
                        }
                    }
                });
            }

            // Jalankan saat halaman dimuat
            if (oldNoPolisi) {
                loadTrukData(oldNoPolisi, oldNamaSupir);
            }

            // Jalankan ulang saat user memilih plat truk
            $('#no_polisiForm').on('change', function() {
                const truk_id = $(this).val();
                loadTrukData(truk_id);
            });
        });
    </script>
@endpush

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
