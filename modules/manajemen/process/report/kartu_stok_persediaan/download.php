<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$filter = Request::get('filter', []);
$order   = Request::get('order', [['column' => 1, 'dir' => 'asc']]);
$filterByDate  = Request::get('filterByDate', [
    'start_date' => date('Y-m-d'),
    'end_date' => date('Y-m-d'),
]);

$id = $filter['item'] ?? 0;
$dariTgl = $filterByDate['start_date'];
$sampaiTgl = $filterByDate['end_date'];

$search_fields = ['trn_purchases.code', 'trn_purchases.date', 'mst_suppliers.name', 'mst_employees.name','mst_partners.name','trn_purchases.total_payment'];
$query = "Select Tampil.TglDokumen, Tampil.Jenis, Tampil.NoDokumen, Tampil.Keterangan, Tampil.StokPenerimaan, Tampil.StokPengeluaran, SUM(Tampil.StokPenerimaan - Tampil.StokPengeluaran) OVER (ORDER BY Tampil.TglDokumen, Tampil.NoDokumen ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS Stok 
From 
(
	Select 0 As Nomor, 'SALDOAWAL' As Jenis, Concat(Result.KodeProduk, ' - ', Result.NamaProduk) As NoDokumen, 
		'$dariTgl' As TglDokumen, Result.Satuan As Keterangan, 
		SUM(Result.JlhQty) As StokPenerimaan, 0 As StokPengeluaran 
	From 
		(
		Select F.id As KodeProduk, F.name As NamaProduk, F.unit As Satuan, 0 As JlhQty, 0 As IdTransaksi  
		From mst_items F Where F.id = $id
		
		Union
		
		Select Z.id As KodeProduk, Z.name As NamaProduk, Z.unit As Satuan, 
			SUM(Case When Y.total_qty Is Null Then 0 Else Y.total_qty End) As JlhQty, X.Code As IdTransaksi  
		From trn_purchases X
			Inner Join trn_purchase_items Y On X.id = Y.purchase_id 
			Left Join mst_items Z On Y.item_id = Z.id
		Where X.date < '$dariTgl' And X.status = 'APPROVE' 
			And Y.item_id = $id 
		Group By Z.id, Z.name, Z.unit, X.Code  

		Union 

		Select C.id As KodeProduk, C.name As NamaProduk, C.unit As Satuan, 
			SUM(Case When -B.outgoing_qty Is Null Then 0 Else -B.outgoing_qty End) As JlhQty, A.Code As IdTransaksi 
		From trn_outgoings A
			Inner Join trn_outgoing_items B On A.id = B.outgoing_id  
			Left Join mst_items C On B.item_id = C.id
		Where A.date < '$dariTgl' And A.status = 'APPROVE'
			And B.item_id = $id 
		Group By C.id, C.name, C.unit, A.Code  

	) Result 
	
	Group By Result.KodeProduk, Result.NamaProduk, Result.Satuan 
		
	Union 

	Select 1 As Nomor, 'PEMBELIAN' As Jenis, A.code As NoDokumen, A.date As TglDokumen, 
		Concat(C.name, ' - ', C.phone) As Keterangan, SUM(B.total_qty) As StokPenerimaan, 0 As StokPengeluaran 
	From trn_purchases A
		Inner Join trn_purchase_items B On A.id = B.purchase_id 
		Left Join mst_suppliers C On A.supplier_id = C.id 
	Where A.date >= '$dariTgl' And A.date <= '$sampaiTgl' 
		And A.status = 'APPROVE' And B.item_id = $id  
	Group By A.code, A.date, Concat(C.name, ' - ', C.phone)  

	Union

	Select 2 As Nomor, 'PENGELUARAN' As Jenis, A.code As NoDokumen, A.date As TglDokumen, 
		Concat(C.Code, ' / ', D.name, ' - ', D.phone) As Keterangan, 0 As StokPenerimaan, SUM(B.outgoing_qty) As StokPengeluaran
	From trn_outgoings A
		Inner Join trn_outgoing_items B On A.id = B.outgoing_id 
		Left Join trn_orders C On A.order_id = C.id And C.status = 'APPROVE' 
		Left Join mst_customers D On C.customer_id = D.id 
	Where A.date >= '$dariTgl' And A.date <= '$sampaiTgl' 
		And A.status = 'APPROVE' And B.item_id = $id  
	Group By A.code, A.date, Concat(C.Code, ' / ', D.name, ' - ', D.phone)    
		
) Tampil 
Order By Tampil.TglDokumen, Tampil.Nomor, Tampil.NoDokumen";

$db->query = $query;

$data = $db->exec('all');

$filename = "kartu-stok-download-" . date('Y-m-d H:i:s') . ".xlsx";

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
