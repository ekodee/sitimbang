<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Supir</th>
            <th>No. Polisi</th>
            <th>Jenis Truk</th>
            <th>Berat Truk (Kg)</th>
            <th>Berat Total (Kg)</th>
            <th>Berat Sampah (Kg)</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($timbangans as $timbangan)
            <tr>
                <td>{{ $timbangan->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $timbangan->supirs->nama }}</td>
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
