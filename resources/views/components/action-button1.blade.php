{{--
    <x-action-button> Blade Component

    Description:
    A reusable and flexible action button that triggers a Livewire method with optional SweetAlert2 v8 confirmation,
    tooltip support, loading spinner, and button disabling. Designed to integrate with Alpine.js and AdminLTE 3.

    Props (injected via class-based component):
    ---------------------------------------------------------------------------
    $method          => string     | Required: Livewire method name to call
    $params          => mixed      | Optional: Single value or array of parameters to pass
    $label           => string     | Optional: Button label text (default: "Action")
    $confirm         => bool       | Optional: Show SweetAlert confirmation? (default: false)
    $confirmMessage  => string     | Optional: Message inside the confirmation dialog
    $swalType        => string     | Optional: SweetAlert2 icon type (e.g., 'warning', 'info') (default: 'warning')
    $tooltip         => string     | Optional: Tooltip text shown on hover
    $icon            => string     | Optional: FontAwesome icon class (e.g., 'fas fa-trash')
    $variant         => string     | Optional: Bootstrap variant (e.g., 'danger', 'info') (default: 'primary')

    Example Usage in a Blade View:
    ---------------------------------------------------------------------------
    <x-action-button
        method="delete"
        :params="[$user->id]"
        label="Delete"
        confirm="true"
        confirm-message="Are you sure you want to delete this user?"
        swal-type="warning"
        tooltip="Delete this user"
        icon="fas fa-trash"
        variant="danger"
    />
--}}

{{-- @props([
    'method',
    'params' => null,
    'label' => 'Delete',
    'confirm' => false,
    'confirmMessage' => 'Are you sure?',
    'tooltip' => null,
    'icon' => null,
    'variant' => 'danger',
    'swalType' => 'warning', // default alert type
]) --}}
{{-- We don't need to use the @props as we are using a class based component. This can be removed after reporting--}}
@php
    $jsonParams = json_encode($params ?? []);
@endphp

<button
    x-data="{ loading: false }"
    x-bind:disabled="loading"
    @click.prevent="
        const args = {{ $jsonParams }};
        if ({{ $confirm ? 'true' : 'false' }}) {
            Swal.fire({
                title: '{{ $confirmMessage }}',
                type: '{{ $swalType }}',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.value) {
                    loading = true;
                    if ('{{ $method }}') {
                        $wire.call('{{ $method }}', ...args).then(() => loading = false);
                    } else {
                        loading = false;
                    }
                }
            }); 
        } else {
            loading = true;
            if ('{{ $method }}') {
                $wire.call('{{ $method }}', ...args).then(() => loading = false);
            } else {
                loading = false;
            }
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
