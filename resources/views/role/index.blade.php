@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Manajemen Role</h3>
            @can('role-create')
                <a href="{{ route('role.create') }}" class="btn btn-success">Tambah Data</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-sm" id="table">
                <thead>
                    <tr>
                        <th width="100px">No</th>
                        <th>Nama Role</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('role-edit')
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn text-warning"><i
                                            class="ti ti-edit"></i></a>
                                @endcan
                                @can('role-delete')
                                    <button type="button" data-confirm-delete="true" class="btn text-danger"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $role->id }}">
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

    @foreach ($roles as $role)
        <div class="modal fade" id="confirmDeleteModal{{ $role->id }}" tabindex="-1"
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
                        <form action="{{ route('role.destroy', $role->id) }}" method="POST">
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
