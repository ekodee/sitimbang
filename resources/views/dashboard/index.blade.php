@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Dashboard</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Truk</h5>
                                        <p class="card-text">{{ $totalTruk }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Supir</h5>
                                        <p class="card-text">{{ $totalSupir }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Freakuensi Penimbangan</h5>
                                        <p class="card-text">{{ $totalTimbangan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Berat Sampah (kg)</h5>
                                        <p class="card-text">{{ $totalBeratSampah }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Plat Nomor</th>
                                <th scope="col">Nama Petugas</th>
                                <th scope="col">Berat Total (kg)</th>
                                <th scope="col">Berat Truk (kg)</th>
                                <th scope="col">Berat Sampah (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timbanganTerbaru as $timbangan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td sty>{{ $timbangan->created_at->format('d M Y') }}</td>
                                    <td>{{ $timbangan->created_at->format('H:i') }}</td>
                                    <td>{{ $timbangan->truks->no_polisi }}</td>
                                    <td>{{ $timbangan->nama_petugas }}</td>
                                    <td>{{ number_format($timbangan->berat_total, 2, ',', '.') }}</td>
                                    <td>{{ number_format($timbangan->berat_truk, 2, ',', '.') }}</td>
                                    <td>{{ number_format($timbangan->berat_sampah, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
