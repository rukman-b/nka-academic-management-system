<div class="d-flex flex-column flex-md-row justify-content-center gap-2">
    @foreach ($buttons as $button)
        @php
            $rendered = \Illuminate\Support\Facades\Blade::render(
                '<x-action-button ' . render_blade_attributes($button) . ' />'
            );
        @endphp
        <div class="mr-2 mt-2">{!! $rendered !!}</div>
    @endforeach
</div>