<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "WHERE id = $_GET[customer_id]";

$db->query = "SELECT * FROM mst_customers $having";
$customer = $db->exec('single');

return Response::json(compact('customer'), 'customer loaded');
