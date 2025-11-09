<table>
    <thead>
        <tr>
            <th colspan="8">Laporan Timbangan</th>
        </tr>
        <tr>
            <th colspan="8">Dinas Lingkungan Hidup Kota Tangerang</th>
        </tr>
        <tr>
            <th colspan="8">Tanggal :
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
        <tr>
            <th width='20'>Tanggal</th>
            <th width='30'>Nama Supir</th>
            <th width='10'>No. Polisi</th>
            <th width='10'>Jenis Truk</th>
            <th width='15'>Berat Total (Kg)</th>
            <th width='15'>Berat Truk (Kg)</th>
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
                <td>{{ number_format($timbangan->berat_total, 2, ',', '.') }}</td>
                <td>{{ number_format($timbangan->truks->berat_truk, 2, ',', '.') }}</td>
                <td>{{ number_format($timbangan->berat_sampah, 2, ',', '.') }}</td>
                <td>{{ $timbangan->nama_petugas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
