{{-- <x-action-button-group :buttons="[
    [
        'method' => 'edit',
        ':params' => "[$row->id]",
        'buttonType' => 'edit',
    ],
    [
        'method' => 'delete',
        'buttonType' => 'delete',
        ':params' => "[$row->id]",
    ]
]" /> --}}


{{-- @php
$buttons = [
    [
        'method' => '$parent.edit',
        'params' => '[$row->id]',
        'buttonType' => 'edit',
        
    ],
    // [
    //     'method' => 'delete',
    //     'params' => [$row->id],
    //     'buttonType' => 'delete',
    // ],
];
@endphp

<x-action-button-group :buttons="$buttons" /> --}}


{{-- <x-action-button
    method="$parent.edit"
    :params="[$row->id]"
    buttonType="edit"
/>
<x-action-button
    method="$parent.delete"
    :params="[$row->id]"
    buttonType="delete"
/> --}}


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
