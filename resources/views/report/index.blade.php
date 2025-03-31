@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                        <div class="w-100 w-md-auto ">
                            <h4 class="">List Laporan Kerusakan</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body p-4">
                        <div
                            class="pb-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="w-100 w-md-auto mb-2 mb-md-0">
                                <div class="d-flex flex-column flex-sm-row">
                                    <a href="{{ route('report.create') }}"
                                        class="btn btn-md btn-success me-2 mb-2 mb-sm-0">Tambah
                                        Laporan</a>
                                    <a href="{{ route('report.export') }}" class="btn btn-md btn-warning me-2 mb-2 mb-sm-0">
                                        <i class="fa fa-download"></i> Export Data in Excel
                                    </a>
                                    @if (Auth::user()->role == 'admin')
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
                            <div class="w-100 w-md-100" style="max-width: 100%;">
                                <div class="row items-center">

                                    <div class="col-md-3">
                                        <input type="text" id="search" data-route="{{ route('report.search') }}"
                                            name="search" placeholder="Search Report" autocomplete="off"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-3">

                                        <select class="form-control" name="shift" id="shift-select" required
                                            autocomplete="shift" autofocus>
                                        </select>
                                    </div>


                                    <div class="col-md-3">

                                        <select class="form-control" name="lokasi_mesin" id="location-select" required
                                            autocomplete="lokasi_mesin" autofocus>
                                        </select>
                                    </div>



                                    <div class="col-md-3">

                                        <select class="form-control" name="kategori_mesin" id="machine-select" required
                                            autocomplete="kategori_mesin" autofocus>
                                        </select>
                                    </div>


                                </div>
                                <!-- Clear Filter button added below the filter row -->
                                <div class="row mt-2">
                                    <div class="col-12 d-flex justify-content-start">
                                        <button id="clear-filter" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> Clear Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Report Detail Modal -->
                        <div id="reportModal" class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden">
                            <!-- Modal backdrop -->
                            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="modalBackdrop"></div>

                            <!-- Modal content -->
                            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                                <div
                                    class="relative bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Detail Laporan Kerusakan
                                        </h3>
                                        <button type="button" id="closeModal"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="px-6 py-4">
                                        <div id="report_detail" class="text-left">
                                            <div class="flex justify-center items-center py-6">
                                                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-500">
                                                </div>
                                                <span class="ml-3 text-gray-600">Loading...</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                                        <button type="button" id="closeModalBtn"
                                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive p-0 rounded-lg my-3">
                            <table id="datatable" class="table align-items-center mb-0" data-type="report">
                                <thead class="table-light">
                                    <tr>
                                        @if (Auth::user()->role == 'admin')
                                            <th class="whitespace-nowrap text-center"><input type="checkbox"
                                                    name="select_all" id="select_all_id"></th>
                                            <th class="whitespace-nowrap text-center">No</th>
                                            <th class="whitespace-nowrap text-center">Keterangan Kerusakan
                                            </th>
                                            <th class="whitespace-nowrap text-center">Penyebab Kerusakan</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Kerusakan</th>
                                            <th class="whitespace-nowrap text-center">Shift</th>
                                            <th class="whitespace-nowrap text-center">Nama Teknisi</th>
                                            <th class="whitespace-nowrap text-center">Lokasi Mesin</th>
                                            <th class="whitespace-nowrap text-center">Kategori Mesin</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Perbaikan</th>
                                            <th class="whitespace-nowrap text-center">Status</th>
                                            <th class="whitespace-nowrap text-center">Metode Perbaikan</th>
                                            <th class="whitespace-nowrap text-center">Catatan</th>
                                            <th class="whitespace-nowrap text-center">Action</th>
                                        @else
                                            <th class="whitespace-nowrap text-center">No</th>
                                            <th class="whitespace-nowrap text-center">Keterangan Kerusakan
                                            </th>
                                            <th class="whitespace-nowrap text-center">Penyebab Kerusakan</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Kerusakan</th>
                                            <th class="whitespace-nowrap text-center">Shift</th>
                                            <th class="whitespace-nowrap text-center">Nama Teknisi</th>
                                            <th class="whitespace-nowrap text-center">Lokasi Mesin</th>
                                            <th class="whitespace-nowrap text-center">Kategori Mesin</th>
                                            <th class="whitespace-nowrap text-center">Tanggal Perbaikan</th>
                                            <th class="whitespace-nowrap text-center">Status</th>
                                            <th class="whitespace-nowrap text-center">Metode Perbaikan</th>
                                            <th class="whitespace-nowrap text-center">Catatan</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('report.table', [
                                        'data' => $laporan,
                                        'routePrefix' => 'report',
                                    ])
                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Showing {{ $laporan->firstItem() }} to {{ $laporan->lastItem() }} of
                            {{ $laporan->total() }} entries
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $laporan->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Open modal when detail button is clicked
            $(".btn-report-detail").click(function() {
                var reportId = $(this).data("id");

                // Show the modal
                $("#reportModal").removeClass("hidden");
                $("body").addClass("overflow-hidden"); // Prevent body scrolling

                // Set loading state
                $("#report_detail").html(`
<div class="flex justify-center items-center py-6">
<div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-500"></div>
<span class="ml-3 text-gray-600">Loading...</span>
</div>
`);

                // Fetch report data
                $.ajax({
                    url: "/report/" + reportId,
                    type: "GET",
                    success: function(response) {
                        $("#report_detail").html(response);
                    },
                    error: function() {
                        $("#report_detail").html(`
<div class="text-center py-6">
<svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
<p class="mt-2 text-red-500 font-medium">Gagal mengambil data laporan!</p>
<p class="mt-1 text-gray-500">Silakan coba lagi nanti.</p>
</div>
`);
                    }
                });
            });

            // Close modal functions
            function closeModal() {
                $("#reportModal").addClass("hidden");
                $("body").removeClass("overflow-hidden");
            }

            // Close modal when clicking close button
            $("#closeModal, #closeModalBtn").click(function() {
                closeModal();
            });

            // Close modal when clicking outside
            $(document).on("click", "#modalBackdrop", function() {
                closeModal();
            });

            // Close modal on ESC key
            $(document).keydown(function(e) {
                if (e.key === "Escape" && !$("#reportModal").hasClass("hidden")) {
                    closeModal();
                }
            });
        });
    </script>
