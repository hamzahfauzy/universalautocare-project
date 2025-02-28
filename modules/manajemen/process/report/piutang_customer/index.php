<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

if (isset($_GET['draw'])) {
    return;
    $order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
    $filterByDate  = Request::get('filterByDate', [
        'start_date' => date('Y-m-d'),
        'end_date' => date('Y-m-d'),
    ]);

    $search_fields = ['trn_cash.cash_group', 'trn_cash.code', 'trn_cash.cash_resource', 'mst_banks.name', 'trn_cash.reference_number'];
    $query = "SELECT 
                trn_cash.cash_group, 
                trn_cash.code, 
                trn_cash.date,
                trn_cash.cash_type, 
                trn_cash.cash_resource, 
                mst_banks.name bank_name,
                trn_cash.reference_number,
                CONCAT('Rp. ',FORMAT(trn_cash.discount,0)) discount,
                CONCAT('Rp. ',FORMAT(trn_cash.cash_total,0)) cash_total,
                CONCAT('Rp. ',FORMAT(trn_cash.total_payment,0)) total_payment,
                trn_cash.status
              FROM trn_cash
              LEFT JOIN mst_banks ON mst_banks.id = trn_cash.bank_id
              ";

    $where = "WHERE (trn_cash.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

    $search = buildSearch($search_fields);
    $where .= ($search ? " AND " : "") . $search;

    $filter = buildFilter();
    $having = ($filter ? " HAVING " : "") . $filter;

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
