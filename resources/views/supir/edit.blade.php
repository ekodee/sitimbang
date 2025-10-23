@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    Form Edit Data Supir
                </h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('supir.update', $supir->supir_id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama') is-invalid
                                @enderror"
                                    id="nama" name="nama" placeholder="John Doe" autofocus
                                    value="{{ $supir->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_hp" class="form-label">Nomor Handphone</label>
                                <input type="tel" class="form-control @error('no_ktp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" placeholder="0857XXXXXXXX" value="{{ $supir->no_hp }}">
                                @error('no_ktp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_ktp" class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                    id="no_ktp" name="no_ktp" placeholder="3276XXXXXXXXXXXX"
                                    value="{{ $supir->no_ktp }}">
                                @error('no_ktp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_polisi" class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control @error('no_polisi') is-invalid @enderror"
                                    id="no_polisi" name="no_polisi" placeholder="3276XXXXXXXXXXXX"
                                    value="{{ $supir->truks->no_polisi }}">
                                @error('no_polisi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <a class="btn btn-secondary" href=" {{ route('supir.index') }}" role="button">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
