@php
    $jsonParams = json_encode($params ?? []);
@endphp

<button
    x-data="{ loading: false }"
    x-bind:disabled="loading"
    @click.prevent="
        const args = {{ $jsonParams }};
        const method = '{{ $method }}';
        const isParent = method.startsWith('$parent.');
        const methodName = method.replace('$parent.', '');

        const componentRef = Livewire.find($el.closest('[wire\\:id]').getAttribute('wire:id'));

        const callMethod = () => {
            const target = isParent ? componentRef.$parent : componentRef; 
            target[methodName](...args).then(() => loading = false);
        };

        if ({{ $confirm ? 'true' : 'false' }}) {
            Swal.fire({
                title: '{{ $confirmMessage }}',
                icon: '{{ $swalType }}',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.value) {
                    loading = true;
                    callMethod();
                }
            });
        } else {
            loading = true;
            callMethod();
        }
    "
    class="btn btn-sm btn-{{ $variant }} d-flex align-items-center gap-1"
    @if ($tooltip)
        title="{{ $tooltip }}"
    @endif
>
    @if ($icon)
        <i class="{{ $icon }} mr-1"></i>
    @endif
    <span x-show="!loading">{{ $label }}</span>
    <span x-show="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
</button>
