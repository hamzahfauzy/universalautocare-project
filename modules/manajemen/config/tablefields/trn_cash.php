<?php

return [
    'code' => [
        'label' => 'Kode Kas',
        'type' => 'text',
        'attr' => [
            'readonly' => 'readonly'
        ]
    ],
    'date' => [
        'label' => 'Tanggal Kas',
        'type' => 'date',
    ],
    'cash_type' => [
        'label' => 'Tipe Kas',
        'type' => 'options:PELUNASAN|DP / TANDA JADI',
    ],
    'discount' => [
        'label' => 'Potongan',
        'type' => 'number',
        'attr' => [
            'data-type' => 'currency',
            'class' => 'form-control',
            'required' => 'required',
            'min' => 1,
            'value' => 0
        ]
    ],
    'cash_resource' => [
        'label' => 'Sumber Kas',
        'type' => 'options:CASH|TRANSFER|E-MONEY|BG (BILYET GIRO)',
    ],
    'cash_total' => [
        'label' => 'Total Kas',
        'type' => 'number',
        'attr' => [
            'data-type' => 'currency',
            'class' => 'form-control',
            'required' => 'required',
            'min' => 1
        ]
    ],
    'bank_id' => [
        'label' => 'Bank',
        'type' => 'options-obj:mst_banks,id,name',
    ],
    'total_payment' => [
        'label' => 'Total Pembayaran',
        'type' => 'number',
        'attr' => [
            'data-type' => 'currency',
            'readonly' => 'readonly',
            'class' => 'form-control',
            'required' => 'required',
            'min' => 1
        ]
    ],
    'reference_number' => [
        'label' => 'Nomor Referensi',
        'type' => 'text',
    ],
    'reference_date' => [
        'label' => 'Tanggal Referensi',
        'type' => 'text',
        'attr' => [
            'readonly' => 'readonly'
        ]
    ],
    'reference_name' => [
        'label' => 'Nama Referensi',
        'type' => 'text',
        'attr' => [
            'readonly' => 'readonly'
        ]
    ],
    'police_number_reference' => [
        'label' => 'Nomor Polisi Referensi',
        'type' => 'text',
        'attr' => [
            'readonly' => 'readonly'
        ]
    ],
    'total_value' => [
        'label' => 'Total Nilai',
        'type' => 'number',
        'attr' => [
            'readonly' => 'readonly',
            'data-type' => 'currency',
            'class' => 'form-control',
            'required' => 'required',
            'min' => 1
        ]
    ],
    'description' => [
        'label' => 'Keterangan',
        'type' => 'textarea',
        'attr' => [
            'class' => 'form-control select2-search__field'
        ]
    ],
    'status' => [
        'label' => 'Status',
        'type' => 'options:NEW|APPROVE|CANCEL',
    ],
    '_action' => true,
    '_userstamp' => true,
];
