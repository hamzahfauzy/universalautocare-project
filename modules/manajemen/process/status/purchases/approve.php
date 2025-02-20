<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_purchases', [
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Data berhasil diapprove"]);

header('location:' . routeTo('manajemen/status/purchases'));
die();
