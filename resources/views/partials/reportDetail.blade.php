<div class="space-y-6">
    <!-- Foto Kerusakan di Atas dengan Full Width -->
    <div class="space-y-2">
        <div class="font-medium text-gray-700">Foto Kerusakan</div>
        @if ($laporan->foto)
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kerusakan"
                class="w-full h-96 object-cover rounded-lg shadow-md">
        @else
            <p class="text-gray-500">Tidak ada foto tersedia.</p>
        @endif
    </div>

    <!-- Informasi Laporan dalam Tabel -->
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
        <tbody>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Keterangan Kerusakan</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->keterangan_kerusakan }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Penyebab Kerusakan</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->penyebab_kerusakan }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Tanggal Kerusakan</td>
                <td class="px-4 py-2 text-gray-900">
                    {{ \Carbon\Carbon::parse($laporan->tanggal_kerusakan)->format('d/m/Y') }}
                </td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Shift</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->shift }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Nama Teknisi</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->nama_teknisi }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Lokasi Mesin</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->lokasi_mesin }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Kategori Mesin</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->kategori_mesin }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Tanggal Perbaikan</td>
                <td class="px-4 py-2 text-gray-900">
                    {{ $laporan->tanggal_perbaikan ? \Carbon\Carbon::parse($laporan->tanggal_perbaikan)->format('d/m/Y') : 'Belum diperbaiki' }}
                </td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Status</td>
                <td class="px-4 py-2">
                    <span
                        class="px-2 py-1 text-xs font-medium rounded-full {{ $laporan->status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $laporan->status }}
                    </span>
                </td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="px-4 py-2 font-medium text-gray-700">Metode Perbaikan</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->metode_perbaikan ?: 'Belum ada metode perbaikan' }}
                </td>
            </tr>
            <tr>
                <td class="px-4 py-2 font-medium text-gray-700">Catatan</td>
                <td class="px-4 py-2 text-gray-900">{{ $laporan->catatan ?: 'Tidak ada catatan' }}</td>
            </tr>
        </tbody>
    </table>
</div>
