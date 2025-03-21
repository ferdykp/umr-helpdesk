@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="full-width w-md-a ">
                            <h4 class="">Edit Tracking Sparepart</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tracking.update', $trackings->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_sparepart" class="form-control-label">Nama Sparepart:</label>
                                <input type="text" class="form-control" id="nama_sparepart" name="nama_sparepart"
                                    value="{{ old('nama_sparepart', $trackings->nama_sparepart) }}" required>
                                @error('nama_sparepart')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_update" class="form-control-label">Tanggal Update:</label>
                                <input type="date" class="form-control" id="tanggal_update" name="tanggal_update"
                                    value="{{ old('tanggal_update', $trackings->tanggal_update) }}" required>
                                @error('tanggal_update')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jumlah_barang" class="form-control-label">Jumlah Barang:</label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                    value="{{ old('jumlah_barang', $trackings->jumlah_barang) }}" required>
                                @error('jumlah_barang')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="satuan" class="form-control-label">Satuan:</label>
                                <input type="text" class="form-control" id="satuan" name="satuan"
                                    value="{{ old('satuan', $trackings->satuan) }}" required>
                                @error('satuan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_barang" class="form-control-label">Kategori Barang:</label>
                                <input type="text" class="form-control" id="kategori_barang" name="kategori_barang"
                                    value="{{ old('kategori_barang', $trackings->kategori_barang) }}" required>
                                @error('kategori_barang')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-label">Status:</label>
                                <select id="status" class="form-control mb-3" name="status" required>
                                    <option value="" disabled hidden>--- Select shift ---</option>
                                    <option value="Dipesan" {{ $trackings->status == 'Dipesan' ? 'selected' : '' }}>Dipesan
                                    </option>
                                    <option value="Selesai Servis"
                                        {{ $trackings->status == 'Selsai Servis' ? 'selected' : '' }}>Selesai Servis
                                    </option>
                                    <option value="Servis" {{ $trackings->status == 'Servis' ? 'selected' : '' }}>Servis
                                    </option>
                                    <option value="Masuk Inventory"
                                        {{ $trackings->status == 'Masuk Inventory' ? 'selected' : '' }}>Masuk Inventory
                                    </option>
                                    <option value="Sudah Datang"
                                        {{ $trackings->status == 'Sudah Datang' ? 'selected' : '' }}>Sudah Datang
                                    </option>
                                </select>
                                @error('status')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vendor_teknisi" class="form-control-label">Vendor Teknisi:</label>
                                <input type="text" class="form-control" id="vendor_teknisi" name="vendor_teknisi"
                                    value="{{ old('vendor_teknisi', $trackings->vendor_teknisi) }}" required>
                                @error('vendor_teknisi')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan" class="form-control-label">Catatan:</label>
                                <input type="text" class="form-control" id="catatan" name="catatan"
                                    value="{{ old('catatan', $trackings->catatan) }}" required>
                                @error('catatan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Update Tracking Sparepart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
