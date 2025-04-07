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

$search_fields = ['trn_outgoings.code','trn_outgoings.date','mst_customers.name','mst_employees.name','trn_outgoings.total_value'];
$query = "SELECT 
            trn_outgoings.code, 
            trn_outgoings.date,
            trn_orders.code order_code,
            mst_customers.name customer_name,
            mst_employees.name employee_name,
            CONCAT(trn_outgoings.total_outgoing_items,' item / ', trn_outgoings.total_outgoing_qty, ' Qty') item,
            CONCAT('Rp. ',FORMAT(trn_outgoings.total_outgoing_value,0)) total,
            trn_outgoings.status
            FROM trn_outgoings
            LEFT JOIN trn_orders ON trn_orders.id = trn_outgoings.order_id
            LEFT JOIN mst_employees ON mst_employees.id = trn_outgoings.employee_id
            LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
            ";

$where = "WHERE (trn_outgoings.date BETWEEN '$filterByDate[start_date]' AND '$filterByDate[end_date]')";

$search = buildSearch($search_fields);
$where .= ($search ? " AND " : "") . $search ;

$filter = buildFilter();
$having = ($filter ? " HAVING " : "") . $filter;

$query .= $where . $having;

$db->query = $query;
$data = $db->exec('all');

$filename = "outgoings-download-".date('Y-m-d H:i:s').".xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$i=1;
$fields = $db->getFields();
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