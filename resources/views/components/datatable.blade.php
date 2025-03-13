<div class="table-responsive p-0 rounded-lg my-3">
    <div class=" p-2">
        @if ($btnAdd)
            <button class="btn btn-sm btn-success mb-sm-0"><i class="fas fa-plus"></i> Tambah</button>
        @endif
        @if ($btnExport)
            <button class="btn btn-sm btn-warning mb-sm-0"><i class="fas fa-download"></i> Export</button>
        @endif
    </div>
    <table id="{{ $tableId }}" class="table table-striped {{ $tableClass }}">
        <thead class="table-light">
            {{-- {{ dd($colums) }} --}}
            <tr>
                @foreach ($colums as $column)
                    <th class="{{$column['thClass'] }}" width="{{$column['thWidth'] }}">
                        {{$column['thText'] }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Data akan diisi oleh DataTable -->
        </tbody>
    </table>
</div>

@push('customScript')
<script>
    generateTable{{ $tableId }}();
    function generateTable{{ $tableId }}(){
        $('#{{ $tableId }}').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ $urlGet }}',
                type: 'GET',
                data: function(d) {
                    @foreach ($aoData as $value)
                        d.{{ $value }} = $('#{{ $value }}').val();
                    @endforeach
                }
            }
            columns: [
                @foreach ($colums as $column)
                    { data: '{{ ($column['thText'])?? null }}' },
                @endforeach
            ],
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
        });
    }

    function reloadTable(){
        var dtable = $("#{{ $tableId }}").dataTable({
            bRetrieve: true
        });
        dtable.fnDraw(false);
    }

</script>
@endpush