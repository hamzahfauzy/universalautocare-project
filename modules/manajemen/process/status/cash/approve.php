<?php

use Core\Database;

$db = new Database;
$db->update('trn_cash', [
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);

$data = $db->single('trn_cash', ['id' => $_GET['id']]);
$paymentTable = $data->cash_group == 'PENERIMAAN KAS' ? 'trn_orders' : 'trn_purchases';
if(in_array($data->cash_group, ['PENERIMAAN KAS', 'PENGELUARAN KAS']))
{
    $db->update($paymentTable,[
        'total_payment' => $order->total_payment + $data->total_payment
    ], [
        'code' => $data->reference_number
    ]);
}

set_flash_msg(['success' => "Data berhasil diapprove"]);

header('location:' . routeTo('manajemen/status/cash', ['filter' => ['cash_group' => $data->cash_group]]));
die();
