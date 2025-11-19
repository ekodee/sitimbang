@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Form Edit Data Truk</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('truk.update', $truk->truk_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="no_polisi">No Polisi</label>
                            <input type="text" name="no_polisi" id="no_polisi"
                                class="form-control @error('no_polisi') is-invalid @enderror" placeholder="AB XXXX ABC"
                                value="{{ old('no_polisi', $truk->no_polisi) }}">
                            @error('no_polisi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_truk">Jenis Truk</label>
                            <select name="jenis_truk" id="jenis_truk"
                                class="form-select myselect @error('jenis_truk') is-invalid @enderror">
                                <option disabled selected>Pilih Jenis Truk</option>
                                <option value="Dump Truck" {{ old('jenis_truk') == 'Dump Truck' ? 'selected' : '' }}>Dump
                                    Truck</option>
                                <option value="Compactor" {{ old('jenis_truk') == 'Compactor' ? 'selected' : '' }}>Compactor
                                </option>
                                <option value="Arm Roll" {{ old('jenis_truk') == 'Arm Roll' ? 'selected' : '' }}>Arm Roll
                                </option>
                                <option value="Bak Terbuka" {{ old('jenis_truk') == 'Bak Terbuka' ? 'selected' : '' }}>Bak
                                    Terbuka</option>
                            </select>
                            @error('jenis_truk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="berat_truk">Berat Truk (Kg)</label>
                            <input type="number" name="berat_truk" id="berat_truk"
                                class="form-control @error('berat_truk') is-invalid @enderror" placeholder="10000"
                                value="{{ old('berat_truk', $truk->berat_truk) }}">
                            @error('berat_truk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('truk.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success" type="submit">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
