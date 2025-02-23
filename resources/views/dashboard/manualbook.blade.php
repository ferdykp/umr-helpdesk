@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal('uploadModal')">
                            Upload Manual Book
                        </button>


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
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded-md"
                                            onclick="closeModal('uploadModal')">Close</button>
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-md">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="w-100 w-md-auto mb-2 mb-md-0">
                                <h6 class="mb-0">List Manual Book</h6>
                            </div>
                            <div class="w-100 w-md-25">
                                <input type="text" id="search" data-route="" name="search"
                                    placeholder="Search WR Code" autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="space-y-4">
                                @forelse ($data as $item)
                                    <div class="border rounded-md p-4 mb-2 flex justify-between items-center">
                                        <button onclick="openModal('modal-{{ $loop->index }}')"
                                            class="text-left font-semibold flex-1">
                                            {{ $item->document_name }}
                                        </button>

                                        <form action="{{ route('manualbook.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus PDF ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Modal -->
                                    <div id="modal-{{ $loop->index }}"
                                        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
                                        <div
                                            class="bg-white rounded-lg p-6 w-full max-w-4xl h-100 flex flex-col shadow-lg relative">
                                            <!-- Close Button -->
                                            <button onclick="closeModal('modal-{{ $loop->index }}')"
                                                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-1xl p-3 rounded-full hover:bg-gray-200">
                                                ✕
                                            </button>

                                            <!-- Modal Header -->
                                            <div class="flex justify-between items-center mb-4">
                                                <h2 class="text-xl font-semibold">{{ $item->document_name }}</h2>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('manualbook.download', basename($item->document_path)) }}"
                                                        class="px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 me-3">
                                                        Download PDF
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Modal Content (PDF Preview) -->
                                            <div class="flex-1">
                                                <iframe
                                                    src="{{ url('/manualbook/view/' . basename($item->document_path)) }}"
                                                    class="w-full h-full border rounded-md" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-center text-gray-500">No data</h1>
                                @endforelse
                            </div>



                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">

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
                }
            }

            function closeModal(id) {
                let modal = document.getElementById(id);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }
        </script>
    @endsection
