<?php

use Core\Database;

$db = new Database();

$new_items = (array) $db->all('trn_outgoing_items', ['outgoing_id' => $_GET['outgoing_id']]);
$data = [];
$data['total_outgoing_items'] = count($new_items);
$data['total_outgoing_qty'] = array_sum(array_column($new_items, 'outgoing_qty'));
$data['total_outgoing_value'] = array_sum(array_column($new_items, 'total_price'));

$outgoing = $db->update('trn_outgoings', $data, ['id' => $_GET['outgoing_id']]);
header("location:" . routeTo("manajemen/outgoings/edit?id=" . $_GET['outgoing_id']));
die;
