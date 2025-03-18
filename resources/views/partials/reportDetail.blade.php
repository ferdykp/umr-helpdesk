<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <div class="font-medium text-gray-700">Keterangan Kerusakan</div>
            <div class="text-gray-900">{{ $laporan->keterangan_kerusakan }}</div>
        </div>

        <div class="space-y-2">
            <div class="font-medium text-gray-700">Penyebab Kerusakan</div>
            <div class="text-gray-900">{{ $laporan->penyebab_kerusakan }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="space-y-2">
            <div class="font-medium text-gray-700">Tanggal Kerusakan</div>
            <div class="text-gray-900">{{ $laporan->tanggal_kerusakan }}</div>
        </div>

        <div class="space-y-2">
            <div class="font-medium text-gray-700">Shift</div>
            <div class="text-gray-900">{{ $laporan->shift }}</div>
        </div>

        <div class="space-y-2">
            <div class="font-medium text-gray-700">Nama Teknisi</div>
            <div class="text-gray-900">{{ $laporan->nama_teknisi }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <div class="font-medium text-gray-700">Lokasi Mesin</div>
            <div class="text-gray-900">{{ $laporan->lokasi_mesin }}</div>
        </div>

        <div class="space-y-2">
            <div class="font-medium text-gray-700">Kategori Mesin</div>
            <div class="text-gray-900">{{ $laporan->kategori_mesin }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <div class="font-medium text-gray-700">Tanggal Perbaikan</div>
            <div class="text-gray-900">{{ $laporan->tanggal_perbaikan ?: 'Belum diperbaiki' }}</div>
        </div>

        <div class="space-y-2">
            <div class="font-medium text-gray-700">Status</div>
            <div>
                <span
                    class="px-2 py-1 text-xs font-medium rounded-full {{ $laporan->status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $laporan->status }}
                </span>
            </div>
        </div>
    </div>

    <div class="space-y-2">
        <div class="font-medium text-gray-700">Metode Perbaikan</div>
        <div class="text-gray-900">{{ $laporan->metode_perbaikan ?: 'Belum ada metode perbaikan' }}</div>
    </div>

    <div class="space-y-2">
        <div class="font-medium text-gray-700">Catatan</div>
        <div class="text-gray-900">{{ $laporan->catatan ?: 'Tidak ada catatan' }}</div>
    </div>

    <div class="space-y-2">
        <div class="font-medium text-gray-700">Foto Kerusakan</div>
        @if ($laporan->foto)
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kerusakan"
                class="w-64 h-64 object-cover rounded-lg shadow-md">
        @else
            <p class="text-gray-500">Tidak ada foto tersedia.</p>
        @endif
    </div>
</div>
