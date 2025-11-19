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

                        {{-- FORM FILTER TAHUN --}}
                        <form action="{{ route('dashboard.index') }}" method="GET" id="filterForm" class="mb-3">
                            <div class="row align-items-end">
                                <div class="col-md-3">
                                    <label for="yearFilter" class="form-label"><b>Filter Data per Tahun</b></label>
                                    <select name="year" id="yearFilter" class="form-control">
                                        <option value="">Semua Tahun</option>
                                        @foreach ($availableYears as $year)
                                            <option value="{{ $year }}"
                                                {{ $year == $selectedYear ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Reset Filter</a>
                                </div>
                            </div>
                        </form>
                        <hr>

                        {{-- Baris 1 : informasi data master --}}
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
                                        <h5 class="card-title">Frekuensi Timbangan</h5>
                                        <p class="card-text">{{ $totalTimbangan }}</p>
                                        <small
                                            class="text-muted">{{ $selectedYear ? "Tahun $selectedYear" : 'Semua data' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Berat Sampah</h5>
                                        <p class="card-text">{{ number_format($totalBeratSampah, 2, ',', '.') }} Kg</p>
                                        <small
                                            class="text-muted">{{ $selectedYear ? "Tahun $selectedYear" : 'Semua data' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Analisis Harian --}}
                        <div class="row mt-4">
                            <h3>Analisis Timbangan Hari Ini dan Kemarin</h3>

                            {{-- Analisis Jumlah Timbangan --}}
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Analisis Jumlah Timbangan</h5>
                                        <p class="card-text mb-1">
                                            Hari ini: <strong>{{ $totalHariIni }}</strong> kali
                                        </p>
                                        <p class="card-text mb-1">
                                            Kemarin: <strong>{{ $totalKemarin }}</strong> kali
                                        </p>
                                        <p class="card-text">
                                            Perubahan:
                                            @if ($persenJumlah > 0)
                                                <span class="text-danger">+{{ $persenJumlah }}%</span> (meningkat)
                                            @elseif($persenJumlah < 0)
                                                <span class="text-success">{{ $persenJumlah }}%</span> (menurun)
                                            @else
                                                <span class="text-muted">Tidak ada perubahan</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Analisis Total Berat Sampah --}}
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h5 class="card-title text-success">Analisis Total Berat Sampah</h5>
                                        <p class="card-text mb-1">
                                            Hari ini: <strong>{{ number_format($totalBeratHariIni, 2, ',', '.') }}</strong>
                                            kg
                                        </p>
                                        <p class="card-text mb-1">
                                            Kemarin: <strong>{{ number_format($totalBeratKemarin, 2, ',', '.') }}</strong>
                                            kg
                                        </p>
                                        <p class="card-text">
                                            Perubahan:
                                            @if ($persenBerat > 0)
                                                <span class="text-danger">+{{ $persenBerat }}%</span> (meningkat)
                                            @elseif($persenBerat < 0)
                                                <span class="text-success">{{ $persenBerat }}%</span> (menurun)
                                            @else
                                                <span class="text-muted">Tidak ada perubahan</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Grafik --}}
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Grafik Total Berat Sampah per Kecamatan</h5>
                                <p class="fs-4">
                                    {{ $selectedYear ? "Data tahun $selectedYear" : 'Semua data historis' }}
                                </p>
                            </div>
                            <div class="card-body">
                                <div id="chartKecamatan" style="height: 450px;"></div>
                            </div>
                        </div>

                        {{-- Tabel Timbangan Terbaru --}}
                        <div class="table-responsive mt-4">
                            <h3>Data Timbangan Terbaru</h3>
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
                                            <td>{{ $timbangan->waktu_masuk->format('d M Y') }}</td>
                                            <td>{{ $timbangan->waktu_masuk->format('H:i') }}</td>
                                            <td>{{ $timbangan->truks->no_polisi ?? '-' }}</td>
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
    </div>
@endsection

@push('importJs')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
@endpush

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function numberWithDots(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return parts.join(",");
        }

        Highcharts.chart('chartKecamatan', {
            chart: {
                type: 'column',
                events: {
                    drilldown: function() {
                        var chart = this;
                        chart.setTitle(null, {
                            text: "Tren grafik perbulan"
                        });
                    },
                    drillup: function() {
                        var chart = this;
                        chart.setTitle(null, {
                            text: "Klik grafik untuk melihat tren per bulan"
                        });
                    }
                }
            },
            title: {
                text: `Total Berat Sampah per Kecamatan {{ $selectedYear }}`
            },
            subtitle: {
                text: 'Klik grafik untuk melihat tren per bulan'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Kecamatan'
                }
            },
            yAxis: {
                title: {
                    text: 'Total Berat Sampah (kg)'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return numberWithDots(this.y.toFixed(0)) + ' kg';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + numberWithDots(this.y.toFixed(0)) +
                        ' kg';
                }
            },
            series: [{
                name: "Kecamatan",
                colorByPoint: true,
                data: @json($chartData)
            }],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: @json($drilldownSeries)
            },
            credits: {
                enabled: false
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ['downloadPNG', 'downloadJPEG'],
                    },
                },
            }
        });
    });
</script>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#yearFilter').on('change', function() {
                $('#filterForm').submit();
            });
        });
    </script>
@endpush
