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
    'month' => date('Y-m')
]);

$search_fields = ['A.code', 'A.date', 'A.total_outgoing_qty', 'A.total_outgoing_value','A.status'];

$where = "WHERE (DATE_FORMAT(A.date, '%Y-%m') = '$filterByDate[month]')";
$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query = "SELECT 
    A.date, 
    Count(A.code) As jlh_pengeluaran, 
    CONCAT(SUM(Coalesce(A.total_outgoing_items, 0)), ' Item(s)') As jlh_items, 
    CONCAT(SUM(Coalesce(A.total_outgoing_qty, 0)), ' QTY') As jlh_qty, 
    FORMAT(SUM(Coalesce(A.total_outgoing_value, 0)), 0) As total_pengeluaran,
    A.status
From trn_outgoings A
$where 
Group By A.date, A.status
$having";

$db->query = $query;

$data = $db->exec('all');

$filename = "outgoings-recap-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
