<div class="d-flex flex-column flex-md-row">
    @foreach ($buttons as $button)
        @php
            $attrs = [];

            foreach ($button as $attr => $value) {
                if (is_bool($value) || is_numeric($value)) {
                    $attrs[":" . $attr] = $value;
                } else {
                    $attrs[$attr] = $value;
                }
            }

            $rendered = \Illuminate\Support\Facades\Blade::render(
                '<x-action-button ' . render_blade_attributes($attrs) . ' />'
            );
        @endphp
        <div class="mr-2 mt-2">{!! $rendered !!}</div>
    @endforeach
</div>
