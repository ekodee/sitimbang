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
                                        <h5 class="card-title">Total Frekuensi Timbangan</h5>
                                        <p class="card-text">{{ $totalSupir }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Berat Sampah   </h5>
                                        <p class="card-text">{{ $totalSupir }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <h3>Timbangan Hari Ini</h3>
                            {{-- Frekuensi Timbangan Hari Ini --}}
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Frekuensi Timbangan</h5>
                                        <p class="card-text">{{ $timbanganHariIni->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Berat Sampah Hari Ini --}}
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Berat Sampah</h5>
                                        <p class="card-text">{{ $timbanganHariIni->sum('berat_sampah') }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Rata-rata Berat Sampah Hari Ini --}}
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Rata-rata Sampah</h5>
                                        <p class="card-text">{{ $timbanganHariIni->average('berat_sampah') }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Persen Berat Sampah Hari Ini --}}
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Persentasi Hari ini dan kemarin</h5>
                                        <p class="card-text">{{ $persenBerat }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
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
    </div>
@endsection
