@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <h4 class="mb-0">List Manual Book</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
                                <button class="btn btn-primary w-lg-auto mb-3 mb-md-0" onclick="openModal('uploadModal')">
                                    Upload Manual Book
                                </button>
                                <div class="w-100 w-md-25 ms-md-3">
                                    <input type="text" id="search" data-route="{{ route('manualbook.search') }}"
                                        name="search" placeholder="Search Manual Book" autocomplete="off"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Modal Upload Manual Book -->
                        <div id="uploadModal"
                            class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4">
                            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                                <!-- Header -->
                                <div class="flex justify-between items-center border-b pb-2">
                                    <h2 class="text-lg font-semibold">Upload Manual Book</h2>
                                    <button onclick="closeModal('uploadModal')"
                                        class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl p-3 rounded-full hover:bg-gray-200">
                                        ✕
                                    </button>
                                </div>

                                <!-- Form -->
                                <form action="{{ route('manualbook.import') }}" method="POST" enctype="multipart/form-data"
                                    class="mt-4">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="fileUpload" class="block text-sm font-medium text-gray-700">Upload
                                            Manual Book</label>
                                        <input type="file" name="file" id="fileUpload"
                                            class="mt-1 w-full border rounded-md p-2">
                                    </div>
                                    <div class="mb-4">
                                        <label for="document_name" class="block text-sm font-medium text-gray-700">File
                                            Name:</label>
                                        <input type="text" name="document_name" id="document_name"
                                            class="mt-1 w-full border rounded-md p-2" placeholder="Insert File Name">
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex flex-col sm:flex-row justify-end sm:space-x-2 space-y-2 sm:space-y-0">
                                        <button type="button"
                                            class="w-full sm:w-auto bg-gray-400 text-white px-4 py-2 rounded-md text-center hover:bg-gray-500"
                                            onclick="closeModal('uploadModal')">
                                            Close
                                        </button>
                                        <button type="submit"
                                            class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-md text-center hover:bg-blue-700">
                                            Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="space-y-4" id="manualbookList">
                            @include('partials.manualbookList', ['data' => $data])
                        </div>
                        <div id="search-results" class="space-y-4">
                            <!-- Initial content or empty -->
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of
                            {{ $data->total() }} entries
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Script Modal -->
    <script>
        function openModal(id) {
            let modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden'; // Prevent body scrolling when modal is open
            }
        }

        function closeModal(id) {
            let modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = ''; // Restore body scrolling
            }
        }
    </script>
    {{-- Script Search --}}
    <script>
        $(document).ready(function() {
            let timer = null;
            let originalContent = $('#manualbookList').html();

            $('#search').on('input', function() {
                clearTimeout(timer);
                let query = $(this).val().trim();

                timer = setTimeout(() => {
                    if (query === '') {
                        $('#manualbookList').html(originalContent);
                    } else {
                        performSearch(query);
                    }
                }, 300);
            });

            function performSearch(query) {
                $.ajax({
                    url: "/manualbook-search",
                    type: "GET",
                    data: {
                        search: encodeURIComponent(query)
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#manualbookList').html(
                            '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Searching...</div>'
                        );
                    },
                    success: function(response) {
                        if (response.html) {
                            $('#manualbookList').html(response.html);
                        } else {
                            $('#manualbookList').html(
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
                        $('#manualbookList').html(errorMsg);
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
