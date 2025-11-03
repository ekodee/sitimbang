@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Laporan</h2>
            <form action="{{ route('laporan.filter') }}" method="GET">
                <div class="row pb-3 align-items-end">
                    {{-- <div class="col-md-2">
                        <label for="">Tanggal mulai : </label>
                        <input type="date" class="form-control filter-input" id="start_date" name="start_date"
                            value="{{ $start_date ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <label for="">Tanggal akhir : </label>
                        <input type="date" class="form-control filter-input" id="end_date" name="end_date"
                            value="{{ $end_date ?? '' }}">
                    </div> --}}

                    <div class="col-md-4">
                        <label for="daterange_display">Rentang Tanggal:</label>
                        <input type="text" id="daterange_display" class="form-control" value="" autocomplete="off"
                            placeholder="Pilih rentang tanggal">
                    </div>
                    <input type="hidden" class="filter-input" id="start_date" name="start_date"
                        value="{{ $start_date ?? '' }}">
                    <input type="hidden" class="filter-input" id="end_date" name="end_date" value="{{ $end_date ?? '' }}">

                    <div class="col-md-3">
                        <label for="">No polisi :</label>
                        <select class="form-control myselect filter-input" id="truk_id_select" name="truk_id">
                            <option value="">Semua Plat Nomor</option>
                            @foreach ($truks as $truk)
                                <option value="{{ $truk->truk_id }}"
                                    {{ isset($truk_id) && $truk_id == $truk->truk_id ? 'selected' : '' }}>
                                    {{ $truk->no_polisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>

                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>

                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-success" id="export-excel-link"
                                        href="{{ route('laporan.excel') }}">Excel</a></li>
                                <li><a class="dropdown-item text-danger" id="export-pdf-link"
                                        href="{{ route('laporan.pdf') }}">PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
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
                                <td>{{ $loop->iteration }}</td>
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- import library --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    {{-- jquery --}}
    <script>
        $(document).ready(function() {

            var initialStartDate = $('#start_date').val();
            var initialEndDate = $('#end_date').val();
            var daterangeInput = $('#daterange_display');

            daterangeInput.daterangepicker({
                opens: 'left',
                startDate: initialStartDate ? moment(initialStartDate, 'YYYY-MM-DD') : moment(),
                endDate: initialEndDate ? moment(initialEndDate, 'YYYY-MM-DD') : moment(),
                locale: {
                    format: 'DD-MM-YYYY',
                    separator: ' s/d ',
                    applyLabel: 'Terapkan',
                    cancelLabel: 'Batal / Bersihkan',
                    fromLabel: 'Dari',
                    toLabel: 'Ke',
                },
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                showDropdowns: true,
                minYear: 2020,
                maxYear: moment().year()
            });

            if (initialStartDate && initialEndDate) {
                daterangeInput.val(moment(initialStartDate, 'YYYY-MM-DD').format('DD-MM-YYYY') + ' s/d ' +
                    moment(initialEndDate, 'YYYY-MM-DD').format('DD-MM-YYYY'));
            } else {
                daterangeInput.val('');
            }

            daterangeInput.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format(
                    'DD-MM-YYYY'));

                $('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
                $('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
                $('#start_date').trigger('change');
            });

            daterangeInput.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#start_date').val('');
                $('#end_date').val('');

                $('#start_date').trigger('change');
            });

            function updateExportLink() {
                var excelBaseUrl = "{{ route('laporan.excel') }}";
                var pdfBaseUrl = "{{ route('laporan.pdf') }}";
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var trukId = $('#truk_id_select').val();

                console.log('Export Params:', {
                    start_date: startDate,
                    end_date: endDate,
                    truk_id: trukId
                });

                var queryParams = $.param({
                    start_date: startDate,
                    end_date: endDate,
                    truk_id: trukId
                });

                $('#export-excel-link').attr('href', excelBaseUrl + (queryParams ? '?' + queryParams : ''));
                $('#export-pdf-link').attr('href', pdfBaseUrl + (queryParams ? '?' + queryParams : ''));
            }

            updateExportLink();

            $('.filter-input').on('change', updateExportLink);
        });
    </script>
@endpush
