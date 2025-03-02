<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

if (isset($_GET['draw'])) {
    unset($_GET['filter']['date']);
    $order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
    $filterByDate  = Request::get('filterByDate', [
        'start_date' => date('Y-m-d'),
        'end_date' => date('Y-m-d'),
    ]);

    $search_fields = ['trn_purchases.code', 'trn_purchases.date', 'mst_suppliers.name', 'mst_employees.name','mst_partners.name','trn_purchases.total_payment'];
    $query = "SELECT 
                trn_purchases.code,
                trn_purchases.date,
                mst_suppliers.name supplier_name,
                mst_employees.name employee_name,
                FORMAT(trn_purchases.total_payment,0) total_payment,
                FORMAT(trn_purchases.total_value,0) total_value,
                FORMAT(trn_purchases.total_value-COALESCE(total_payment,0),0) hutang,
                trn_purchases.status
              FROM trn_purchases
              LEFT JOIN mst_suppliers ON mst_suppliers.id = trn_purchases.supplier_id
              LEFT JOIN mst_employees ON mst_employees.id = trn_purchases.employee_id
              ";

    $search = buildSearch($search_fields);
    $where = ($search ? " WHERE " : "") . $search;

    $filter = buildFilter();
    $having = "HAVING hutang > 0 " . ($filter ? " AND " : "") . $filter;

    $query .= $where . $having;

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Hutang Supplier';
Page::setActive("manajemen.report.hutang_supplier");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/hutang_supplier/index', compact('error_msg', 'old'));
