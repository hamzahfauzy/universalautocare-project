<?php

use Core\Database;

$db = new Database;
$db->update('trn_cash', [
    'status' => 'NEW'
], [
    'id' => $_GET['id']
]);

$cash = $db->single('trn_cash', ['id' => $_GET['id']]);

set_flash_msg(['success' => "Data berhasil diperbarui"]);

header('location:' . routeTo('manajemen/status/cash', ['filter' => ['cash_group' => $cash->cash_group]]));
die();
