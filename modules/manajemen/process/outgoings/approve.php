<?php

use Core\Database;
use Core\Request;

$db = new Database;
$outgoing = $db->single('trn_outgoings', [
    'id' => $_GET['id']
]);

$db->update('trn_outgoings',[
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);

$items = $db->all('trn_outgoing_items', [
    'outgoing_id' => $outgoing->id
]);

foreach($items as $item)
{
    $purchase_item = $db->single('trn_purchase_items', [
        'purchase_id' => $item->purchase_id,
        'item_id' => $item->item_id
    ]);

    $db->update('trn_purchase_items', [
        'outgoing_qty' => $purchase_item->outgoing_qty + $item->outgoing_qty
    ], [
        'id' => $purchase_item->id
    ]);
}

set_flash_msg(['success'=>"Data berhasil diapprove"]);

header('location:'.routeTo('crud/index',['table' => 'trn_outgoings']));
die();