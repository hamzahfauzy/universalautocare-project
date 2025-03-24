<?php

use Core\Database;
use Core\Page;
use Core\Request;

$tableName = 'trn_outgoings';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

$data = $db->single('trn_outgoings', ['id' => $_GET['id']]);

$code = $data->code;

$data_items = $db->all('trn_outgoing_items', ['outgoing_id' => $_GET['id']]);

$order = $db->single('trn_orders', ['id' => $data->order_id]);
$employee = $db->single('mst_employees', ['id' => $data->employee_id]);
$customer = $db->single('mst_customers', ['id' => $order->customer_id]);

$items = [];

foreach ($data_items as $index => $item) {
    $product = $db->single('mst_items', ['id' => $item->item_id]);
    $purchase = $item->purchase_id ? $db->single('trn_purchases', ['id' => $item->purchase_id]) : null;
    $category = $db->single('mst_categories', ['id' => $product->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $product->name,
        'code' => $purchase?->code,
        'qty' => (double) $item->outgoing_qty,
        'price' => (double) $item->price,
        'total_price' => (double) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'product' => $product->id,
        'purchase' => $purchase?->id,
    ];
}

// page section
$title = 'Detail Pengeluaran';
Page::setActive("manajemen.trn_outgoings");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_outgoings']),
        'title' => 'Data Pengeluaran'
    ],
    [
        'title' => $title
    ]
]);

return view('manajemen/views/outgoings/detail', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items', 'customer', 'order', 'employee'));
