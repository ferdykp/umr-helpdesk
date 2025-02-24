@forelse ($data as $index => $item)
    <tr>
        @if (in_array(Auth::user()->role, ['admin', 'user']))
            <td class="text-center">
                <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
            </td>
        @endif
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td class="text-center">{{ $item->nama_teknisi }}</td>
        <td class="text-center">{{ $item->keterangan_kerusakan }}</td>
        <td class="text-center">{{ $item->penyebab_kerusakan }}</td>
        <td class="text-center">{{ $item->tanggal_kerusakan }}</td>
        <td class="text-center">{{ $item->shift }}</td>
        <td class="text-center">{{ $item->lokasi_mesin }}</td>
        <td class="text-center">{{ $item->kategori_mesin }}</td>
        <td class="text-center">{{ $item->status }}</td>
        <td class="text-center">{{ $item->status }}</td>
        @if (in_array(Auth::user()->role, ['admin', 'user']))
            <td class="d-flex justify-content-center">
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('laporan.destroy', $item->id) }}"
                    method="POST" class="d-flex gap-2">
                    {{-- <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-sm btn-dark">Show</a> --}}
                    <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    {{-- <a href="{{ route('dynamic.edit', ['type' => $routePrefix, 'id' => $item->id]) }}"
                        class="btn btn-sm btn-primary">Edit</a> --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        @endif

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
