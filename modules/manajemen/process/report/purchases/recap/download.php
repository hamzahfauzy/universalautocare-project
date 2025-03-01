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
    'month' => date('Y-m'),
]);

$search_fields = ['A.code', 'A.date', 'A.total_qty', 'A.status'];

$where = "WHERE (DATE_FORMAT(A.date, '%Y-%m') = '$filterByDate[month]')";
$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query = "SELECT 
    A.date as tanggal, 
    Count(A.code) As jlh_pembelian, 
    CONCAT(SUM(Coalesce(A.total_item, 0)), ' Item(s)') As jlh_items, 
    CONCAT(SUM(Coalesce(A.total_qty, 0)), ' QTY') As jlh_qty, 
    FORMAT(SUM(Coalesce(A.total_value, 0)), 0) As total_pembelian,
    A.status
From trn_purchases A
$where
Group By A.date, A.status
$having ";

$db->query = $query;

$data = $db->exec('all');

$filename = "purchases-recap-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
