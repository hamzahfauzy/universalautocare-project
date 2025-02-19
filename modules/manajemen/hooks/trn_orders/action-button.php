<?php

$button = "";

$isApproved = $data->status == 'APPROVE';
$isCancel = $data->status == 'CANCEL';
$isNew = $data->status == 'NEW';

$button = $isNew ? '<div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="' . routeTo('manajemen/orders/edit', ['id' => $data->id, 'filter' => ['order_type' => $_GET['filter']['order_type']]]) . '"><i class="fa-solid fa-pencil"></i> Edit</a>
                    <a class="dropdown-item" href="' . routeTo('manajemen/orders/approve', ['id' => $data->id, 'filter' => ['order_type' => $_GET['filter']['order_type']]]) . '" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a>
                    <a class="dropdown-item" href="' . routeTo('manajemen/orders/cancel', ['id' => $data->id, 'filter' => ['order_type' => $_GET['filter']['order_type']]]) . '" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>
                    <a class="dropdown-item text-danger" onclick="if(confirm(\'Apakah anda yakin akan menghapus data ini ?\')){return true}else{return false}" href="' . routeTo('crud/delete', ['table' => 'trn_orders', 'id' => $data->id]) . '"><i class="fa-solid fa-trash"></i> Delete</a>
                </div>
            </div>' : '';

return $button;
