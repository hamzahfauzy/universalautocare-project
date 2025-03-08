<?php

use Core\Database;
use Core\Page;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

$db->query = "Select A.id, A.code As nopembelian, A.`date` As tglpembelian, 
A.supplier_id, B.name As namasupplier, B.phone As telpsupplier, 
A.employee_id, C.name As namakaryawan, C.phone As telpkaryawan, 
A.total_item, A.total_qty, A.total_value,
Coalesce(A.total_payment, 0) As totalbayar, 
SUM(Coalesce(D.outgoing_qty, 0)) As totalpengeluaran,
A.status
From trn_purchases A
Left Join mst_suppliers B On A.supplier_id = B.id 
Left Join mst_employees C On A.employee_id = C.id 
Left Join trn_purchase_items D On A.id = D.purchase_id 
Where A.status = 'APPROVE'
Group By A.id, A.code, A.`date`, A.supplier_id, B.name, B.phone, 
A.employee_id, C.name, C.phone, A.total_item, A.total_qty, 
A.total_value, Coalesce(A.total_payment, 0), A.status
Order By A.date Desc, A.code Asc";
$data = $db->exec('all');

// page section
$title = 'Update Status Pembelian';
Page::setActive("manajemen.status.purchases");
Page::setTitle($title);
Page::setModuleName($title);
Page::pushFoot("<script>$('.datatable').dataTable()</script>");

return view('manajemen/views/status/purchases/index', compact('error_msg', 'success_msg', 'old', 'data'));