@endsection

@push('customScript')
    <script>
        let timer = null;
        let originalContent = $('#table-body').html();

        $('#search').on('input', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                triggerFilter();
            }, 300);
        });

        $('#shift-select, #machine-select, #location-select').on('change', function() {
            triggerFilter();
        });

        // Clear filter functionality
        $('#clear-filter').on('click', function() {
            // Clear search input
            $('#search').val('');

            // Clear all select2 dropdowns
            $('#shift-select').val(null).trigger('change');
            $('#location-select').val(null).trigger('change');
            $('#machine-select').val(null).trigger('change');

            // Reset the table to original state
            $.ajax({
                url: "{{ route('report') }}",
                type: "GET",
                dataType: "html",
                success: function(response) {
                    // Extract the table body content from the response
                    let tempDiv = document.createElement('div');
                    tempDiv.innerHTML = response;
                    let newTableBody = tempDiv.querySelector('#table-body').innerHTML;

                    // Update the table body
                    $('#table-body').html(newTableBody);

                    // Reset pagination if needed
                    let pagination = tempDiv.querySelector('.d-flex.justify-content-center.mt-3')
                        .innerHTML;
                    $('.d-flex.justify-content-center.mt-3').html(pagination);

                    // Reset footer information
                    let footerInfo = tempDiv.querySelector('.card-footer').innerHTML;
                    $('.card-footer').html(footerInfo);
                },
                error: function(xhr) {
                    console.error('Error clearing filters:', xhr.responseText);
                    alert('Gagal mengatur ulang filter. Silakan coba lagi.');
                }
            });
        });

        function triggerFilter() {
            clearTimeout(timer);
            let query = $('#search').val().trim() || '';
            let shift = $('#shift-select').val() || '';
            let location = $('#location-select').val() || '';
            let machine = $('#machine-select').val() || '';

            console.log(query, shift, location, machine);
            performSearch(query, shift, location, machine);
        }

        function performSearch(query, shift, location, machine) {
            $.ajax({
                url: "{{ route('report.search') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    search: encodeURIComponent(query),
                    shift: encodeURIComponent(shift),
                    machine: encodeURIComponent(machine),
                    location: encodeURIComponent(location),
                },
                dataType: "json",
                beforeSend: function() {
                    $('#table-body').html(
                        '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Searching...</div>'
                    );
                },
                success: function(response) {
                    console.log(response);
                    if (response.html) {
                        $('#table-body').html(response.html);
                    } else {
                        $('#table-body').html(
                            '<div class="alert alert-info">No results found.</div>');
                    }
                },
                error: function(xhr) {
                    let errorMsg =
                        '<div class="alert alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg =
                            `<div class="alert alert-danger">${xhr.responseJSON.message}</div>`;
                    }
                    $('#table-body').html(errorMsg);
                    console.error(xhr.responseText);
                }
            });
        }

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
    </script>
@endpush
