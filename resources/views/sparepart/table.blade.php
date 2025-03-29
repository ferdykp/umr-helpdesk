@forelse ($data as $index => $item)
    <tr>
        @if (Auth::user()->role == 'admin')
            <td class="text-center">
                <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
            </td>
        @endif
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->nama_sparepart }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->kategori }}
        </td>

        <td style="white-space: nowrap;" class="text-center">
            {{ $item->stok }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->update_stok }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->lokasi_penyimpanan }}
        </td>
        <!-- Bagian Status dengan warna -->
        <td style="white-space: nowrap;" class="text-center">
            <span class="status-badge {{ strtolower(str_replace(' ', '-', $item->status)) }}">
                {{ $item->status }}
            </span>
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->catatan }}
        </td>
        @if (Auth::user()->role == 'admin')
            <td class="d-flex justify-content-center">
                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                    action="{{ route('report.destroy', $item->id) }}" method="POST" class="d-flex gap-2">
                    <a href="{{ route('sparepart.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
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

<style>
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: bold;
        color: white;
    }

    .tidak-tersedia {
        background-color: red;
    }

    .tersedia {
        background-color: green;
    }
</style>
