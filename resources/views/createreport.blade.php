@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="row">
            <div class="card">
                <div class="card-header mt-2">
                    <div class="w-100 w-md-auto ">
                        <h4 class="">Buat Laporan Kerusakan</h4>
                        <hr class="bg-danger border-2 border-top border-danger" />
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="nama_teknisi" class="col-md-4 col-form-label text-md-right">Nama Teknisi</label>

                            <div class="col-md-6">
                                <input id="nama_teknisi" type="text"
                                    class="form-control @error('nama_teknisi') is-invalid @enderror" name="nama_teknisi"
                                    value="{{ old('nama_teknisi') }}" required autocomplete="nama_teknisi" autofocus>

                                @error('nama_teknisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Keterangan
                                Kerusakan</label>

                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('keterangan_kerusakan') is-invalid @enderror"
                                    name="keterangan_kerusakan" value="{{ old('keterangan_kerusakan') }}" required
                                    autocomplete="keterangan_kerusakan" autofocus>
                                @error('keterangan_kerusakan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penyebab_kerusakan" class="col-md-4 col-form-label text-md-right">Penyebab
                                Kerusakan</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('penyebab_kerusakan') is-invalid @enderror"
                                    name="penyebab_kerusakan" value="{{ old('penyebab_kerusakan') }}" required
                                    autocomplete="penyebab_kerusakan" autofocus>
                                @error('penyebab_kerusakan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_kerusakan" class="col-md-4 col-form-label text-md-right">Tanggal
                                Kerusakan</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('tanggal_kerusakan') is-invalid @enderror"
                                    name="tanggal_kerusakan" value="{{ old('tanggal_kerusakan') }}" required
                                    autocomplete="tanggal_kerusakan" autofocus>
                                @error('tanggal_kerusakan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shift" class="col-md-4 col-form-label text-md-right">Shift</label>
                            <div class="col-md-6">
                                <select class="form-control @error('shift') is-invalid @enderror" name="shift"
                                    value="{{ old('shift') }}" required autocomplete="shift" autofocus>
                                    <option value="" disabled selected hidden>--- Pilih Shift ---</option>
                                    Process ---
                                    </option>
                                    <option value="SHIFT 1">SHIFT 1</option>
                                    <option value="SHIFT 2">SHIFT 2</option>
                                    <option value="SHIFT BU">SHIFT BU</option>
                                    <option value="Long Shift">Long Shift</option>
                                </select>
                                @error('shift')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi_mesin" class="col-md-4 col-form-label text-md-right">Lokasi Mesin</label>
                            <div class="col-md-6">
                                <select class="form-control @error('lokasi_mesin') is-invalid @enderror"
                                    name="lokasi_mesin" value="{{ old('lokasi_mesin') }}" required
                                    autocomplete="lokasi_mesin" autofocus>
                                    <option value="" disabled selected hidden>--- Pilih Lokasi Mesin ---</option>
                                    <option value="280">280</option>
                                    <option value="410">410</option>
                                    <option value="INDIGO">INDIGO</option>
                                </select>
                                @error('lokasi_mesin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori_mesin" class="col-md-4 col-form-label text-md-right">Kategori
                                Mesin</label>
                            <div class="col-md-6">
                                <select class="form-control @error('kategori_mesin') is-invalid @enderror"
                                    name="kategori_mesin" value="{{ old('kategori_mesin') }}" required
                                    autocomplete="kategori_mesin" autofocus>
                                    <option value="" disabled selected hidden>--- Pilih Kategori Mesin ---</option>
                                    <option value="Gallus 1" data-color="red">Gallus 1</option>
                                    <option value="Gallus 2" data-color="yellow">Gallus 2</option>
                                    <option value="Gallus 3" data-color="green">Gallus 3</option>
                                    <option value="Gallus 4" data-color="red">Gallus 4</option>
                                    <option value="Gallus 5" data-color="yellow">Gallus 5</option>
                                    <option value="Gallus 6" data-color="green">Gallus 6</option>
                                    <option value="Gallus 7" data-color="yellow">Gallus 7</option>
                                    <option value="Gallus 8" data-color="green">Gallus 8</option>
                                    <option value="Gallus 9" data-color="yellow">Gallus 9</option>
                                    <option value="Gallus 10" data-color="green">Gallus 10</option>
                                    <option value="Gallus 11" data-color="yellow">Gallus 11</option>
                                    <option value="Rhyguan Sliting" data-color="green">Rhyguan Sliting</option>
                                    <option value="Rhyguan 2" data-color="green">Rhyguan 2</option>
                                    <option value="Nilpeter 1" data-color="green">Nilpeter 1</option>
                                    <option value="Nilpeter 2" data-color="green">Nilpeter 2</option>
                                    <option value="ROTO 5" data-color="green">ROTO 5</option>
                                    <option value="Digital" data-color="green">Digital</option>
                                    <option value="All" data-color="green">All</option>

                                    {{--@foreach ($kmesin as $kmesin)--}}
                                    {{-- <option value="{{ $kmesin->kmesin }}">{{ $kmesin->kmesin }}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                                @error('kategori_mesin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">Foto Kerusakan</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto_kerusakan" value="{{ old('foto') }}" required autocomplete="foto"
                                    autofocus>
                                @error('foto')
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
                                        <option value="Belum Mulai" data-color="red">Belum Mulai</option>
                                        <option value="Dalam Proses" data-color="yellow">Dalam Proses</option>
                                        <option value="Selesai" data-color="green">Selesai</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
