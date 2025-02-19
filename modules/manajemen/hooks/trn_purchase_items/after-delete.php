<?php

use Core\Database;

$db = new Database();

$new_items = (array) $db->all('trn_purchase_items', ['purchase_id' => $_GET['purchase_id']]);
$data = [];
$data['total_item'] = count($new_items);
$data['total_qty'] = array_sum(array_column($new_items, 'total_qty'));
$data['total_value'] = array_sum(array_column($new_items, 'total_price'));

$purchase = $db->update('trn_purchases', $data, ['id' => $_GET['purchase_id']]);
header("location:" . routeTo("manajemen/purchases/edit?id=" . $_GET['purchase_id']));
die;
