<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "HAVING category_id = $_GET[category_id]";

$db->query = "SELECT 
                    *, 
                    CASE WHEN item_type = 1 THEN price
                         WHEN item_type = 0 THEN COALESCE((SELECT price FROM trn_purchase_items WHERE item_id = mst_items.id ORDER BY id DESC LIMIT 1), 0)
                    END price
                FROM mst_items $having";
$products = $db->exec('all');

return Response::json(compact('products'), 'item options loaded');