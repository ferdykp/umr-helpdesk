@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                    </div>
                    <div
                        class="card-header pb-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="d-flex flex-column w-100 w-md-auto mb-2 mb-md-0">
                            <div class="d-flex flex-column flex-sm-row">
                                <button class="btn btn-danger me-2 mb-2 mb-sm-0" id="delete_selected">Delete
                                    Selected</button>
                                <a href="{{ route('laporan.create') }}" class="btn btn-md btn-success me-2 mb-2 mb-sm-0">Add
                                    Laporan</a>
                                <a href="{{ route('laporan.export') }}" class="btn btn-md btn-warning me-2 mb-2 mb-sm-0">
                                    <i class="fa fa-download"></i> Export Data in Excel
                                </a>
                            </div>
                        </div>
                        <div class="w-100 w-md-25">
                            <input type="text" id="search" data-route="{{ route('laporan.search') }}" name="search"
                                placeholder="Search Laporan" autocomplete="off" class="form-control">
                        </div>
                    </div>

                    <div class="card-header pb-0">
                        <h6>Data Laporan</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-4">
                        <div class="table-responsive p-0">
                            <table id="datatable" class="table align-items-center mb-0" data-type="laporan">
                                <thead class="table-light">
                                    <tr>
                                        <th style="white-space: nowrap;" class="text-center"><input type="checkbox"
                                                name="select_all" id="select_all_id"></th>
                                        <th style="white-space: nowrap;" class="text-center">No</th>
                                        <th style="white-space: nowrap;" class="text-center">Nama Teknisi</th>
                                        <th style="white-space: nowrap;" class="text-center">Keterangan Kerusakan</th>
                                        <th style="white-space: nowrap;" class="text-center">Tanggal Kerusakan</th>
                                        <th style="white-space: nowrap;" class="text-center">Shift</th>
                                        <th style="white-space: nowrap;" class="text-center">Lokasi Mesin</th>
                                        <th style="white-space: nowrap;" class="text-center">Kategori Mesin</th>
                                        <th style="white-space: nowrap;" class="text-center">Status</th>
                                        <th style="white-space: nowrap;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('components.tableLaporan', ['data' => $laporan, 'routePrefix' => 'laporan'])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                Showing {{ $laporan->firstItem() }} to {{ $laporan->lastItem() }} of
                                {{ $laporan->total() }} entries
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $laporan->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection