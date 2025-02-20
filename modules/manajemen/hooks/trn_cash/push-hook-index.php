<?php

use Core\Page;
use Core\Route;

// Route::additional_allowed_routes([
//     'route_path' => '!crud/create?table=trn_orders'
// ]);

// Route::additional_allowed_routes([
//     'route_path' => '!crud/edit?table=trn_orders'
// ]);

// Route::additional_allowed_routes([
//     'route_path' => '!crud/delete?table=trn_orders'
// ]);

$types = ['PENERIMAAN KAS' => 'cash_income', 'PENGELUARAN KAS' => 'cash_outcome', 'BIAYA KAS' => 'cash_cost'];
$cash_group = $_GET['filter']['cash_group'];
Page::setActive('manajemen.'.$types[$cash_group]);
