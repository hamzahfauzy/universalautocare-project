<?php

use Core\Database;
use Core\Page;
use Core\Request;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

if (isset($_GET['code'])) {

    $code = $_GET['code'];
    $order = $db->single('trn_orders', ['code' => $code]);
    $customer = $db->single('mst_customers', ['id' => $order->customer_id]);
    $order->customer = $customer;
    $employee = $db->single('mst_employees', ['id' => $order->employee_id]);
    $order->employee = $employee;
    $partner = $db->single('mst_partners', ['id' => $order->partner_id]);
    $order->partner = $partner;

    if ($_GET['filter']['type'] == 'invoice') {
        $items = $db->all('trn_order_items', ['order_id' => $order->id]);
        $order->items = $items;
        return view('manajemen/views/print/orders/invoice', compact('order', 'db'));
    } else if ($_GET['filter']['type'] == 'detail') {
        return view('manajemen/views/print/orders/detail', compact('order', 'db'));
    }
}

// page section
$title = 'Cetak ' . ($_GET['filter']['type'] == 'invoice' ? 'Invoice' : '') . ' Job Order ' . ucwords(strtolower($_GET['filter']['order_type']));
$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash', 'RENTAL' => 'rental'];
$order_type = $_GET['filter']['order_type'];
Page::setActive('manajemen.print.' . $types[$order_type] . '_' . $_GET['filter']['type']);
Page::setTitle($title);
Page::setModuleName($title);

$orders = $db->all('trn_orders', [
    'status' => 'APPROVE',
    'order_type' => $order_type
], [
    'id' => 'desc'
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script>$('.select2').select2()</script>");

return view('manajemen/views/print/orders/index', compact('error_msg', 'success_msg', 'old', 'orders'));
