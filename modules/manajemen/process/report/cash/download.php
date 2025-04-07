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

$search_fields = ['trn_cash.code', 'trn_cash.cash_resource', 'mst_banks.name', 'trn_cash.reference_number'];

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

$db->query = $query;
$data = $db->exec('all');

$filename = "cash-download-" . date('Y-m-d H:i:s') . ".xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$i = 1;
$fields = $db->getFields();
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
