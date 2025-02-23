@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">
                        <!-- Tombol untuk membuka modal -->
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">
                            Upload Manual Book
                        </button>

                        <!-- Modal -->
                        <div id="uploadModal"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                                <!-- Header -->
                                <div class="flex justify-between items-center border-b pb-2">
                                    <h2 class="text-lg font-semibold">Upload Manual Book</h2>
                                    <button class="text-gray-500 hover:text-gray-700"
                                        onclick="closeModal()">&times;</button>
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
                                            onclick="closeModal()">Close</button>
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-md">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <h6 class="mb-0">List Manual Book</h6>
                        </div>
                        <div class="w-100 w-md-25"> <!-- Adjust the width as needed -->
                            <input type="text" id="search" data-route="" name="search" placeholder="Search WR Code"
                                autocomplete="off" class="form-control">
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="space-y-4">
                            @forelse ($data as $item)
                                <div class="border rounded-md p-4 mb-2">
                                    <button onclick="openModal('modal-{{ $loop->index }}')"
                                        class="w-full text-left font-semibold flex justify-between items-center">
                                        {{ $item->document_name }}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div id="modal-{{ $loop->index }}"
                                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
                                    <div class="bg-white rounded-lg p-6 w-full max-w-4xl shadow-lg relative">
                                        <!-- Close Button -->
                                        <button onclick="closeModal('modal-{{ $loop->index }}')"
                                            class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                                            ✕
                                        </button>

                                        <!-- Modal Content -->
                                        <h2 class="text-xl font-semibold mb-4">{{ $item->document_name }}</h2>
                                        <div class="w-full aspect-[16/9]">
                                            <iframe src="{{ url('/manualbook/view/' . basename($item->document_path)) }}"
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
        function openModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('uploadModal').classList.add('hidden');
        }
    </script>

    <!-- JavaScript untuk toggle preview -->
    {{-- <script>
        document.querySelectorAll('.toggle-button').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.getElementById(button.getAttribute('data-target'));
                const arrowIcon = button.querySelector('.arrow-icon');

                if (target.classList.contains('hidden')) {
                    target.classList.remove('hidden');
                    arrowIcon.classList.add('rotate-180');
                } else {
                    target.classList.add('hidden');
                    arrowIcon.classList.remove('rotate-180');
                }
            });
        });
    </script> --}}
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
    </script>
@endsection
