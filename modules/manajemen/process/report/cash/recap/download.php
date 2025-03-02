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

$search_fields = ['A.date'];

$where = "WHERE (DATE_FORMAT(A.date, '%Y-%m') = '$filterByDate[month]')";
$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query = "SELECT 
                A.date as tanggal, 
	            FORMAT(SUM(Coalesce(CASE WHEN A.cash_group = 'PENERIMAAN KAS' THEN A.cash_total ELSE 0 END, 0)), 0) As penerimaan, 
	            FORMAT(SUM(Coalesce(CASE WHEN A.cash_group = 'PENGELUARAN KAS' THEN A.cash_total ELSE 0 END, 0)), 0) As pengeluaran, 
	            FORMAT(SUM(Coalesce(CASE WHEN A.cash_group = 'BIAYA KAS' THEN A.cash_total ELSE 0 END, 0)), 0) As biaya,
                FORMAT(SUM(Coalesce(A.cash_total, 0)), 0) As cash_total
              From trn_cash A
              $where
              Group By A.date
	          $having";

$db->query = $query;

$data = $db->exec('all');

$filename = "cash-recap-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
