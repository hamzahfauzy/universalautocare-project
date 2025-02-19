<?php

use Core\Route;

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table=trn_outgoings'
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table=trn_outgoings'
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table=trn_outgoings'
]);
