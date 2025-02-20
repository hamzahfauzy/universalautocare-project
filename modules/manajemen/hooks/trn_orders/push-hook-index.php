<?php

use Core\Page;
use Core\Route;

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table=trn_orders'
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table=trn_orders'
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table=trn_orders'
]);

$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash'];
$order_type = $_GET['filter']['order_type'];
Page::setActive('manajemen.'.$types[$order_type].'_orders');
