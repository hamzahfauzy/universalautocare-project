<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
$filterByDate  = Request::get('filterByDate', [
    'start_date' => date('Y-m-d'),
    'end_date' => date('Y-m-d'),
]);

$search_fields = ['trn_purchases.code', 'trn_purchases.date', 'mst_suppliers.name', 'mst_categories.name', 'mst_items.name', 'trn_purchase_items.total_qty', 'trn_purchase_items.price', 'trn_purchase_items.total_price'];
$query = "SELECT 
                trn_purchases.code, 
                trn_purchases.date,
                mst_suppliers.name supplier_name,
                mst_categories.name category_name,
                mst_items.name product_name,
                CONCAT(trn_purchase_items.total_qty, ' ',trn_purchase_items.unit),
                CONCAT('Rp. ',FORMAT(trn_purchase_items.price,0)) price,
                CONCAT('Rp. ',FORMAT(trn_purchase_items.total_price,0)) total,
                trn_purchases.status
              FROM trn_purchases
              LEFT JOIN mst_suppliers ON mst_suppliers.id = trn_purchases.supplier_id
              LEFT JOIN trn_purchase_items ON trn_purchase_items.purchase_id = trn_purchases.id
              LEFT JOIN mst_items ON mst_items.id = trn_purchase_items.item_id
              LEFT JOIN mst_categories ON mst_categories.ID = mst_items.category_id
              ";

$where = "WHERE (trn_purchases.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query .= $where . $having;

$db->query = $query;

$data = $db->exec('all');

$filename = "purchases-detail-download-" . date('Y-m-d H:i:s') . ".xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$i = 1;
$fields = array_keys((array) $data[0]);
foreach ($fields as $field) {
    $sheet->setCellValue(chr($i + 65) . '1', $field);
    $i++;
}

foreach ($data as $no => $d) {
    $cell = $no + 2;
    $sheet->setCellValue('A' . $cell, $no + 1);
    $i = 1;
    foreach ($fields as $field) {
        $sheet->setCellValue(chr($i + 65) . $cell, $d->{$field});
        $i++;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet, 'Xlsx');
$writer->save('php://output');

exit();
