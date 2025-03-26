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
        <td class="whitespace-nowrap text-center">
            {{ $item->keterangan_kerusakan }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->penyebab_kerusakan }}
        </td>
        {{-- <td class="whitespace-nowrap text-center">
            {{ $item->tanggal_kerusakan }}
        </td> --}}
        <td class="whitespace-nowrap text-center">
            {{-- {{ \Carbon\Carbon::parse($item->tanggal_kerusakan)->format('d/m/Y') }} --}}
            {{ $item->tanggal_kerusakan }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->shift }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->nama_teknisi }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->lokasi_mesin }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->kategori_mesin }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{-- {{ \Carbon\Carbon::parse($item->tanggal_perbaikan)->format('d/m/Y') }} --}}
            {{ $item->tanggal_perbaikan }}

        </td>

        <!-- Bagian Status dengan warna -->
        <td class="whitespace-nowrap text-center">
            <span class="status-badge {{ strtolower(str_replace(' ', '-', $item->status)) }}">
                {{ $item->status }}
            </span>
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->metode_perbaikan }}
        </td>
        <td class="whitespace-nowrap text-center">
            {{ $item->catatan }}
        </td>

        <td class="d-flex justify-content-center gap-2">
            @if (Auth::user()->role == 'admin')
                <button class="btn btn-sm btn-warning btn-report-detail" data-id="{{ $item->id }}">
                    Detail
                </button>
                <a href="{{ route('report.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                    action="{{ route('report.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                @else
                    <button class="btn btn-sm btn-warning btn-report-detail" data-id="{{ $item->id }}">
                        Detail
                    </button>
            @endif
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

    .belum-mulai {
        background-color: red;
    }

    .dalam-proses {
        background-color: yellow;
        color: black;
    }

    .selesai {
        background-color: green;
    }
</style>
