<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 25px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
        }

        .header-subtitle {
            font-size: 14px;
            font-weight: bold;
        }

        .header-date {
            font-size: 12px;
            margin-top: 4px;
        }

        /* RINGKASAN FORMAT TEKS BIASA */
        .summary {
            margin: 20px 0 30px 0;
            font-size: 12px;
            line-height: 1.6;
        }

        .summary-item {
            margin-bottom: 3px;
        }

        .summary-label {
            font-weight: bold;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 5px 7px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(7) {
            text-align: right;
        }

        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <div class="header-title">Laporan Timbangan</div>
        <div class="header-subtitle">Dinas Lingkungan Hidup Kota Tangerang</div>
        <div class="header-date">Periode: {{ $summary['periode'] }}</div>
    </div>

    <!-- RINGKASAN DALAM FORMAT TEKS -->
    <div class="summary">
        <div class="summary-item">
            <span class="summary-label">Total Transaksi :</span>
            {{ number_format($summary['total_transaksi']) }} kali
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Berat Sampah :</span>
            {{ number_format($summary['total_berat_sampah'], 2, ',', '.') }} kg
            ({{ number_format($summary['total_berat_sampah_ton'], 2, ',', '.') }} ton)
        </div>
        <div class="summary-item">
            <span class="summary-label">Rata-rata Berat :</span>
            {{ number_format($summary['rata_rata_berat'], 2, ',', '.') }} kg/transaksi
        </div>
        <div class="summary-item">
            <span class="summary-label">Rentang Berat :</span>
            {{ number_format($summary['berat_terendah'], 2, ',', '.') }} -
            {{ number_format($summary['berat_tertinggi'], 2, ',', '.') }} kg
        </div>
        @if (isset($summary['truk_terbanyak']) && $summary['truk_terbanyak'])
            <div class="summary-item">
                <span class="summary-label">Truk Terbanyak :</span>
                {{ $summary['truk_terbanyak']['nama'] }}
                ({{ number_format($summary['truk_terbanyak']['total_berat'], 2, ',', '.') }} kg)
            </div>
        @endif
        <div class="summary-item">
            <span class="summary-label">Jumlah Truk :</span>
            {{ number_format($summary['jumlah_truk']) }} unit
        </div>
        <div class="summary-item">
            <span class="summary-label">Laporan Dibuat :</span>
            {{ $summary['tanggal_dibuat'] }}
        </div>
    </div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
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
</body>

</html>
