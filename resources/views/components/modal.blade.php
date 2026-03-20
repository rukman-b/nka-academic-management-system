<div
    wire:ignore.self
    class="modal fade"
    id="{{ $id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content shadow-sm border-0">

            {{-- Modal Header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
