<?php

use Core\Database;
use Core\Page;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

$order_type = $_GET['filter']['order_type'];
$db->query = "Select A.id, A.code As noorder, Date(A.date) As tglorder, 
A.employee_id, B.name As namakaryawan, B.phone As telpkaryawan, 
A.customer_id, C.name As namacustomer, C.phone As telpcustomer, 
A.partner_id, D.name As namapartner, 
Date(A.done_date) As tglestselesai, A.order_type, 
A.customer_police_number, A.customer_vehicle_type,
A.customer_vehicle_color, A.total_value, A.total_item_value, A.total_service_value,
Coalesce(A.total_payment, 0) As totalbayar, 
Count(E.order_id) As totalbarang,
A.status 
From trn_orders A 
Left Join mst_employees B On A.employee_id = B.id 
Left Join mst_customers C On A.customer_id = C.id 
Left Join mst_partners D On A.partner_id = D.id 
Left Join trn_outgoings E On A.id = E.order_id And E.status <> 'CANCEL'
Where A.status = 'APPROVE' 
And A.order_type = '$order_type'
Group By A.id, A.code, Date(A.date), A.employee_id, B.name, B.phone, 
A.customer_id, C.name, C.phone, A.partner_id, D.name, 
Date(A.done_date), A.order_type, A.customer_police_number, 
A.customer_vehicle_type, A.customer_vehicle_color, A.total_value,
Coalesce(A.total_payment, 0), A.status  
Order By A.date Desc, A.code Asc";

$data = $db->exec('all');

// page section
$title = 'Update Status Job Order ' . ucwords(strtolower($order_type));
$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash'];
Page::setActive('manajemen.status.' . $types[$order_type] . '_orders');
Page::setTitle($title);
Page::setModuleName($title);
Page::pushFoot("<script>$('.datatable').dataTable({
    ordering: false
})</script>");

return view('manajemen/views/status/orders/index', compact('error_msg', 'success_msg', 'old', 'data'));
