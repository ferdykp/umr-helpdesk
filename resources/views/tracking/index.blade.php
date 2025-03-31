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
                        <div class="w-100 w-md-auto ">
                            <h4 class="">Tracking Sparepart</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body p-4">
                        <div
                            class="pb-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="w-100 w-md-auto mb-2 mb-md-0">
                                <div class="d-flex flex-column flex-sm-row">
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{ route('tracking.create') }}"
                                            class="btn btn-md btn-success me-2 mb-2 mb-sm-0">Tambah Tracking
                                            Sparepart</a>
                                        <a href="{{ route('tracking.export') }}"
                                            class="btn btn-md btn-warning me-2 mb-2 mb-sm-0">
                                            <i class="fa fa-download"></i> Export Data in Excel
                                        </a>
                                        <button class="btn btn-danger me-2 mb-2 mb-sm-0" id="delete_selected">Delete
                                            Selected</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center my-3">
                            <!-- Left section with Delete Selected button -->
                            {{-- <div class="mb-3 mb-md-0">
                                    <button class="btn btn-danger" id="delete_selected">Delete Selected</button>
                                </div> --}}

                            <!-- Right section with search input -->
                            <div class="w-100 w-md-auto" style="max-width: 300px;">
                                <input type="text" id="search" data-route="{{ route('tracking.search') }}"
                                    name="search" placeholder="Search Report" autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive p-0 rounded-lg my-3">
                            <table id="datatable" class="table align-items-center mb-0" data-type="tracking">
                                <thead class="table-light">
                                    <tr>
                                        @if (Auth::user()->role == 'admin')
                                            <th class="whitespace-nowrap text-center"><input type="checkbox"
                                                    name="select_all" id="select_all_id"></th>
                                            <th class="whitespace-nowrap text-center">No</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Update</th>
                                            <th class="whitespace-nowrap text-center">Nama Sparepart</th>
                                            <th class="whitespace-nowrap text-center">status</th>
                                            <th class="whitespace-nowrap text-center">Jumlah Barang</th>
                                            <th class="whitespace-nowrap text-center">Satuan</th>
                                            <th class="whitespace-nowrap text-center">Kategori Barang</th>
                                            <th class="whitespace-nowrap text-center">Vendor Teknisi</th>
                                            <th class="whitespace-nowrap text-center">PIC</th>
                                            <th class="whitespace-nowrap text-center">Catatan</th>
                                            <th class="whitespace-nowrap text-center">Action</th>
                                        @else
                                            <th class="whitespace-nowrap text-center">No</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Update</th>
                                            <th class="whitespace-nowrap text-center">Nama Sparepart</th>
                                            <th class="whitespace-nowrap text-center">status</th>
                                            <th class="whitespace-nowrap text-center">Jumlah Barang</th>
                                            <th class="whitespace-nowrap text-center">Satuan</th>
                                            <th class="whitespace-nowrap text-center">Kategori Barang</th>
                                            <th class="whitespace-nowrap text-center">Vendor Teknisi</th>
                                            <th class="whitespace-nowrap text-center">PIC</th>
                                            <th class="whitespace-nowrap text-center">Catatan</th>
                                        @endif


                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('tracking.table', [
                                        'data' => $trackings,
                                        'routePrefix' => 'tracking',
                                    ])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Showing {{ $trackings->firstItem() }} to {{ $trackings->lastItem() }} of
                            {{ $trackings->total() }} entries
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $trackings->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Basic search
            $('#search').on('keyup', function() {
                performSearch();
            });

            // Function to perform the search
            function performSearch() {
                let query = $('#search').val();

                // Only search if query is more than 2 chars or empty, or if filters are set
                if (query.length > 2 || query.length === 0) {
                    $.ajax({
                        url: "{{ route('tracking.search') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query,

                        },
                        beforeSend: function() {
                            // Show loading indicator if you have one
                            $('#loading-indicator').removeClass('d-none');
                        },
                        success: function(response) {
                            $('#table-body').html(response.html);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            console.log(xhr.responseText);
                        },
                        complete: function() {
                            // Hide loading indicator if you have one
                            $('#loading-indicator').addClass('d-none');
                        }
                    });
                }
            }

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('href'),
                    type: "GET",
                    success: function(response) {
                        $('#table-body').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error("Pagination Error:", status, error);
                    }
                });
            });

            // Select all checkboxes
            $('#select_all_id').on('click', function() {
                $('.checkbox_id').prop('checked', $(this).prop('checked'));
            });


        });
    </script>
@endsection
