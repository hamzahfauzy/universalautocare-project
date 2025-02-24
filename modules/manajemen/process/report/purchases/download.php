<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$order   = Request::get('order', [['column' => 1,'dir' => 'asc']]);
$filterByDate  = Request::get('filterByDate', [
    'start_date' => date('Y-m-d'),
    'end_date' => date('Y-m-d'),
]);

$search_fields = ['trn_purchases.code','trn_purchases.date','mst_suppliers.name','mst_employees.name','trn_purchases.total_value'];
$query = "SELECT 
            trn_purchases.code, 
            trn_purchases.date,
            mst_suppliers.name supplier_name,
            mst_employees.name employee_name,
            CONCAT(trn_purchases.total_item,' item / ', trn_purchases.total_qty, ' Qty') item,
            CONCAT('Rp. ',FORMAT(trn_purchases.total_value,0)) total,
            trn_purchases.status
            FROM trn_purchases
            LEFT JOIN mst_employees ON mst_employees.id = trn_purchases.employee_id
            LEFT JOIN mst_suppliers ON mst_suppliers.id = trn_purchases.supplier_id
            ";

$where = "WHERE (trn_purchases.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search ;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query .= $where . $having;

$db->query = $query;

$data = $db->exec('all');

$filename = "purchases-download-".date('Y-m-d H:i:s').".xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$i=1;
$fields = array_keys((array) $data[0]);
foreach($fields as $field)
{
    $sheet->setCellValue(chr($i+65).'1', $field);
    $i++;
}

foreach($data as $no => $d)
{
    $cell = $no + 2;
    $sheet->setCellValue('A'.$cell, $no+1);
    $i=1;
    foreach($fields as $field)
    {
        $sheet->setCellValue(chr($i+65).$cell, $d->{$field});
        $i++;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet, 'Xlsx');
$writer->save('php://output');

exit();