<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "WHERE id = $_GET[order_id]";

$db->query = "SELECT * FROM trn_orders $having";
$order = $db->exec('single');
$customer = $db->single('mst_customers', ['id' => $order->customer_id]);

return Response::json(compact('customer', 'order'), 'item options loaded');
