<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_orders',[
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil dicancel"]);

$order = $db->single('trn_orders',['id' => $_GET['id']]);
header('location:'.routeTo('crud/index',['table' => 'trn_orders', 'filter' => ['order_type' => $order->order_type]]));
die();