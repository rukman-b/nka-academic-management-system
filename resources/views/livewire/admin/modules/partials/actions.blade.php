
@php
    $buttons = [
        [
            'method' => '$parent.edit',
            'params' => [$row->id],
            'buttonType' => 'edit',
        ],
        [
            'method' => '$parent.delete',
            'params' => [$row->id],
            'buttonType' => 'delete',
        ],
    ];
@endphp

<x-action-button-group :buttons="$buttons" />
