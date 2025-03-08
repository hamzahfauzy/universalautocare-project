<?php

use Core\Database;
use Core\Page;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

$db->query = "Select A.id,
A.code As nopengeluaran, Date(A.date) As tglpengeluaran,
A.order_id, B.code As noorder, Date(B.date) As tglorder, D.name namacustomer, D.id idcustomer,
A.employee_id, C.name As namakaryawan, C.phone As telpkaryawan, 
A.total_outgoing_items, A.total_outgoing_qty, 
A.total_outgoing_value, A.status
From trn_outgoings A
Left Join trn_orders B On A.order_id = B.id 
Left Join mst_employees C On A.employee_id = C.id 
Left Join mst_customers D On B.customer_id = D.id 
Where A.status = 'APPROVE'
Order By A.date Desc, A.code Asc";

$data = $db->exec('all');

// page section
$title = 'Update Status Pengeluaran';
Page::setActive("manajemen.status.outgoings");
Page::setTitle($title);
Page::setModuleName($title);
Page::pushFoot("<script>$('.datatable').dataTable()</script>");

return view('manajemen/views/status/outgoings/index', compact('error_msg', 'success_msg', 'old', 'data'));
