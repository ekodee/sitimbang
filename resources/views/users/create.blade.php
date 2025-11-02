@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data User</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="row">
                    {{-- Kolom 1 --}}
                    <div class="col-md-6">
                        {{-- Nama Lengkap --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
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
                                value="{{ old('username') }}" required autocomplete="username" autofocus
                                placeholder="Masukkan username">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- NIK/NIP --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="nik">NIK/NIP</label>
                            <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                name="nik" value="{{ old('nik') }}" autocomplete="nik" autofocus
                                placeholder="Masukkan NIK/NIP">
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="nik">Jabatan</label>
                            <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" value="{{ old('jabatan') }}" autocomplete="jabatan" autofocus
                                placeholder="Masukkan Jabatan">
                            @error('jabatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom 2 --}}
                    <div class="col-md-6">
                        {{-- Email --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Email Address">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password" value="{{ old('password') }}">
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
                                        {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
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
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
