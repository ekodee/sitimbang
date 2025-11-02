@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Data Role</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('role.update', $role->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="form-label" for="nama_role">Nama Role</label>
                    <input id="nama_role" type="text" class="form-control @error('nama_role') is-invalid @enderror"
                        name="nama_role" value="{{ $role->name }}" required autocomplete="nama_role" autofocus
                        placeholder="Masukan nama role">
                    @error('nama_role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    @php
                        $groupedPermissions = collect($permissions)->groupBy(function ($perm) {
                            return explode('-', $perm->name)[0];
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
                                                    value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                    id="perm_{{ $permission->id }}">
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
                <div class="text-end">
                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
