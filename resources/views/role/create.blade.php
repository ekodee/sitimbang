@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Role</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('role.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label" for="nama_role">Nama Role</label>
                    <input id="nama_role" type="text" class="form-control @error('nama_role') is-invalid @enderror"
                        name="nama_role" value="{{ old('nama_role') }}" required autocomplete="nama_role" autofocus
                        placeholder="Masukan nama role">
                    @error('nama_role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- <div class="form-group mb-3">
                    <h5 class="fw-bold mb-3">Permissions</h5>

                    <div class="form-check">
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <label><input type="checkbox" name="permissions[{{ $permission->name }}]"
                                        value="{{ $permission->name }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                </div> --}}
                <div class="row">
                    @php
                        // pastikan ambil nama permission-nya
                        $groupedPermissions = collect($permissions)->groupBy(function ($perm) {
                            return explode('-', $perm->name)[0]; // ambil prefix kategori dari nama permission
                        });
                    @endphp

                    <div class="row">
                        @foreach ($groupedPermissions as $category => $perms)
                            <div class="col-md-4 mb-3">
                                <div class="card border-light shadow-sm">
                                    <div class="card-header bg-light fw-bold text-capitalize">
                                        {{ $category }}
                                    </div>
                                    <div class="card-body p-2">
                                        @foreach ($perms as $permission)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox"
                                                    name="permissions[{{ $permission->name }}]"
                                                    value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                    {{ ucfirst(str_replace("$category-", '', $permission->name)) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Buat Role</button>
                </div>
            </form>
        </div>
    </div>
@endsection
