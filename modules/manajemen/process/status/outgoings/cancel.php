<?php

use Core\Database;

$id = $_GET['id'];

$db = new Database;
$db->query = "Select X.item_id, X.purchase_id, X.outgoing_qty From trn_outgoing_items X Where X.outgoing_id = $id";
$items = $db->exec('all');

foreach($items as $item)
{
    $purchase_id = $item->purchase_id;
    $outgoing_qty = $item->outgoing_qty;
    $item_id = $item->item_id;
    $db->query = "Update trn_purchase_items Set outgoing_qty = Coalesce(outgoing_qty, 0) - $outgoing_qty Where item_id = $item_id And purchase_id = $purchase_id";
    $db->exec();
}

$db->update('trn_outgoings', [
    'status' => 'CANCEL'
], [
    'id' => $id
]);

set_flash_msg(['success' => "Data berhasil dicancel"]);

header('location:' . routeTo('manajemen/status/outgoings'));
die();
