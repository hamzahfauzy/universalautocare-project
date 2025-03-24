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
        'month' => date('Y-m'),
    ]);

    $search_fields = ['A.date'];

    $status = isset($_GET['filter']['status']) ? $_GET['filter']['status'] : '';
    unset($_GET['filter']['status']);

    $where = "WHERE (DATE_FORMAT(A.date, '%Y-%m') = '$filterByDate[month]')";
    $search = buildSearch($search_fields);
    $where .= ($search ? " AND " : "") . $search;
    $where .= $status ? " AND status = '$status'" : '';

    $filter = buildFilter();
    $having = ($filter ? " HAVING " : "") . $filter;

    $query = "SELECT tanggal, FORMAT(penerimaan, 0) penerimaan, 
                    FORMAT(pengeluaran,0) pengeluaran,
                    FORMAT(biaya, 0) biaya, 
                    FORMAT(SUM(penerimaan-(pengeluaran+biaya)),0) as cash_total
                FROM (SELECT 
                A.date as tanggal, 
	            SUM(Coalesce(CASE WHEN A.cash_group = 'PENERIMAAN KAS' THEN A.cash_total ELSE 0 END, 0)) As penerimaan, 
	            SUM(Coalesce(CASE WHEN A.cash_group = 'PENGELUARAN KAS' THEN A.cash_total ELSE 0 END, 0)) As pengeluaran, 
	            SUM(Coalesce(CASE WHEN A.cash_group = 'BIAYA KAS' THEN A.cash_total ELSE 0 END, 0)) As biaya
              From trn_cash A
              $where
              Group By A.date
	          $having) as cash GROUP BY tanggal";

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Rekap Kas';
Page::setActive("manajemen.report.cash.recap");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/cash/recap', compact('error_msg', 'old'));
