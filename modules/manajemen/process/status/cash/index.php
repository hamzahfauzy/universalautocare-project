<?php

use Core\Database;
use Core\Page;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

$cash_group = $_GET['filter']['cash_group'];
if($cash_group == 'PENERIMAAN KAS')
{
    $db->query = "Select A.id, A.code As noterimakas, Date(A.date) As tglterimakas, 
    A.cash_type, A.cash_resource, A.reference_number, 
    Date(A.reference_date) As reference_date,  
    A.reference_name, A.police_number_reference, A.total_value,
    A.discount, A.cash_total, A.total_payment, A.status, 
    A.description, mst_banks.name namabank
    From trn_cash A
    LEFT JOIN mst_banks ON mst_banks.id = A.bank_id
    Where A.cash_group = 'PENERIMAAN KAS'
    And A.status = 'APPROVE'
    Order By A.date Desc, A.code Asc";
}

if($cash_group == 'PENGELUARAN KAS')
{
    $db->query = "Select A.id, A.code As nobpk, Date(A.date) As tglbpk, 
A.cash_type, A.cash_resource, A.reference_number, 
Date(A.reference_date) As reference_date,  
A.reference_name, A.police_number_reference, A.total_value,
A.discount, A.cash_total, A.total_payment, A.status, 
A.description, mst_banks.name namabank
From trn_cash A
LEFT JOIN mst_banks ON mst_banks.id = A.bank_id
Where A.cash_group = 'PENGELUARAN KAS'
And A.status = 'APPROVE'
Order By A.date Desc, A.code Asc";
}

if($cash_group == 'BIAYA KAS')
{
    $db->query = "Select A.id, A.code As nobiaya, Date(A.date) As tglbiaya, 
A.cash_type, A.cash_resource, A.reference_number, 
A.discount, A.cash_total, A.total_payment, A.status, 
A.description, mst_banks.name namabank
From trn_cash A
LEFT JOIN mst_banks ON mst_banks.id = A.bank_id
Where A.cash_group = 'BIAYA KAS'
Order By A.date Desc, A.code Asc";
}

$data = $db->exec('all');

// page section
$title = 'Update Status Job Order ' . ucwords(strtolower($cash_group));
$types = ['PENERIMAAN KAS' => 'cash_income', 'PENGELUARAN KAS' => 'cash_outcome', 'BIAYA KAS' => 'cash_cost'];
Page::setActive('manajemen.status.' . $types[$cash_group]);
Page::setTitle($title);
Page::setModuleName($title);
Page::pushFoot("<script>$('.datatable').dataTable({
    ordering: false
})</script>");

return view('manajemen/views/status/cash/index', compact('error_msg', 'success_msg', 'old', 'data'));
