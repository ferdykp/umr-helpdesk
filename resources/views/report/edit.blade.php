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
                    <form action="{{ route('report.update', $laporan->id) }}" method="POST"
                        enctype="multipart/form-data">
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
                                onchange="previewImage(event)">
                            @error('foto')
                            <span style="color: red;">{{ $message }}</span>
                            @enderror

                            <div class="mt-3">
                                <label>Preview Foto:</label>
                                <br>
                                <img id="preview"
                                    src="{{ $laporan->foto ? asset('storage/' . $laporan->foto) : 'https://via.placeholder.com/150' }}"
                                    alt="Preview Foto" class="img-thumbnail" width="200">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shift" class="form-control-label">Shift</label>
                            <div class="col-md-12">
                                <select class="form-control @error('shift') is-invalid @enderror" name="shift"
                                    value="{{ old('shift') }}" id="shift-select" required autocomplete="shift"
                                    autofocus>
                                </select>
                                @error('shift')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
                            <label for="lokasi_mesin" class="form-control-label">Lokasi Mesin</label>
                            <div class="col-md-12">
                                <select class="form-control @error('lokasi_mesin') is-invalid @enderror"
                                    name="lokasi_mesin" id="location-select" value="{{ old('lokasi_mesin') }}" required
                                    autocomplete="lokasi_mesin" autofocus>
                                </select>
                                @error('lokasi_mesin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kategori_mesin" class="form-control-label">Kategori Mesin:</label>
                            <div class="col-md-12">
                                <select class="form-control @error('kategori_mesin') is-invalid @enderror"
                                    name="kategori_mesin" id="machine-select"
                                    value="{{ old('kategori_mesin', $laporan->kategori_mesin) }}" required
                                    autocomplete="kategori_mesin" autofocus>
                                </select>
                                @error('kategori_mesin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
                        <button type="submit" class="mt-3 btn btn-primary">Update Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection

@push('customScript')
<script>
$('#machine-select').select2({
    theme: "bootstrap-5",
    placeholder: '~~~ Pilih Mesin ~~~',
    ajax: {
        url: '{{ route('data.machines') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                term: params.term // Meneruskan term pencarian
            };
        },
        processResults: function(data) {
            return {
                results: data // Mengembalikan hasil
            };
        }
    }
});

$('#location-select').select2({
    theme: "bootstrap-5",
    placeholder: '~~~ Pilih Lokasi ~~~',
    ajax: {
        url: '{{ route('data.locations') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                term: params.term // Meneruskan term pencarian
            };
        },
        processResults: function(data) {
            return {
                results: data // Mengembalikan hasil
            };
        }
    }
});

$('#shift-select').select2({
    theme: "bootstrap-5",
    placeholder: '~~~ Pilih Shift ~~~',
    ajax: {
        url: '{{ route('data.shifts') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                term: params.term // Meneruskan term pencarian
            };
        },
        processResults: function(data) {
            return {
                results: data // Mengembalikan hasil
            };
        }
    }
});

$(document).ready(function() {
    const currentShift = "{{ $laporan->shift }}";

    if (currentShift) {
        // Create a new option element for the current shift
        var newOption = new Option(currentShift, currentShift, true, true);

        // Append it to the select element
        $('#shift-select').append(newOption).trigger('change');
    }

    // Initialize machine select with current value
    const currentMachine = "{{ $laporan->kategori_mesin }}";
    if (currentMachine) {
        var machineOption = new Option(currentMachine, currentMachine, true, true);
        $('#machine-select').append(machineOption).trigger('change');
    }

    // Initialize location select with current value
    const currentLocation = "{{ $laporan->lokasi_mesin }}";
    if (currentLocation) {
        var locationOption = new Option(currentLocation, currentLocation, true, true);
        $('#location-select').append(locationOption).trigger('change');
    }
});

$('#machine-select').data('url', '{{ route('data.machines') }}');
$('#location-select').data('url', '{{ route('data.locations') }}');
$('#shift-select').data('url', '{{ route('data.shifts') }}');
</script>
@endpush
