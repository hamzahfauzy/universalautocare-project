<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_purchases',[
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil dicancel"]);

header('location:'.routeTo('crud/index',['table' => 'trn_purchases']));
die();