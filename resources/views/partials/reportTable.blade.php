@forelse ($data as $index => $item)
    <tr>
        <td class="text-center">
            <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
        </td>
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->keterangan_kerusakan }}</td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->penyebab_kerusakan }}</td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->tanggal_kerusakan }}</td>
        <td style="white-space: nowrap;" class="text-center">{{ $item->shift }}</td>
        <td style="white-space: nowrap;" class="text-center">{{ $item->nama_teknisi }}
        </td>
        <td style="white-space: nowrap;" class="text-center"> {{ $item->lokasi_mesin }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->kategori_mesin }}</td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->tanggal_perbaikan }}</td>
        <td style="white-space: nowrap;" class="text-center">{{ $item->status }}</td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->metode_perbaikan }}</td>
        <td style="white-space: nowrap;" class="text-center">{{ $item->catatan }}</td>
        <td style="white-space: nowrap;" class="d-flex justify-content-center">
        <td class="d-flex justify-content-center">
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('report.destroy', $item->id) }}"
                method="POST" class="d-flex gap-2">
                {{-- <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-sm btn-dark">Show</a> --}}
                <a href="{{ route('report.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                {{-- <a href="{{ route('dynamic.edit', ['type' => $routePrefix, 'id' => $item->id]) }}"
                        class="btn btn-sm btn-primary">Edit</a> --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="50">
            <div class="alert alert-danger text-center">
                Data Barang belum tersedia.
            </div>
        </td>
    </tr>
@endforelse
