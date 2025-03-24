<?php

use Core\Database;
use Core\Request;

$db = new Database;
$outgoing = $db->single('trn_outgoings', [
    'id' => $_GET['id']
]);

$db->query = "SELECT * FROM trn_outgoing_items WHERE outgoing_id = $outgoing->id AND purchase_id <> NULL";
$items = $db->exec('all');

// validation
foreach($items as $index => $item)
{
    $purchase_item = $db->single('trn_purchase_items', [
        'purchase_id' => $item->purchase_id,
        'item_id' => $item->item_id
    ]);

    if($purchase_item->total_qty < ($purchase_item->outgoing_qty + $item->outgoing_qty))
    {
        $item = $db->single('mst_items', ['id' => $item->item_id]);
        redirectBack(['error' => 'Maaf! Total keluaran barang '.$item->name.' tidak valid']);
        break;
    }
}

$db->update('trn_outgoings',[
    'status' => 'APPROVE',
    'updated_by' => auth()->id
], [
    'id' => $_GET['id']
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