<?php

return [
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
            ]
        ]
    ],
    [
        'label' => 'manajemen.menu.payment_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cash-register',
        'activeState' => [
            'manajemen.trn_cash',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.cash_income',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'PENERIMAAN KAS']]),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.cash_outcome',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'PENGELUARAN KAS']]),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.cash_cost',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash', 'filter' => ['cash_group' => 'BIAYA KAS']]),
                'activeState' => 'manajemen.trn_cash'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.update_status',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-pen-square',
        'activeState' => [
            'manajemen.trn_cash',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.purchases',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.outgoings',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.workshop',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.carwash',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.cash_income',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.cash_outcome',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.cash_cost',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.print',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-print',
        'activeState' => [
            'manajemen.trn_cash',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.workshop_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.workshop_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.carwash_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.carwash_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
        ]
    ],
    [
        'label' => 'manajemen.menu.report',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-scroll',
        'activeState' => [
            'manajemen.trn_cash',
        ],
        'items' => [
            [
                'label' => 'manajemen.menu.workshop_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.workshop_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.carwash_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
            [
                'label' => 'manajemen.menu.carwash_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index', ['table' => 'trn_cash']),
                'activeState' => 'manajemen.trn_cash'
            ],
        ]
    ],
];
