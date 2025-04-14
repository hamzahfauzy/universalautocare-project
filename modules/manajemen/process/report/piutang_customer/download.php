<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
unset($_GET['filter']['date']);

$search_fields = ['trn_orders.code', 'trn_orders.date', 'trn_orders.order_type', 'mst_customers.name', 'mst_employees.name', 'mst_partners.name', 'trn_orders.total_payment'];
$query = "SELECT 
                trn_orders.code,
                trn_orders.date,
                trn_orders.order_type,
                mst_customers.name customer_name,
                mst_employees.name employee_name,
                mst_partners.name partner_name,
                trn_orders.total_payment,
                trn_orders.total_value,
                trn_orders.total_value-COALESCE(total_payment,0) piutang,
                trn_orders.status
              FROM trn_orders
              LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
              LEFT JOIN mst_employees ON mst_employees.id = trn_orders.employee_id
              LEFT JOIN mst_partners ON mst_partners.id = trn_orders.partner_id
            ";

$search = buildSearch($search_fields);
$where = ($search ? " WHERE " : "") . $search;

$filter = buildFilter();
$having = "HAVING piutang > 0 " . ($filter ? " AND " : "") . $filter;

$query .= $where . $having;

$db->query = $query;
$data = $db->exec('all');

$filename = "piutang-customer-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
