<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_orders', [
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Data berhasil dicancel"]);

header('location:' . routeTo('manajemen/status/orders', ['filter' => ['order_type' => $_GET['filter']['order_type']]]));
die();
