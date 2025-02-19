<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "HAVING category_id = $_GET[category_id]";

$db->query = "SELECT * FROM mst_services $having";
$services = $db->exec('all');

return Response::json(compact('services'), 'item options loaded');
