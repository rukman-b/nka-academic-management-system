@props([
    'method',
    'id',
    'label' => 'Delete',
    'confirmMessage' => 'Are you sure?',
    'tooltip' => null,
])

<button
    x-data="{ loading: false }"
    x-bind:disabled="loading"
    x-init="
        window.addEventListener('sweet-delete-{{ $id }}', () => {
            loading = true;
            $wire.{{ $method }}({{ $id }}).then(() => loading = false);
        });
    "
    @click.prevent="
        Swal.fire({
            title: '{{ $confirmMessage }}',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                window.dispatchEvent(new CustomEvent('sweet-delete-{{ $id }}'));
            }
        });
    "
    class="btn btn-sm btn-danger d-flex align-items-center gap-1"
    @if ($tooltip)
        title="{{ $tooltip }}"
    @endif
>
    <span x-show="!loading">{{ $label }}</span>
    <span x-show="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
</button>
