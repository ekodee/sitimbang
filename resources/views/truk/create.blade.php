@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Form Tambah Data Truk</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('truk.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_polisi">No Polisi</label>
                                <input type="text" name="no_polisi" id="no_polisi"
                                    class="form-control @error('no_polisi') is-invalid
                                @enderror"
                                    autofocus placeholder="AB XXXX ABC" value="{{ old('no_polisi') }}">
                                @error('no_polisi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="jenis_truk">Jenis Truk</label>
                                <select name="jenis_truk" id="jenis_truk"
                                    class="myselect form-select @error('jenis_truk')
                                    is-invalid
                                @enderror">
                                    <option disabled selected>Pilih Jenis Truk</option>
                                    <option value="Heavy" {{ old('jenis_truk') == 'Heavy' ? 'selected' : '' }}>Heavy
                                    </option>
                                    <option value="Medium" {{ old('jenis_truk') == 'Medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="Light" {{ old('jenis_truk') == 'Light' ? 'selected' : '' }}>Light
                                    </option>
                                </select>
                                @error('no_polisi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="berat_truk">Berat Truk</label>
                                <input type="number" name="berat_truk" id="berat_truk" placeholder="10000"
                                    class="form-control @error('berat_truk')
                                        is-invalid
                                    @enderror"
                                    value="{{ old('berat_truk') }}">
                                @error('berat_truk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('truk.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
