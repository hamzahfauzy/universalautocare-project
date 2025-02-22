<?php

return [
    'name' => [
        'label' => 'Nama',
        'type'  => 'text',
    ],
    'address' => [
        'label' => 'Alamat',
        'type'  => 'textarea',
        'attr'  => [
            'class' => 'form-control select2-search__field'
        ]
    ],
    'address_2' => [
        'label' => 'Alamat 2',
        'type'  => 'textarea',
        'attr'  => [
            'class' => 'form-control select2-search__field'
        ]
    ],
    'city' => [
        'label' => 'Kota',
        'type'  => 'text',
    ],
    'phone' => [
        'label' => 'No. HP',
        'type'  => 'text',
    ],
    'description' => [
        'label' => 'Keterangan',
        'type'  => 'textarea',
        'attr'  => [
            'class' => 'form-control select2-search__field'
        ]
    ],
    'status' => [
        'label' => 'Status',
        'type'  => 'options:ACTIVE|INACTIVE',
    ],
    '_userstamp' => true,
];