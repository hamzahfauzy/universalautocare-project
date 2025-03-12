<?php

return [
    'mst_employees' => require 'tablefields/mst_employees.php',
    'mst_suppliers' => require 'tablefields/mst_suppliers.php',
    'mst_customers' => require 'tablefields/mst_customers.php',
    'mst_items' => [
        'category_id' => [
            'label' => 'Kategori',
            'type'  => 'options-obj:mst_categories,id,name',
        ],
        'name' => [
            'label' => 'Nama',
            'type'  => 'text',
        ],
        'price' => [
            'label' => 'Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control'
            ]
        ],
        'unit' => [
            'label' => 'Satuan',
            'type'  => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type'  => 'options:ACTIVE|INACTIVE',
        ],
        '_userstamp' => true,
    ],
    'mst_services' => [
        'category_id' => [
            'label' => 'Kategori',
            'type'  => 'options-obj:mst_categories,id,name',
        ],
        'name' => [
            'label' => 'Nama',
            'type'  => 'text',
        ],
        'price' => [
            'label' => 'Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control'
            ]
        ],
        'unit' => [
            'label' => 'Satuan',
            'type'  => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type'  => 'options:ACTIVE|INACTIVE',
        ],
        '_userstamp' => true,
    ],
    'mst_banks' => [
        'name' => [
            'label' => 'Nama',
            'type' => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:ACTIVE|INACTIVE',
        ],
        '_userstamp' => true,
    ],
    'mst_partners' => [
        'name' => [
            'label' => 'Nama',
            'type' => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:ACTIVE|INACTIVE',
        ],
        '_userstamp' => true,
    ],
    'mst_costs' => [
        'name' => [
            'label' => 'Nama',
            'type' => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:ACTIVE|INACTIVE',
        ],
        '_userstamp' => true,
    ],
    'mst_categories' => [
        'name' => [
            'label' => 'Nama',
            'type' => 'text',
        ],
        'record_type' => [
            'label' => 'Tipe Kategori',
            'type' => 'options:BARANG|JASA',
        ],
        '_userstamp' => true,
    ],
    'trn_purchases' => [
        'code' => [
            'label' => 'No. Pembelian',
            'type' => 'text',
        ],
        'date' => [
            'label' => 'Tanggal Pembelian',
            'type' => 'date',
        ],
        'supplier_id' => [
            'label' => 'Supplier',
            'type' => 'options-obj:mst_suppliers,id,name',
        ],
        'employee_id' => [
            'label' => 'Karyawan',
            'type' => 'options-obj:mst_employees,id,name',
        ],
        'total_item' => [
            'label' => 'Total Item',
            'type' => 'number',
        ],
        'total_qty' => [
            'label' => 'Total Kuantitas',
            'type' => 'text',
        ],
        'total_value' => [
            'label' => 'Total Nilai Pembelian',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        // 'total_payment' => [
        //     'label' => 'Total Pembayaran',
        //     'type' => 'number',
        //     'attr' => [
        //         'data-type' => 'currency',
        //         'class' => 'form-control',
        //         'required' => 'required',
        //         'min' => 1
        //     ]
        // ],
        // 'description' => [
        //     'label' => 'Keterangan',
        //     'type' => 'textarea',
        // ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:NEW|APPROVE|CANCEL',
        ],
        '_action_button' => true,
        '_userstamp' => true,
    ],
    'trn_purchase_items' => [
        'purchase_id' => [
            'label' => 'Pembelian',
            'type' => 'options-obj:trn_purchases,id,code',
        ],
        'order_number' => [
            'label' => 'Nomor Urut',
            'type' => 'number',
        ],
        'item_id' => [
            'label' => 'Barang',
            'type' => 'options-obj:mst_items,id,name',
        ],
        'price' => [
            'label' => 'Harga Satuan',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_qty' => [
            'label' => 'Total Kuantitas',
            'type' => 'text',
        ],
        'outgoing_qty' => [
            'label' => 'Kuantitas Pengeluaran',
            'type' => 'number',
        ],
        'unit' => [
            'label' => 'Satuan Barang',
            'type' => 'text',
        ],
        'total_price' => [
            'label' => 'Total Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        '_userstamp' => true,
    ],
    'trn_orders' => [
        'code' => [
            'label' => 'No. Order',
            'type' => 'text',
        ],
        'order_date' => [
            'label' => 'Tanggal Order',
            'type' => 'text',
            'search' => ['trn_orders.date','trn_orders.done_date']
        ],
        'employee' => [
            'label' => 'Karyawan / Partner',
            'type' => 'text',
            'search' => ['mst_employees.name','mst_partners.name']
        ],
        'total_value' => [
            'label' => 'Nilai Order',
            'type' => 'text',
        ],
        'customer' => [
            'label' => 'Customer',
            'type' => 'text',
            'search' => 'mst_customers.name'
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:NEW|APPROVE|CANCEL',
            'search' => 'trn_orders.status'
        ],
        '_action_button' => true,
        '_userstamp' => [
            'search' => false
        ],
    ],
    'trn_order_items' => [
        'order_id' => [
            'label' => 'Order',
            'type' => 'options-obj:trn_orders,id,code',
        ],
        'service_id' => [
            'label' => 'Service',
            'type' => 'options-obj:mst_services,id,name',
        ],
        'order_number' => [
            'label' => 'Nomor Urut',
            'type' => 'number',
        ],
        'price' => [
            'label' => 'Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'qty' => [
            'label' => 'Jumlah',
            'type' => 'number',
        ],
        'unit' => [
            'label' => 'Satuan',
            'type' => 'text',
        ],
        'total_price' => [
            'label' => 'Total Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        '_userstamp' => true,
    ],
    'trn_outgoings' => [
        'code' => [
            'label' => 'No. Pengeluaran',
            'type' => 'text',
        ],
        'date' => [
            'label' => 'Tgl. Pengeluaran',
            'type' => 'date',
        ],
        'employee' => [
            'label' => 'Customer / Karyawan',
            'type' => 'text',
            'search' => ['mst_customers.name', 'mst_employees.name']
        ],
        'items_qty' => [
            'label' => 'Total Items / Qty',
            'type' => 'text',
            'search' => ['trn_outgoings.total_outgoing_items', 'trn_outgoings.total_outgoing_qty']
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'text',
        ],
        '_action_button' => true,
        '_userstamp' => true,
    ],
    'trn_outgoing_items' => [
        'outgoing_id' => [
            'label' => 'Pengeluaran',
            'type' => 'options-obj:trn_outgoings,id,name',
        ],
        'order_number' => [
            'label' => 'Nomor Urut',
            'type' => 'number',
        ],
        'item_id' => [
            'label' => 'Barang',
            'type' => 'options-obj:mst_items,id,name',
        ],
        'purchase_id' => [
            'label' => 'Pembelian',
            'type' => 'options-obj:trn_purchases,id,code',
        ],
        'price' => [
            'label' => 'Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'outgoing_qty' => [
            'label' => 'Jumlah Pengeluaran',
            'type' => 'number',
        ],
        'unit' => [
            'label' => 'Satuan',
            'type' => 'text',
        ],
        'total_price' => [
            'label' => 'Total Harga',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        '_userstamp' => true,
    ],
    'trn_cash' => require 'tablefields/trn_cash.php'
];
