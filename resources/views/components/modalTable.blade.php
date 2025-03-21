<div class="modal fade {{ $modalClass }}" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $modalSize }}">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $modalTitle }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $modalBody }}
            </div>
            <div class="modal-footer">
                @forelse ($modalFooter as $value)
                    {{ $value }}
                @empty
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                @endforelse
            </div>
        </div>
    </div>
</div>
