<?php 

return [
    'mst_employees' => [
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
    ],
    'mst_suppliers' => [
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
    ],
    'mst_customers' => [
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
    ],
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
            'type' => 'number',
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
            'type' => 'number',
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
        'employee_id' => [
            'label' => 'Karyawan',
            'type' => 'options-obj:mst_employees,id,name',
        ],
        'customer_id' => [
            'label' => 'Customer',
            'type' => 'options-obj:mst_customers,id,name',
        ],
        'partner_id' => [
            'label' => 'Partner',
            'type' => 'options-obj:mst_partners,id,name',
        ],
        'code' => [
            'label' => 'No. Order',
            'type' => 'text',
        ],
        'date' => [
            'label' => 'Tanggal Order',
            'type' => 'date',
        ],
        'done_date' => [
            'label' => 'Tanggal Selesai',
            'type' => 'date',
        ],
        'close_date' => [
            'label' => 'Tanggal Closing',
            'type' => 'date',
        ],
        'order_type' => [
            'label' => 'Tipe Order',
            'type' => 'options:BENGKEL|DOORSMEER',
        ],
        'customer_police_number' => [
            'label' => 'Nomor Polisi Kendaraan',
            'type' => 'text',
        ],
        'customer_vehicle_type' => [
            'label' => 'Jenis Kendaraan',
            'type' => 'text',
        ],
        'customer_vehicle_color' => [
            'label' => 'Warna Kendaraan',
            'type' => 'text',
        ],
        'total_item_value' => [
            'label' => 'Total Nilai Barang',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_service_value' => [
            'label' => 'Total Nilai Jasa',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_value' => [
            'label' => 'Total Nilai Order',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_payment' => [
            'label' => 'Total Pembayaran',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'description' => [
            'label' => 'Keterangan',
            'type' => 'textarea',
        ],
        'pic_url' => [
            'label' => 'Foto Order',
            'type' => 'text',
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:NEW|APPROVE|CANCEL',
        ],
        '_userstamp' => true,
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
        'order_id' => [
            'label' => 'Order',
            'type' => 'options-obj:trn_orders,id,code',
        ],
        'employee_id' => [
            'label' => 'Karyawan',
            'type' => 'options-obj:mst_employees,id,name',
        ],
        'code' => [
            'label' => 'No. Pengeluaran',
            'type' => 'text',
        ],
        'date' => [
            'label' => 'Tanggal Pengeluaran',
            'type' => 'date',
        ],
        'customer_police_number' => [
            'label' => 'Nomor Polisi Kendaraan',
            'type' => 'text',
        ],
        'total_value' => [
            'label' => 'Total Nilai Order',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_outgoing_items' => [
            'label' => 'Total Item Pengeluaran',
            'type' => 'number',
        ],
        'total_outgoing_qty' => [
            'label' => 'Total Kuantitas Pengeluaran',
            'type' => 'number',
        ],
        'total_outgoing_value' => [
            'label' => 'Total Nilai Pengeluaran',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'description' => [
            'label' => 'Keterangan',
            'type' => 'textarea',
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:NEW|APPROVE|CANCEL',
        ],
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
    'trn_cash' => [
        'bank_id' => [
            'label' => 'Bank',
            'type' => 'options-obj:mst_banks,id,name',
        ],
        'code' => [
            'label' => 'Kode Kas',
            'type' => 'text',
        ],
        'date' => [
            'label' => 'Tanggal Kas',
            'type' => 'date',
        ],
        'cash_group' => [
            'label' => 'Kelompok Kas',
            'type' => 'options:PENERIMAAN KAS|PENGELUARAN KAS|BIAYA KAS',
        ],
        'cash_type' => [
            'label' => 'Tipe Kas',
            'type' => 'options:PELUNASAN|DP / TANDA JADI',
        ],
        'cash_resource' => [
            'label' => 'Sumber Kas',
            'type' => 'options:CASH|TRANSFER|E-MONEY|BG (BILYET GIRO)',
        ],
        'reference_number' => [
            'label' => 'Nomor Referensi',
            'type' => 'text',
        ],
        'reference_date' => [
            'label' => 'Tanggal Referensi',
            'type' => 'date',
        ],
        'reference_name' => [
            'label' => 'Nama Referensi',
            'type' => 'text',
        ],
        'police_number_reference' => [
            'label' => 'Nomor Polisi Referensi',
            'type' => 'text',
        ],
        'total_value' => [
            'label' => 'Total Nilai',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'total_payment_before' => [
            'label' => 'Total Pembayaran Sebelumnya',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'cutoff' => [
            'label' => 'Potongan',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
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
        'total_payment' => [
            'label' => 'Total Pembayaran',
            'type' => 'number',
            'attr' => [
                'data-type' => 'currency',
                'class' => 'form-control',
                'required' => 'required',
                'min' => 1
            ]
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'options:NEW|APPROVE|CANCEL',
        ],
        'description' => [
            'label' => 'Keterangan',
            'type' => 'textarea',
        ],
        '_userstamp' => true,
    ]
];