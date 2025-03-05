<?php

$button = "";

$isApproved = $data->status == 'APPROVE';
$isCancel = $data->status == 'CANCEL';
$isNew = $data->status == 'NEW';

$btn = '<a class="dropdown-item" href="' . routeTo('manajemen/outgoings/edit', ['id' => $data->id]) . '"><i class="fa-solid fa-pencil"></i> Edit</a>
                    <a class="dropdown-item" href="' . routeTo('manajemen/outgoings/approve', ['id' => $data->id]) . '" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a>
                    <a class="dropdown-item" href="' . routeTo('manajemen/outgoings/cancel', ['id' => $data->id]) . '" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>
                    <a class="dropdown-item text-danger" onclick="if(confirm(\'Apakah anda yakin akan menghapus data ini ?\')){return true}else{return false}" href="' . routeTo('crud/delete', ['table' => 'trn_outgoings', 'id' => $data->id]) . '"><i class="fa-solid fa-trash"></i> Delete</a>';
$button = '<div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="' . routeTo('manajemen/outgoings/detail', ['id' => $data->id]) . '"><i class="fa-solid fa-eye"></i> Detail</a>
                    '.($isNew ? $btn : '').'
                </div>
            </div>';

return $button;
