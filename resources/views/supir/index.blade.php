@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Master Data Supir</h2>
                @can('supir-create')
                    <a href="{{ route('supir.create') }}" class="btn btn-success" role="button">Tambah Data</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Wilayah Kerja</th>
                                <th>Nomor HP</th>
                                <th>Nomor Plat</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supirs as $index => $supir)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supir->nama }}</td>
                                    <td>{{ $supir->kecamatan?->nama }}</td>
                                    <td>{{ $supir->no_hp }}</td>
                                    <td>{{ $supir->truks?->no_polisi ?? 'No polisi belum di set' }}
                                    </td>
                                    <td>
                                        @can('supir-edit')
                                            <a href="{{ route('supir.edit', $supir->supir_id) }}" class="btn text-warning"><i
                                                    class="ti ti-edit"></i></a>
                                        @endcan
                                        @can('supir-delete')
                                            <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $supir->supir_id }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @foreach ($supirs as $supir)
        <div class="modal fade" id="confirmDeleteModal{{ $supir->supir_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <form action="{{ route('supir.destroy', $supir->supir_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
