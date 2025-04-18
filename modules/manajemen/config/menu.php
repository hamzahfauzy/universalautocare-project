<?php

return [
    [
        'label' => 'manajemen.menu.dashboard',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-dashboard',
        'route' => routeTo('manajemen/dashboard/index'),
        'activeState' => 'manajemen.dashboard'
    ],
    [
        'label' => 'manajemen.menu.master',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cube',
        'activeState' => [
            'manajemen.mst_employees',
            'manajemen.mst_customers',
            'manajemen.mst_suppliers',
            'manajemen.mst_partners',
            'manajemen.mst_banks',
            'manajemen.mst_costs',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.employees',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-people-carry',
                'route' => routeTo('crud/index', ['table' => 'mst_employees']),
                'activeState' => 'manajemen.mst_employees'
            ],
            [
                'label' => 'manajemen.menu.customers',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-users',
                'route' => routeTo('crud/index', ['table' => 'mst_customers']),
                'activeState' => 'manajemen.mst_customers'
            ],
            [
                'label' => 'manajemen.menu.suppliers',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-people-carry',
                'route' => routeTo('crud/index', ['table' => 'mst_suppliers']),
                'activeState' => 'manajemen.mst_suppliers'
            ],
            [
                'label' => 'manajemen.menu.partners',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index', ['table' => 'mst_partners']),
                'activeState' => 'manajemen.mst_partners'
            ],
            [
                'label' => 'manajemen.menu.banks',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-box-open',
                'route' => routeTo('crud/index', ['table' => 'mst_banks']),
                'activeState' => 'manajemen.mst_banks'
            ],
            [
                'label' => 'manajemen.menu.costs',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-box-open',
                'route' => routeTo('crud/index', ['table' => 'mst_costs']),
                'activeState' => 'manajemen.mst_costs'
            ],

        ]
    ],
    [
        'label' => 'manajemen.menu.product_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
        'activeState' => [
            'manajemen.mst_categories',
            'manajemen.mst_items',
            'manajemen.mst_services',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.categories',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'mst_categories']),
                'activeState' => 'manajemen.mst_categories'
            ],
            [
                'label' => 'manajemen.menu.items',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index', ['table' => 'mst_items']),
                'activeState' => 'manajemen.mst_items'
            ],
            [
                'label' => 'manajemen.menu.services',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('crud/index', ['table' => 'mst_services']),
                'activeState' => 'manajemen.mst_services'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.transaction_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-receipt',
        'activeState' => [
            'manajemen.trn_purchases',
            'manajemen.trn_outgoings'
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.purchases',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_purchases']),
                'activeState' => 'manajemen.trn_purchases'
            ],
            [
                'label' => 'manajemen.menu.outgoings',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index', ['table' => 'trn_outgoings']),
                'activeState' => 'manajemen.trn_outgoings'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.job_order_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-list-check',
        'activeState' => [
            'manajemen.workshop_orders',
            'manajemen.carwash_orders',
            'manajemen.rental_orders',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.workshop',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => 'BENGKEL']]),
                'activeState' => 'manajemen.workshop_orders'
            ],
            [
                'label' => 'manajemen.menu.carwash',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => 'DOORSMEER']]),
                'activeState' => 'manajemen.carwash_orders'
            ],
            [
                'label' => 'manajemen.menu.rental',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => 'RENTAL']]),
                'activeState' => 'manajemen.rental_orders'
            ]
        ]
    ],
    [
        'label' => 'manajemen.menu.payment_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cash-register',
        'activeState' => [
            'manajemen.cash_income',
            'manajemen.cash_outcome',
            'manajemen.cash_cost',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.cash_income',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'PENERIMAAN KAS']]),
                'activeState' => 'manajemen.cash_income'
            ],
            [
                'label' => 'manajemen.menu.cash_outcome',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'PENGELUARAN KAS']]),
                'activeState' => 'manajemen.cash_outcome'
            ],
            [
                'label' => 'manajemen.menu.cash_cost',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'BIAYA KAS']]),
                'activeState' => 'manajemen.cash_cost'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.update_status',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-pen-square',
        'activeState' => [
            'manajemen.status.purchases',
            'manajemen.status.outgoings',
            'manajemen.status.workshop_orders',
            'manajemen.status.carwash_orders',
            'manajemen.status.rental_orders',
            'manajemen.status.cash_income',
            'manajemen.status.cash_outcome',
            'manajemen.status.cash_cost',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.purchases',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/purchases'),
                'activeState' => 'manajemen.status.purchases'
            ],
            [
                'label' => 'manajemen.menu.outgoings',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/outgoings'),
                'activeState' => 'manajemen.status.outgoings'
            ],
            [
                'label' => 'manajemen.menu.workshop',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/orders', ['filter' => ['order_type' => 'BENGKEL']]),
                'activeState' => 'manajemen.status.workshop_orders'
            ],
            [
                'label' => 'manajemen.menu.carwash',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/orders', ['filter' => ['order_type' => 'DOORSMEER']]),
                'activeState' => 'manajemen.status.carwash_orders'
            ],
            [
                'label' => 'manajemen.menu.rental',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/orders', ['filter' => ['order_type' => 'RENTAL']]),
                'activeState' => 'manajemen.status.rental_orders'
            ],
            [
                'label' => 'manajemen.menu.cash_income',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/cash', ['filter' => ['cash_group' => 'PENERIMAAN KAS']]),
                'activeState' => 'manajemen.status.cash_income'
            ],
            [
                'label' => 'manajemen.menu.cash_outcome',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/cash', ['filter' => ['cash_group' => 'PENGELUARAN KAS']]),
                'activeState' => 'manajemen.status.cash_outcome'
            ],
            [
                'label' => 'manajemen.menu.cash_cost',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/status/cash', ['filter' => ['cash_group' => 'BIAYA KAS']]),
                'activeState' => 'manajemen.status.cash_cost'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.print',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-print',
        'activeState' => [
            'manajemen.print.workshop_detail',
            'manajemen.print.workshop_invoice',
            'manajemen.print.carwash_detail',
            'manajemen.print.carwash_invoice',
            'manajemen.print.rental_detail',
            'manajemen.print.rental_invoice'
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.workshop_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'BENGKEL', 'type' => 'detail']]),
                'activeState' => 'manajemen.print.workshop_detail'
            ],
            [
                'label' => 'manajemen.menu.workshop_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'BENGKEL', 'type' => 'invoice']]),
                'activeState' => 'manajemen.print.workshop_invoice'
            ],
            [
                'label' => 'manajemen.menu.carwash_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'DOORSMEER', 'type' => 'detail']]),
                'activeState' => 'manajemen.print.carwash_detail'
            ],
            [
                'label' => 'manajemen.menu.carwash_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'DOORSMEER', 'type' => 'invoice']]),
                'activeState' => 'manajemen.print.carwash_invoice'
            ],
            [
                'label' => 'manajemen.menu.rental_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'RENTAL', 'type' => 'detail']]),
                'activeState' => 'manajemen.print.rental_detail'
            ],
            [
                'label' => 'manajemen.menu.rental_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/print/orders', ['filter' => ['order_type' => 'RENTAL', 'type' => 'invoice']]),
                'activeState' => 'manajemen.print.rental_invoice'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.report',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-scroll',
        'activeState' => [
            'manajemen.report.purchases',
            'manajemen.report.outgoings',
            'manajemen.report.orders',
            'manajemen.report.purchases.detail',
            'manajemen.report.purchases.recap',
            'manajemen.report.outgoings.detail',
            'manajemen.report.outgoings.recap',
            'manajemen.report.orders.detail',
            'manajemen.report.orders.outstanding',
            'manajemen.report.stok_persediaan',
            'manajemen.report.kartu_stok_persediaan',
            'manajemen.report.cash',
            'manajemen.report.cash.recap',
            'manajemen.report.piutang_customer',
            'manajemen.report.hutang_supplier',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.purchases',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/purchases'),
                'activeState' => 'manajemen.report.purchases'
            ],
            [
                'label' => 'manajemen.menu.purchases_detail',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/purchases/detail'),
                'activeState' => 'manajemen.report.purchases.detail'
            ],
            [
                'label' => 'manajemen.menu.purchases_recap',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/purchases/recap'),
                'activeState' => 'manajemen.report.purchases.recap'
            ],
            [
                'label' => 'manajemen.menu.outgoings',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/outgoings'),
                'activeState' => 'manajemen.report.outgoings'
            ],
            [
                'label' => 'manajemen.menu.outgoings_detail',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/outgoings/detail'),
                'activeState' => 'manajemen.report.outgoings.detail'
            ],
            [
                'label' => 'manajemen.menu.outgoings_recap',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/outgoings/recap'),
                'activeState' => 'manajemen.report.outgoings.recap'
            ],
            [
                'label' => 'manajemen.menu.stok_persediaan',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/stok_persediaan'),
                'activeState' => 'manajemen.report.stok_persediaan'
            ],
            [
                'label' => 'manajemen.menu.kartu_stok_persediaan',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/kartu_stok_persediaan'),
                'activeState' => 'manajemen.report.kartu_stok_persediaan'
            ],
            [
                'label' => 'manajemen.menu.orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/orders'),
                'activeState' => 'manajemen.report.orders'
            ],
            [
                'label' => 'manajemen.menu.orders_detail',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/orders/detail'),
                'activeState' => 'manajemen.report.orders.detail'
            ],
            [
                'label' => 'manajemen.menu.orders_outstanding',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/orders/outstanding'),
                'activeState' => 'manajemen.report.orders.outstanding'
            ],
            [
                'label' => 'manajemen.menu.cash_payment',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/cash'),
                'activeState' => 'manajemen.report.cash'
            ],
            [
                'label' => 'manajemen.menu.cash_recap',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/cash/recap'),
                'activeState' => 'manajemen.report.cash.recap'
            ],
            [
                'label' => 'manajemen.menu.piutang_customer',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/piutang_customer'),
                'activeState' => 'manajemen.report.piutang_customer'
            ],
            [
                'label' => 'manajemen.menu.hutang_supplier',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('manajemen/report/hutang_supplier'),
                'activeState' => 'manajemen.report.hutang_supplier'
            ],
        ]
    ],
];
