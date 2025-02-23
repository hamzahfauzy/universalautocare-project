<?php

use Core\Database;
use Core\Response;

$db = new Database;

$having = "HAVING trn_purchases.code = '$_GET[code]'";

$db->query = "SELECT trn_purchases.*, mst_suppliers.name supplier_name FROM trn_purchases LEFT JOIN mst_suppliers ON mst_suppliers.id = trn_purchases.supplier_id $having";
$purchases = $db->exec('single');

return Response::json($purchases, 'data retrieved');
