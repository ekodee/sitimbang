<table>
    <thead>
        <tr>
            <th colspan="8">LAPORAN TIMBANGAN</th>
        </tr>
        <tr>
            <th colspan="8">Dinas Lingkungan Hidup Kota Tangerang</th>
        </tr>
        <tr>
            <th colspan="8">Periode: {{ $summary['periode'] }}</th>
        </tr>

        <!-- jarak antar header & ringkasan -->
        <tr>
            <td colspan="8" style="height: 20px;"></td>
        </tr>

        <!-- ringkasan sederhana tanpa border -->
        <tr>
            <td colspan="8" style="font-weight: bold;">Ringkasan Informasi:</td>
        </tr>
        <tr>
            <td colspan="8">Total Frekuensi: {{ number_format($summary['total_transaksi']) }} kali</td>
        </tr>
        <tr>
            <td colspan="8">Total Berat Sampah: {{ number_format($summary['total_berat_sampah'], 2, ',', '.') }} kg
            </td>
        </tr>
        <tr>
            <td colspan="8">Rata-rata Berat: {{ number_format($summary['rata_rata_berat'], 2, ',', '.') }} kg</td>
        </tr>
        <tr>
            <td colspan="8">Berat Tertinggi: {{ number_format($summary['berat_tertinggi'], 2, ',', '.') }} kg</td>
        </tr>
        <tr>
            <td colspan="8">Berat Terendah: {{ number_format($summary['berat_terendah'], 2, ',', '.') }} kg</td>
        </tr>
        <tr>
            <td colspan="8">Laporan Dibuat: {{ $summary['tanggal_dibuat'] }}</td>
        </tr>

        <!-- jarak antar ringkasan & tabel -->
        <tr>
            <td colspan="8" style="height: 25px;"></td>
        </tr>

        <!-- header tabel -->
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Supir</th>
            <th>No. Polisi</th>
            <th>Jenis Truk</th>
            <th>Berat Total (Kg)</th>
            <th>Berat Truk (Kg)</th>
            <th>Berat Sampah (Kg)</th>
            <th>Petugas</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($timbangans as $timbangan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $timbangan->waktu_masuk->format('d-m-Y H:i') }}</td>
                <td>{{ $timbangan->supirs?->nama }}</td>
                <td>{{ $timbangan->truks->no_polisi }}</td>
                <td>{{ $timbangan->truks->jenis_truk }}</td>
                <td>{{ number_format($timbangan->berat_total, 2, ',', '.') }}</td>
                <td>{{ number_format($timbangan->truks->berat_truk, 2, ',', '.') }}</td>
                <td>{{ number_format($timbangan->berat_sampah, 2, ',', '.') }}</td>
                <td>{{ $timbangan->nama_petugas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
