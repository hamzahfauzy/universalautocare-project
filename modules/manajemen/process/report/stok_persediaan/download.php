<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

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
            A.price base_price, 
            A.price * SUM(Coalesce(A.total_qty, 0) - Coalesce(A.outgoing_qty, 0)) As total_persediaan 
        From trn_purchase_items A
        Left Join mst_items C On A.item_id = C.id AND C.item_type = 1
        Left Join mst_categories B On B.id = C.category_id 
        $where
        Group By B.name, A.item_id, C.name, A.price
        $having";

$db->query = $query;

$data = $db->exec('all');

$filename = "stock-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
