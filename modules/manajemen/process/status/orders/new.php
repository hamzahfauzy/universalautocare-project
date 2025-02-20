<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_orders', [
    'status' => 'NEW'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Data berhasil diperbarui"]);

header('location:' . routeTo('manajemen/status/orders', ['filter' => ['order_type' => $_GET['filter']['order_type']]]));
die();
