<?php

use Core\Database;

$tableName = 'trn_orders';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

$db->query = "SELECT COUNT(*) as `counter` FROM trn_orders WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$data = $db->single('trn_orders', ['code' => $_GET['code']]);

$code = $data->code;

$data_items = $db->all('trn_order_items', ['order_id' => $data->id]);

$items = [];

foreach ($data_items as $index => $item) {
    $service = $db->single('mst_services', ['id' => $item->service_id]);
    $category = $db->single('mst_categories', ['id' => $service->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $service->name,
        'qty' => (double) $item->qty,
        'price' => (double) $item->price,
        'total_price' => (double) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'service' => $service->id,
    ];
}

$customer = $db->single('mst_customers', ['id' => $data->customer_id]);

$data->customer = $customer;
$data->partner = $db->single('mst_partners', ['id' => $data->partner_id]);
$data->employee = $db->single('mst_employees', ['id' => $data->employee_id]);

return view('manajemen/views/print/orders/struk', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items'));
