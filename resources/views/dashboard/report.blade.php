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
                                    <button class="btn btn-danger me-2 mb-2 mb-sm-0" id="delete_selected">Delete
                                        Selected</button>

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
                            <div class="w-100 w-md-auto" style="max-width: 100%;">
                                <input type="text" id="search" data-route="" name="search"
                                    placeholder="Search Report" autocomplete="off" class="form-control">
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
                                        <th style="white-space: nowrap;" class="text-center"><input type="checkbox"
                                                name="select_all" id="select_all_id"></th>
                                        <th style="white-space: nowrap;" class="text-center">No</th>
                                        <th style="white-space: nowrap;" class="text-center">Keterangan Kerusakan
                                        </th>
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
                                    @include('partials.reportTable', [
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
