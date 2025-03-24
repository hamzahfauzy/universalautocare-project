<?php

use Core\Database;
use Core\Response;

$db = new Database;
$data = $_POST;
unset($data['_token']);
$product = $db->insert('mst_items', $data);

return Response::json($product, 'data created successfuly');
