<?php

use Core\Database;

$db = new Database;
$db->update('trn_cash', [
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

$payment = $db->single('trn_cash', ['id' => $_GET['id']]);
$paymentTable = $payment->cash_group == 'PENERIMAAN KAS' ? 'trn_orders' : 'trn_purchases';
if(in_array($payment->cash_group, ['PENERIMAAN KAS', 'PENGELUARAN KAS']))
{
    $paymentData = $db->single($paymentTable, ['code' => $data->reference_number]);
    $db->update($paymentTable,[
        'total_payment' => $paymentData->total_payment - $payment->total_payment
    ], [
        'code' => $payment->reference_number
    ]);
}

set_flash_msg(['success' => "Data berhasil dicancel"]);

header('location:' . routeTo('manajemen/status/cash', ['filter' => ['cash_group' => $payment->cash_group]]));
die();
