<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$order = null;

if (isset($_GET['code'])) {
    $order = $db->single('trn_orders', ['code' => $_GET['code']]);
    $order->items = $db->all('trn_order_items', ['order_id' => $order->id]);
    $order->customer = $db->single('mst_customers', ['id' => $order->customer_id]);
    $order->employee = $db->single('mst_employees', ['id' => $order->employee_id]);
    $order->partner = $db->single('mst_partners', ['id' => $order->partner_id]);
}

// page section
$title = 'Laporan Detail Job Order';
Page::setActive("manajemen.report.orders.detail");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/orders/detail', compact('error_msg', 'old', 'order', 'db'));
