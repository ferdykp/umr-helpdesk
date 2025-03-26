@forelse ($data as $item)
    @php
        // Use the search prefix if provided, otherwise use normal prefix
        $modalPrefix = isset($searchPrefix) ? $searchPrefix : '';
        $modalId = $modalPrefix . 'modal-' . $loop->index;
    @endphp
    <div class="border rounded-md p-4 mb-2 flex justify-between items-center">
        <button onclick="openModal('{{ $modalId }}')" class="text-left font-semibold flex-1">
            {{ $item->document_name }}
        </button>

        <form action="{{ route('audit.destroy', $item->id) }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus PDF ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                Delete
            </button>
        </form>
    </div>

    <!-- Modal Pdf Preview -->
    <div id="{{ $modalId }}"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50 overflow-y-auto">
        <div class="bg-white rounded-lg p-4 md:p-6 w-full max-w-4xl mx-auto my-4 flex flex-col shadow-lg relative"
            style="height: 85vh; max-height: 800px;">


            <!-- Modal Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 pr-8">
                <h2 class="text-xl font-semibold truncate max-w-full md:max-w-xs lg:max-w-sm">{{ $item->document_name }}
                </h2>
            </div>

            <!-- Modal Content (PDF Preview) -->
            <div class="flex-1 w-full overflow-hidden">
                <iframe src="{{ url('/audit/view/' . basename($item->document_path)) }}"
                    class="w-full h-full border rounded-md" frameborder="0"></iframe>
            </div>

            {{-- Footer --}}
            <div class="flex flex-col sm:flex-row justify-end sm:space-x-2 space-y-2 sm:space-y-0 mt-2">
                <button type="button"
                    class="w-full sm:w-auto bg-red-400 text-white px-4 py-2 rounded-md text-center hover:bg-red-500"
                    onclick="closeModal('{{ $modalId }}')">
                    Close
                </button>
                <a href="{{ route('audit.download', basename($item->document_path)) }}"
                    class="px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 whitespace-nowrap text-center">
                    Download PDF
                </a>
            </div>
        </div>
    </div>
@empty
    <h1 class="text-center text-gray-500">No data</h1>
@endforelse
