@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Laporan</h2>
            <form action="{{ route('laporan.filter') }}" method="GET">
                <div class="row pb-3">
                    <div class="col-md-3">
                        <label for="">Start Date:</label>
                        <input type="date" class="form-control" name="start_date">
                    </div>
                    <div class="col-md-3">
                        <label for="">End Date:</label>
                        <input type="date" class="form-control" name="end_date">
                    </div>
                    <div class="col-md-1 pt-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-md-1 pt-4">
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                    <div class="col-md-1 pt-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-success" href="{{ route('laporan.excel') }}">Excel</a></li>
                                <li><a class="dropdown-item text-danger" href="#">PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Supir</th>
                        <th>Plat Nomor</th>
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
        </div>
    </div>
@endsection
