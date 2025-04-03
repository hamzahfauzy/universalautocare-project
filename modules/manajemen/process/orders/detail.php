<?php

use Core\Database;
use Core\Page;

$tableName = 'trn_orders';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

$db->query = "SELECT COUNT(*) as `counter` FROM trn_orders WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$data = $db->single('trn_orders', ['id' => $_GET['id']]);

$code = $data->code;

$data_items = $db->all('trn_order_items', ['order_id' => $_GET['id']]);

$items = [];

foreach ($data_items as $index => $item) {
    $itm = $item->item_id ? $db->single('mst_items',['id' => $item->item_id]) : $db->single('mst_services', ['id' => $item->service_id]);
    $category = $db->single('mst_categories', ['id' => $itm->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $itm->name,
        'qty' => (double) $item->qty,
        'price' => (double) $item->price,
        'total_price' => (double) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'item' => $itm->id,
    ];
}

$customer = $db->single('mst_customers', ['id' => $data->customer_id]);

$data->customer = $customer;
$data->partner = $db->single('mst_partners', ['id' => $data->partner_id]);
$data->employee = $db->single('mst_employees', ['id' => $data->employee_id]);

// page section
$title = 'Detail Data Job Order ' . $data->order_type;
$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash'];
$order_type = $data->order_type;
Page::setActive('manajemen.' . $types[$order_type] . '_orders');
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_orders', 'order_type' => $order_type]),
        'title' => 'Data Job Order'
    ],
    [
        'title' => $title
    ]
]);

return view('manajemen/views/orders/detail', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items'));
