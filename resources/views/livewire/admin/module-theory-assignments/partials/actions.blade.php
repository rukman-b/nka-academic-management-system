
@php
    $buttons = [
        // [
        //     'method' => '$parent.edit',
        //     'params' => [$row->id],
        //     'buttonType' => 'edit',
        // ],
        [
            'method' => '$parent.delete',
            'params' => [$row->id],
            'buttonType' => 'delete',
        ],
        [
            'method' => '$parent.loadDetailsModal',
            'params' => [$row->id],
            'label' => 'view',
            'buttonType' => 'view',
        ],
    ];
@endphp

<x-action-button-group :buttons="$buttons" />
