@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Data User</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        {{-- Nama Lengkap --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $user->name) }}" required autofocus
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username', $user->username) }}" required placeholder="Masukkan username">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- NIK/NIP --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="nik">NIK/NIP</label>
                            <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                name="nik" value="{{ old('nik', $user->nik) }}" placeholder="Masukkan NIK/NIP">
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="jabatan">Jabatan</label>
                            <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" value="{{ old('jabatan', $user->jabatan) }}" placeholder="Masukkan Jabatan">
                            @error('jabatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- Email --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $user->email) }}" required
                                placeholder="Masukkan email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password Baru</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="role">Role</label>
                            <select class="form-select myselect" id="role" name="roles[]">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ collect(old('roles', $user->roles->pluck('name')))->contains($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
