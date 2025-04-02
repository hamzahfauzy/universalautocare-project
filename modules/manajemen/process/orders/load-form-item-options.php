<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;

$category = $db->single('mst_categories', [
    'id' => $_GET['category_id']
]);

$items = [];
$having = "HAVING category_id = $_GET[category_id]";
$table = $category->record_type == 'JASA' ? 'mst_services' : 'mst_items';
$db->query = "SELECT *, '$category->record_type' as record_type FROM $table $having";
$items = $db->exec('all');

return Response::json($items, 'item options loaded');
