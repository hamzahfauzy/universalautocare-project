<?php

use Core\Database;

$db = new Database();

$new_items = (array) $db->all('trn_order_items', ['order_id' => $_GET['order_id']]);
$data = [];
$data['total_value'] = array_sum(array_column($new_items, 'total_value'));
$data['total_service_value'] = array_sum(array_column($new_items, 'total_service_value'));

$order = $db->update('trn_orders', $data, ['id' => $_GET['order_id']]);
header("location:" . routeTo("manajemen/orders/edit", ['id' => $_GET['order_id'], 'filter' => ['order_type' => $_GET['filter']['order_type']]]));
die;
