@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manajemen User dan Role</h3>
            <a href="{{ route('user.create') }}" class="btn btn-success">Tambah Data</a>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role?->role_name }}</td>
                            <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#roleModal{{ $user->id }}">
                                    Role
                                </button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Manajemen Role --}}
    @foreach ($users as $user)
        <div class="modal fade" id="roleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Manajemen Role</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update-role') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="">
                                <label for="role_id">Tentukan Role Akses</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success">
                                    Ganti Role
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
