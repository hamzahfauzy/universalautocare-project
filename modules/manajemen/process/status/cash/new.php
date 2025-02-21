<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_cash', [
    'status' => 'NEW'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Data berhasil diperbarui"]);

header('location:' . routeTo('manajemen/status/cash', ['filter' => ['cash_group' => $_GET['filter']['cash_group']]]));
die();
