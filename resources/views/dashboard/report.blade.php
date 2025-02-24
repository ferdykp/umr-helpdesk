@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                        {{-- <form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                        <input type="hidden" name="_token" value="5ZuDDdIre04lGxByoxgyeuLplvtuuBo4bTj5qXf1" autocomplete="off">                            <div class="form-group me-md-2 w-100 w-md-25">
                            <label for="file">Upload WR File in Excel</label>
                            <input type="file" name="file" class="form-control" required="">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 mt-md-4">Import WR</button>
                    </form> --}}
                    </div>
                    <div
                        class="card-header pb-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <div class="d-flex flex-column flex-sm-row">
                                <a href="{{ route('report.create') }}" class="btn btn-md btn-success me-2 mb-2 mb-sm-0">Tambah
                                    Laporan</a>
                                <a href="{{ route('report.export') }}" class="btn btn-md btn-warning me-2 mb-2 mb-sm-0">
                                    <i class="fa fa-download"></i> Export Data in Excel
                                </a>
                                <button class="btn btn-danger me-2 mb-2 mb-sm-0 d-none" id="delete_selected">Delete
                                    Selected</button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <h6 class="mb-0">List Laporan Kerusakan</h6>
                        </div>
                        <div class="w-100 w-md-25"> <!-- Adjust the width as needed -->
                            <input type="text" id="search" data-route="" name="search" placeholder="Search WR Code"
                                autocomplete="off" class="form-control">
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive p-0 rounded-lg">
                            <table id="datatable" class="table align-items-center mb-0" data-type="report">
                                <thead class="table-light">
                                    <tr>
                                        <th style="white-space: nowrap;" class="text-center">No</th>
                                        <th style="white-space: nowrap;" class="text-center">Keterangan Kerusakan</th>
                                        <th style="white-space: nowrap;" class="text-center">Penyebab Kerusakan</th>
                                        <th style="white-space: nowrap;" class="text-center">Tanggal Kerusakan</th>
                                        <th style="white-space: nowrap;" class="text-center">Shift</th>
                                        <th style="white-space: nowrap;" class="text-center">Nama Teknisi</th>
                                        <th style="white-space: nowrap;" class="text-center">Lokasi Mesin</th>
                                        <th style="white-space: nowrap;" class="text-center">Kategori Mesin</th>
                                        <th style="white-space: nowrap;" class="text-center">Tanggal Perbaikan</th>
                                        <th style="white-space: nowrap;" class="text-center">Status</th>
                                        <th style="white-space: nowrap;" class="text-center">Metode Perbaikan</th>
                                        <th style="white-space: nowrap;" class="text-center">Catatan</th>
                                        <th style="white-space: nowrap;" class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <tr>
                                        @forelse ($laporan as $index => $item)
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $index + 1 + ($laporan->currentPage() - 1) * $laporan->perPage() }}
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->keterangan_kerusakan }}</td>
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->penyebab_kerusakan }}</td>
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->tanggal_kerusakan }}</td>
                                            <td style="white-space: nowrap;" class="text-center">{{ $item->shift }}</td>
                                            <td style="white-space: nowrap;" class="text-center">{{ $item->nama_teknisi }}
                                            </td>
                                            <td style="white-space: nowrap;" class="text-center"> {{ $item->lokasi_mesin }}
                                            </td>
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->kategori_mesin }}</td>
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->tanggal_perbaikan }}</td>
                                            <td style="white-space: nowrap;" class="text-center">{{ $item->status }}</td>
                                            <td style="white-space: nowrap;" class="text-center">
                                                {{ $item->metode_perbaikan }}</td>
                                            <td style="white-space: nowrap;" class="text-center">{{ $item->catatan }}</td>
                                            <td style="white-space: nowrap;" class="d-flex justify-content-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </td>

                                        @empty
                                            <td colspan="50">
                                                <div class="alert alert-danger text-center">

                                                    Belum ada Laporan
                                                </div>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforelse
                        </div>
                        {{-- <div class="card-footer d-flex justify-content-between">
                            <div>
                                iki?
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                IKI opo
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
