@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="full-width w-md-a ">
                            <h4 class="">Edit Laporan Kerusakan</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('report.update', $laporan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="keterangan_kerusakan" class="form-control-label">Keterangan Kerusakan:</label>
                                <input type="description" class="form-control" id="keterangan_kerusakan"
                                    name="keterangan_kerusakan"
                                    value="{{ old('keterangan_kerusakan', $laporan->keterangan_kerusakan) }}" required>
                                @error('keterangan_kerusakan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="penyebab_kerusakan" class="form-control-label">Penyebab Kerusakan:</label>
                                <input type="text" class="form-control" id="penyebab_kerusakan" name="penyebab_kerusakan"
                                    value="{{ old('penyebab_kerusakan', $laporan->penyebab_kerusakan) }}" required>
                                @error('penyebab_kerusakan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_kerusakan" class="form-control-label">Tanggal Kerusakan:</label>
                                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan"
                                    value="{{ old('tanggal_kerusakan', $laporan->tanggal_kerusakan) }}" required>
                                @error('tanggal_kerusakan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="foto" class="form-control-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    value="{{ old('foto', $laporan->foto) }}" required>
                                @error('foto')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shift" class="form-control-label">Shift:</label>
                                <select id="shift" class="form-control mb-3" name="shift" required>
                                    <option value="" disabled hidden>--- Select shift ---</option>
                                    <option value="SHIFT 1" {{ $laporan->shift == 'SHIFT 1' ? 'selected' : '' }}>Shift 1
                                    </option>
                                    <option value="SHIFT 2" {{ $laporan->shift == 'SHIFT 2' ? 'selected' : '' }}>Shift 2
                                    </option>
                                    <option value="SHIFT BU" {{ $laporan->shift == 'SHIFT BU' ? 'selected' : '' }}>Shift BU
                                    </option>
                                    <option value="Long Shift" {{ $laporan->shift == 'Long shift' ? 'selected' : '' }}>Long
                                        Shift
                                    </option>
                                </select>
                                @error('shift')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_teknisi" class="form-control-label">Nama Teknisi:</label>
                                <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi"
                                    value="{{ old('nama_teknisi', $laporan->nama_teknisi) }}" required>
                                @error('nama_teknisi')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_mesin" class="form-control-label">Lokasi Mesin:</label>
                                <select id="lokasi_mesin" class="form-control mb-3" name="lokasi_mesin" required>
                                    <option value="" disabled hidden>--- Pilih Lokasi Mesin ---</option>
                                    <option value="280" {{ $laporan->shift == '280' ? 'selected' : '' }}>280</option>
                                    <option value="410" {{ $laporan->shift == '410' ? 'selected' : '' }}>410</option>
                                    <option value="INDIGO" {{ $laporan->shift == 'INDIGO' ? 'selected' : '' }}>INDIGO
                                    </option>

                                </select>
                                @error('lokasi_mesin')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_mesin" class="form-control-label">Kategori Mesin:</label>
                                <select id="kategori_mesin" class="form-control mb-3" name="kategori_mesin" required>
                                    <option value="" disabled selected hidden>--- Pilih Kategori Mesin ---</option>
                                    <option value="Gallus 1" data-color="red"
                                        {{ $laporan->kategori_mesin == 'Gallus 1' ? 'selected' : '' }}>Gallus 1</option>
                                    <option value="Gallus 2" data-color="yellow"
                                        {{ $laporan->kategori_mesin == 'Gallus 2' ? 'selected' : '' }}>Gallus 2</option>
                                    <option value="Gallus 3" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Gallus 3' ? 'selected' : '' }}>Gallus 3</option>
                                    <option value="Gallus 4" data-color="red"
                                        {{ $laporan->kategori_mesin == 'Gallus 4' ? 'selected' : '' }}>Gallus 4</option>
                                    <option value="Gallus 5" data-color="yellow"
                                        {{ $laporan->kategori_mesin == 'Gallus 5' ? 'selected' : '' }}>Gallus 5</option>
                                    <option value="Gallus 6" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Gallus 6' ? 'selected' : '' }}>Gallus 6</option>
                                    <option value="Gallus 7" data-color="yellow"
                                        {{ $laporan->kategori_mesin == 'Gallus 7' ? 'selected' : '' }}>Gallus 7</option>
                                    <option value="Gallus 8" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Gallus 8' ? 'selected' : '' }}>Gallus 8</option>
                                    <option value="Gallus 9" data-color="yellow"
                                        {{ $laporan->kategori_mesin == 'Gallus 9' ? 'selected' : '' }}>Gallus 9</option>
                                    <option value="Gallus 10" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Gallus 10' ? 'selected' : '' }}>Gallus 10</option>
                                    <option value="Gallus 11" data-color="yellow"
                                        {{ $laporan->kategori_mesin == 'Gallus 11' ? 'selected' : '' }}>Gallus 11</option>
                                    <option value="Rhyguan Sliting" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Rhyguan Sliting' ? 'selected' : '' }}>Rhyguan
                                        Sliting</option>
                                    <option value="Rhyguan 2" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Rhyguan 2' ? 'selected' : '' }}>Rhyguan 2</option>
                                    <option value="Nilpeter 1" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Nilpeter 1' ? 'selected' : '' }}>Nilpeter 1
                                    </option>
                                    <option value="Nilpeter 2" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Nilpeter 2' ? 'selected' : '' }}>Nilpeter 2
                                    </option>
                                    <option value="ROTO 5" data-color="green"
                                        {{ $laporan->kategori_mesin == 'ROTO 5' ? 'selected' : '' }}>ROTO 5</option>
                                    <option value="Digital" data-color="green"
                                        {{ $laporan->kategori_mesin == 'Digital' ? 'selected' : '' }}>Digital</option>
                                    <option value="All" data-color="green"
                                        {{ $laporan->kategori_mesin == 'All' ? 'selected' : '' }}>All</option>
                                </select>
                                @error('lokasi_mesin')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_perbaikan" class="form-control-label">Tanggal Perbaikan:</label>
                                <input type="date" class="form-control" id="tanggal_perbaikan"
                                    name="tanggal_perbaikan"
                                    value="{{ old('tanggal_perbaikan', $laporan->tanggal_perbaikan) }}" required>
                                @error('tanggal_perbaikan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-label">Status:</label>
                                <select id="status" class="form-control mb-3" name="status" required>
                                    <option value="" disabled hidden>--- Pilih Status ---</option>
                                    <option value="Belum Mulai" data-color="red"
                                        {{ $laporan->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                                    <option value="Dalam Proses" data-color="yellow"
                                        {{ $laporan->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="Selesai" data-color="green"
                                        {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="metode_perbaikan" class="form-control-label">Metode Perbaikan:</label>
                                <input type="text" class="form-control" id="metode_perbaikan" name="metode_perbaikan"
                                    value="{{ old('metode_perbaikan', $laporan->metode_perbaikan) }}" required>
                                @error('metode_perbaikan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan" class="form-control-label">Catatan:</label>
                                <input type="description" class="form-control" id="catatan" name="catatan"
                                    value="{{ old('catatan', $laporan->catatan) }}" required>
                                @error('catatan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
