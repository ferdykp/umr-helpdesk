@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="row">
            <div class="card">
                <div class="card-header mt-2">
                    <div class="w-100 w-md-auto ">
                        <h4 class="">Buat Laporan Spareport</h4>
                        <hr class="bg-danger border-2 border-top border-danger" />
                    </div>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sparepart.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="nama_sparepart" class="col-md-4 col-form-label text-md-right">Nama
                                Sparepart</label>

                            <div class="col-md-6">
                                <input id="nama_sparepart" type="text"
                                    class="form-control @error('nama_sparepart') is-invalid @enderror"
                                    name="nama_sparepart" value="{{ old('nama_sparepart') }}" required
                                    autocomplete="nama_sparepart" autofocus>

                                @error('nama_sparepart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori
                            </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                    name="kategori" value="{{ old('kategori') }}" required autocomplete="kategori"
                                    autofocus>
                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stok" class="col-md-4 col-form-label text-md-right">
                                Stock</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" value="{{ old('stok') }}" required autocomplete="stok" autofocus>
                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="update_stok" class="col-md-4 col-form-label text-md-right">
                                Update Stock</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('update_stok') is-invalid @enderror"
                                    name="update_stok" value="{{ old('update_stok') }}" required
                                    autocomplete="update_stok" autofocus>
                                @error('update_stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="lokasi_penyimpanan" class="col-md-4 col-form-label text-md-right">
                                Lokasi Penyimpanan</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('lokasi_penyimpanan') is-invalid @enderror"
                                    name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}" required
                                    autocomplete="lokasi_penyimpanan" autofocus>
                                @error('lokasi_penyimpanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                            <div class="col-md-6">
                                <div class="status-container">
                                    <select class="form-control @error('status') is-invalid @enderror status-dropdown"
                                        name="status" required autocomplete="status" autofocus id="status">
                                        <option value="" disabled selected hidden>--- Pilih Status ---</option>
                                        <option value="Tidak Tersedia" data-color="red">Tidak Tersedia</option>
                                        <option value="Tersedia" data-color="green">Tersedia</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="catatan" class="col-md-4 col-form-label text-md-right">Catatan</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('catatan') is-invalid @enderror"
                                    name="catatan" value="{{ old('catatan') }}" required autocomplete="catatan"
                                    autofocus>
                                @error('catatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection