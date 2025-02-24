<?php

use Core\Database;
use Core\Response;

$db = new Database;

$having = "HAVING trn_orders.code = '$_GET[code]'";

$db->query = "SELECT trn_orders.*, mst_customers.name customer_name FROM trn_orders LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id $having";
$orders = $db->exec('single');

return Response::json($orders, 'data retrieved');
