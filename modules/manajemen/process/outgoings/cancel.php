<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_outgoings',[
    'status' => 'CANCEL',
    'updated_by' => auth()->id
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil dicancel"]);

header('location:'.routeTo('crud/index',['table' => 'trn_outgoings']));
die();