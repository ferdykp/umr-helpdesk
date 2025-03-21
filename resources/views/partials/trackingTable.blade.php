@forelse ($data as $index => $item)
    <tr>
        <td class="text-center">
            <input type="checkbox" class="checkbox_id" value="{{ $item->id }}">
        </td>
        <td class="text-center">
            {{ $index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->tanggal_update }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->nama_sparepart }}
        </td>

        <!--Bagian Status dengan warna -->
        <td style="white-space: nowrap;" class="text-center">
            <span class="status-badge {{ strtolower(str_replace(' ', '-', $item->status)) }}">
                {{ $item->status }}
            </span>
        </td>

        <td style="white-space: nowrap;" class="text-center">
            {{ $item->jumlah_barang }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->satuan }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->kategori_barang }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->vendor_teknisi }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->pic }}
        </td>
        <td style="white-space: nowrap;" class="text-center">
            {{ $item->catatan }}
        </td>
        <td class="d-flex justify-content-center">
        <td class="d-flex justify-content-center">
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('tracking.destroy', $item->id) }}"
                method="POST" class="d-flex gap-2">
                <a href="{{ route('tracking.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
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

<style>
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: bold;
        color: white;
    }

    .dipesan {
        background-color: yellow;

    }

    .selesai_servis {
        background-color: lightgreen;
    }

    .servis {
        background-color: red;
    }

    .masuk_inventory {
        background-color: green;
    }

    .sudah_datang {
        background-color: blue;
    }
</style>
