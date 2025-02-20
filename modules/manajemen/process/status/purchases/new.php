<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_purchases', [
    'status' => 'NEW'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Data berhasil diperbarui"]);

header('location:' . routeTo('manajemen/status/purchases'));
die();
