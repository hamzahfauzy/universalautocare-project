<?php

use Core\Database;
use Core\Page;
use Core\Request;

$tableName = 'trn_purchases';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

$data = $db->single('trn_purchases', ['id' => $_GET['id']]);

$data->supplier = $db->single('mst_suppliers', ['id' => $data->supplier_id]);
$data->employee = $db->single('mst_employees', ['id' => $data->employee_id]);

$code = $data->code;

$data_items = $db->all('trn_purchase_items', ['purchase_id' => $_GET['id']]);

$items = [];

foreach ($data_items as $index => $item) {
    $product = $db->single('mst_items', ['id' => $item->item_id]);
    $category = $db->single('mst_categories', ['id' => $product->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $product->name,
        'qty' => (double) $item->total_qty,
        'price' => (double) $item->price,
        'total_price' => (double) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'product' => $product->id,
    ];
}

// page section
$title = 'Detail Pembelian';
Page::setActive("manajemen.trn_purchases");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_purchases']),
        'title' => 'Data Pembelian'
    ],
    [
        'title' => $title
    ]
]);

return view('manajemen/views/purchases/detail', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items'));
