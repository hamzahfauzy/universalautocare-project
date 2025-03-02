<?php

use Core\Database;

$db = new Database;
$db->update('trn_orders',[
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);


set_flash_msg(['success'=>"Data berhasil diapprove"]);

$order = $db->single('trn_orders',['id' => $_GET['id']]);
header('location:'.routeTo('crud/index',['table' => 'trn_orders', 'filter' => ['order_type' => $order->order_type]]));
die();