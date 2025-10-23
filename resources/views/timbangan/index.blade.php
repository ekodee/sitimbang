@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Data Volume Sampah</h2>
            <a href="{{ route('timbangan.create') }}" class="btn btn-primary" type="button">Tambah Data</a>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Plat Nomor</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Berat Total</th>
                        <th scope="col">Berat Truk</th>
                        <th scope="col">Volume Sampah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($timbangans as $index => $timbangan)
                        <tr>
                            <th scope="row">{{ $no }}</th>
                            <td sty>{{ $timbangan->created_at->format('d M Y') }}</td>
                            <td>{{ $timbangan->created_at->format('H:i') }}</td>
                            <td>{{ $timbangan->truks->no_polisi }}</td>
                            <td>{{ $timbangan->nama_petugas }}</td>
                            <td>{{ number_format($timbangan->berat_total, 2, ',', '.') }}</td>
                            <td>{{ number_format($timbangan->berat_truk, 2, ',', '.') }}</td>
                            <td>{{ number_format($timbangan->berat_sampah, 2, ',', '.') }}</td>
                            <td class="text-nowrap">
                                <button type="button" class="btn text-primary" data-bs-toggle="modal"
                                    data-bs-target="#showDetailModal{{ $timbangan->timbangan_id }}">
                                    <i class="ti ti-eye"></i>
                                </button>
                                {{-- <a href="{{ route('timbangan.edit', $timbangan->timbangan_id) }}"
                                    class="btn text-warning"><i class="ti ti-edit"></i></a> --}}
                                <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $timbangan->timbangan_id }}">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($timbangans as $timbangan)
        {{-- Modal Konfirmasi Hapus --}}
        <div class="modal fade" id="confirmDeleteModal{{ $timbangan->timbangan_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="confirmDeleteModal">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('timbangan.destroy', $timbangan->timbangan_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Detail Timbangan --}}
        <div class="modal fade" id="showDetailModal{{ $timbangan->timbangan_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="exampleModalLabel">Detail Timbangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped-columns table-success">
                            <tr>
                                <th scope="row">Status</th>
                                <td>{{ $timbangan->status }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal</th>
                                <td>{{ $timbangan->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jam</th>
                                <td>{{ $timbangan->created_at->format('H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Plat Nomor</th>
                                <td>{{ $timbangan->truks->no_polisi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Supir</th>
                                <td>{{ $timbangan->supirs?->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Berat Total</th>
                                <td>{{ $timbangan->berat_total }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Berat Truk</th>
                                <td>{{ $timbangan->berat_truk }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Berat Sampah</th>
                                <td>{{ $timbangan->berat_sampah }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Petugas</th>
                                <td>{{ $timbangan->nama_petugas }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
