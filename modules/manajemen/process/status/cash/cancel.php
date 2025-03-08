<?php

use Core\Database;

$db = new Database;
$db->update('trn_cash', [
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

$payment = $db->single('trn_cash', ['id' => $_GET['id']]);

if($payment->cash_group != 'BIAYA KAS')
{
    $total_payment = $payment->total_payment;
    $reference_number = $payment->reference_number;
    $tbl = ['PENERIMAAN KAS' => 'trn_orders', 'PENGELUARAN KAS' => 'trn_purchases'];
    $db->query  = "Update ".$tbl[$payment->cash_group]."
    Set total_payment = Coalesce(A.total_payment, 0) - $total_payment
    Where code = $reference_number";

    $db->exec();
}

set_flash_msg(['success' => "Data berhasil dicancel"]);

header('location:' . routeTo('manajemen/status/cash', ['filter' => ['cash_group' => $payment->cash_group]]));
die();
