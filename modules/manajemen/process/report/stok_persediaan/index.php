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

    $search_fields = ['B.name', 'B.name', 'C.name', 'A.price', 'A.total_qty'];

    $where = "WHERE ((Coalesce(A.total_qty, 0) - Coalesce(A.outgoing_qty, 0)) > 0)";
    $search = buildSearch($search_fields);
    $where .= ($search ? " AND " : "") . $search;

    $filter = buildFilter();
    $having = ($filter ? " HAVING " : "") . $filter;

    $query = "SELECT 
                B.name category_name, 
                C.name item_name, 
                CONCAT(SUM(Coalesce(A.total_qty, 0) - Coalesce(A.outgoing_qty, 0)), ' ', C.unit) As jlh_stok, 
                FORMAT(A.price, 0) base_price, 
                FORMAT(A.price * SUM(Coalesce(A.total_qty, 0) - Coalesce(A.outgoing_qty, 0)),0) As total_persediaan 
            From trn_purchase_items A
	        Left Join mst_items C On A.item_id = C.id
	        Left Join mst_categories B On B.id = C.category_id 
            $where
            Group By B.name, A.item_id, C.name, A.price
            $having";

    return (new CrudRepository(''))->dataTableFromQuery($query);
}

// page section
$title = 'Laporan Stok Persediaan';
Page::setActive("manajemen.report.stok_persediaan");
Page::setTitle($title);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/reports.js') . "'></script>");

return view('manajemen/views/report/stok_persediaan/index', compact('error_msg', 'old'));
