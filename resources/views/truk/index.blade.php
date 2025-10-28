@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title">Master Data Truk</h2>
                @can('truk-create')
                    <a href="{{ route('truk.create') }}" class="btn btn-success" role="button">Tambah Data</a>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nomor Polisi</th>
                            <th scope="col">Jenis Truk</th>
                            <th scope="col">Berat Truk</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($truks as $index => $truk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $truk->no_polisi }}</td>
                                <td>{{ $truk->jenis_truk }}</td>
                                <td>{{ $truk->berat_truk }}</td>
                                <td>
                                    @can('truk-edit')
                                        <a href="{{ route('truk.edit', $truk->truk_id) }}" class="btn text-warning"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('truk-delete')
                                        <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal{{ $truk->truk_id }}">
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

    {{-- Modal confirm delete --}}
    @foreach ($truks as $truk)
        <div class="modal fade" id="confirmDeleteModal{{ $truk->truk_id }}" tabindex="-1"
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
                        <form action="{{ route('truk.destroy', $truk->truk_id) }}" method="POST">
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
