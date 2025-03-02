<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

if (isset($_GET['draw'])) {
    $order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
    unset($_GET['filter']['date']);

    $search_fields = ['trn_orders.code', 'trn_orders.date', 'trn_orders.order_type', 'mst_customers.name', 'mst_employees.name','mst_partners.name','trn_orders.total_payment'];
    $query = "SELECT 
                trn_orders.code,
                trn_orders.date,
                trn_orders.order_type,
                mst_customers.name customer_name,
                mst_employees.name employee_name,
                mst_partners.name partner_name,
                FORMAT(trn_orders.total_payment,0) total_payment,
                FORMAT(trn_orders.total_value,0) total_value,
                FORMAT(trn_orders.total_value-COALESCE(total_payment,0),0) piutang,
                trn_orders.status
              FROM trn_orders
              LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
              LEFT JOIN mst_employees ON mst_employees.id = trn_orders.employee_id
              LEFT JOIN mst_partners ON mst_partners.id = trn_orders.partner_id
              ";

    $search = buildSearch($search_fields);
    $where = ($search ? " WHERE " : "") . $search;

    $filter = buildFilter();
    $having = "HAVING piutang > 0 " . ($filter ? " AND " : "") . $filter;

    $query .= $where . $having;

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Piutang Customer';
Page::setActive("manajemen.report.piutang_customer");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/piutang_customer/index', compact('error_msg', 'old'));
