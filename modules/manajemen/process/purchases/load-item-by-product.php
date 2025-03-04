<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);
$product_id = isset($_GET['product_id']) && !empty($_GET['product_id']) ? $_GET['product_id'] : 0;
$db->query = "SELECT 
trn_purchases.id,
trn_purchases.code, 
SUM(trn_purchase_items.total_qty)- SUM(COALESCE(trn_purchase_items.outgoing_qty,0)) max_qty,
trn_purchase_items.price
FROM trn_purchases
LEFT JOIN trn_purchase_items ON trn_purchase_items.purchase_id=trn_purchases.id
WHERE trn_purchases.status='APPROVE' AND COALESCE(trn_purchase_items.outgoing_qty, 0) <> trn_purchase_items.total_qty AND trn_purchase_items.item_id = $product_id
GROUP BY trn_purchases.id, trn_purchases.code, trn_purchase_items.price";
$items = $db->exec('all');

return Response::json($items, 'item options loaded');