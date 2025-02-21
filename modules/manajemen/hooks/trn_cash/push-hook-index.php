<?php

use Core\Page;
use Core\Request;
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
$route = Request::getRoute();

if($route == 'crud/index')
{
    Page::set_title(__('manajemen.label.'.$types[$cash_group]));
    Page::setActive('manajemen.'.$types[$cash_group]);
}

else 

{
    Page::set_title('Update status '.__('manajemen.label.'.$types[$cash_group]));
    Page::setActive('manajemen.status.'.$types[$cash_group]);
}
