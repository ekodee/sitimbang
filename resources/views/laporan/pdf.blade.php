<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 6px 8px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Header (kop surat) tanpa border dan tanpa background */
    .header-table th {
        border: none !important;
        background: none !important;
        text-align: center;
        padding: 3px 0;
    }

    .header-title {
        font-size: 25px;
        font-weight: bold;
    }

    .header-subtitle {
        font-size: 16px;
        font-weight: bold;
    }

    .header-date {
        font-size: 14px;
        font-weight: normal;
    }

    td:first-child {
        width: 90px;
    }

    td:nth-child(5),
    td:nth-child(6),
    td:nth-child(7) {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    tbody tr:nth-child(even) {
        background-color: #fafafa;
    }
</style>

<table>
    <thead>
        <tr class="header-table">
            <th colspan="8" class="header-title">Laporan Timbangan</th>
        </tr>
        <tr class="header-table pt-1">
            <th colspan="8" class="header-title">Dinas Lingkungan Hidup Kota Tangerang</th>
        </tr>
        <tr class="header-table pt-1">
            <th class="header-title" colspan="8">Tanggal :
                @if (isset($start_date) && $start_date && isset($end_date) && $end_date)
                    {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d
                    {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}
                @elseif(isset($start_date) && $start_date)
                    Mulai {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }}
                @elseif(isset($end_date) && $end_date)
                    Sampai {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}
                @else
                    Semua Tanggal
                @endif
            </th>
        </tr>
        <br>
        <tr>
            <th width='20'>Tanggal</th>
            <th width='30'>Nama Supir</th>
            <th width='10'>No. Polisi</th>
            <th width='10'>Jenis Truk</th>
            <th width='15'>Berat Truk (Kg)</th>
            <th width='15'>Berat Total (Kg)</th>
            <th width='20'>Berat Sampah (Kg)</th>
            <th width='20'>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($timbangans as $timbangan)
            <tr>
                <td>{{ $timbangan->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $timbangan->supirs?->nama }}</td>
                <td>{{ $timbangan->truks->no_polisi }}</td>
                <td>{{ $timbangan->truks->jenis_truk }}</td>
                <td>{{ $timbangan->truks->berat_truk }}</td>
                <td>{{ $timbangan->berat_total }}</td>
                <td>{{ $timbangan->berat_sampah }}</td>
                <td>{{ $timbangan->nama_petugas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
