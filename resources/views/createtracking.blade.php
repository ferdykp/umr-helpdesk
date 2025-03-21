@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="w-100 w-md-auto ">
                            <h4 class="">Buat Trakcing Spareport</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tracking.store') }}" enctype="multipart/form-data">
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
                                <label for="tanggal_update" class="col-md-4 col-form-label text-md-right">Tanggal Update
                                </label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('tanggal_update') is-invalid @enderror"
                                        name="tanggal_update" value="{{ old('tanggal_update') }}" required
                                        autocomplete="kategori" autofocus>
                                    @error('tanggal_update')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah_barang" class="col-md-4 col-form-label text-md-right">
                                    Jumlah Barang</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror"
                                        name="jumlah_barang" value="{{ old('jumlah_barang') }}" required autocomplete="stok"
                                        autofocus>
                                    @error('jumlah_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="satuan" class="col-md-4 col-form-label text-md-right">
                                    Satuan</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                        name="satuan" value="{{ old('satuan') }}" required autocomplete="satuan" autofocus>
                                    @error('satuan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kategori_barang" class="col-md-4 col-form-label text-md-right">
                                    Kategori Barang</label>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('kategori_barang') is-invalid @enderror"
                                        name="kategori_barang" value="{{ old('kategori_barang') }}" required
                                        autocomplete="kategori_barang" autofocus>
                                    @error('kategori_barang')
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
                                            <option value="dipesan" data-color="yellow">
                                                Dipesan
                                            </option>
                                            <option value="selesai_servis" data-color="lightgreen">
                                                Selesai Servis
                                            </option>
                                            <option value="servis" data-color="red">Servis</option>
                                            <option value="masuk_inventory" data-color="green">Masuk Inventory</option>
                                            <option value="sudah_datang" data-color="blue">Sudah Datang</option>
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
                                <label for="vendor_teknisi" class="col-md-4 col-form-label text-md-right">Vendor
                                    Teknisi</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('vendor_teknisi') is-invalid @enderror"
                                        name="vendor_teknisi" value="{{ old('vendor_teknisi') }}" required
                                        autocomplete="vendor_teknisi" autofocus>
                                    @error('vendor_teknisi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="pic" class="col-md-4 col-form-label text-md-right">PIC</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('pic') is-invalid @enderror"
                                        name="pic" value="{{ old('pic') }}" required autocomplete="pic"
                                        autofocus>
                                    @error('pic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
