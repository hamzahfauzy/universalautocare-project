<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

if(isset($_GET['draw']))
{
    $order   = Request::get('order', [['column' => 1,'dir' => 'asc']]);
    $filterByDate  = Request::get('filterByDate', [
        'start_date' => date('Y-m-d'),
        'end_date' => date('Y-m-d'),
    ]);

    $search_fields = ['trn_outgoings.code','trn_outgoings.date','mst_customers.name','mst_employees.name','trn_outgoings.total_value'];
    $query = "SELECT 
                trn_outgoings.code, 
                trn_outgoings.date,
                trn_orders.code order_code,
                mst_customers.name customer_name,
                mst_employees.name employee_name,
                CONCAT(trn_outgoings.total_outgoing_items,' item / ', trn_outgoings.total_outgoing_qty, ' Qty') item,
                CONCAT('Rp. ',FORMAT(trn_outgoings.total_outgoing_value,0)) total,
                trn_outgoings.status
              FROM trn_outgoings
              LEFT JOIN trn_orders ON trn_orders.id = trn_outgoings.order_id
              LEFT JOIN mst_employees ON mst_employees.id = trn_outgoings.employee_id
              LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
              ";

    $where = "WHERE (trn_outgoings.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

    $search = buildSearch($search_fields);
    $where .= ($search ? " AND " : "") . $search ;

    $filter = buildFilter();
    $having = ($filter ? " HAVING " : "") . $filter;

    $query .= $where . $having;

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Pengeluaran';
Page::setActive("manajemen.report.outgoings");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/outgoings/index', compact('error_msg', 'old'));
