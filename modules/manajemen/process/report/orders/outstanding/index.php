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
    $filterByDate  = Request::get('filterByDate', [
        'start_date' => date('Y-m-d'),
        'end_date' => date('Y-m-d'),
    ]);

    $search_fields = ['trn_orders.done_date', 'trn_orders.code', 'trn_orders.date', 'mst_customers.name', 'mst_employees.name', 'mst_partners.name'];
    $query = "SELECT 
                trn_orders.order_type, 
                trn_orders.code, 
                trn_orders.date,
                trn_orders.done_date,
                mst_customers.name customer_name,
                mst_employees.name employee_name,
                mst_partners.name partner_name,
                CONCAT('Rp. ',FORMAT(trn_orders.total_value,0)) total_value,
                CONCAT('Rp. ',FORMAT(Coalesce(trn_orders.total_payment, 0),0)) total_payment,
                CONCAT('Rp. ',FORMAT(trn_orders.total_value - Coalesce(trn_orders.total_payment, 0),0)) total_sisa,
                trn_orders.status
              FROM trn_orders
              LEFT JOIN mst_employees ON mst_employees.id = trn_orders.employee_id
              LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
              LEFT JOIN mst_partners ON mst_partners.id = trn_orders.partner_id
              ";

    $where = "WHERE (trn_orders.done_date >= NOW() AND trn_orders.total_value <> trn_orders.total_payment) AND (trn_orders.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

    $search = buildSearch($search_fields);
    $where .= ($search ? " AND " : "") . $search;

    $filter = buildFilter();
    $having = ($filter ? " HAVING " : "") . $filter;

    $query .= $where . $having;

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Outstanding Job Order';
Page::setActive("manajemen.report.orders.outstanding");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/orders/outstanding', compact('error_msg', 'old'));
