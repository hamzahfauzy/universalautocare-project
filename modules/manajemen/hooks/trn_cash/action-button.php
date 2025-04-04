<?php

use Core\Request;

$route = Request::getRoute();
$button = "";
if($route == 'manajemen/status/cash')
{
    
    $additionalButton = '<a class="dropdown-item" href="'.routeTo('manajemen/status/cash/new', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan set new data ini ?\')){return true}else{return false}"><i class="fa-solid fa-check"></i> New</a>
                        <a class="dropdown-item" href="'.routeTo('manajemen/status/cash/approve', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a>
                        <a class="dropdown-item" href="'.routeTo('manajemen/status/cash/cancel', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>';
    $button = '<div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        '.$additionalButton.'
                    </div>
                </div>';
}
else if($route == 'crud/index' && $data->status == 'NEW')
{
    $additionalButton = '<a class="dropdown-item" href="'.routeTo('manajemen/cash/approve', ['id' => $data->id, 'filter' => ['cash_group' => $data->cash_group]]).'" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a> ';
    $additionalButton .= '<a class="dropdown-item" href="'.routeTo('crud/edit', ['table'=>'trn_cash', 'id' => $data->id, 'filter' => ['cash_group' => $data->cash_group]]).'"><i class="fa-solid fa-pencil"></i> Edit</a> ';
    $additionalButton .= '<a class="dropdown-item" href="'.routeTo('crud/delete', ['table'=>'trn_cash', 'id' => $data->id, 'filter' => ['cash_group' => $data->cash_group]]).'" onclick="if(confirm(\'Apakah anda yakin akan menghapus data ini ?\')){return true}else{return false}"><i class="fa-solid fa-trash"></i> Delete</a> ';
    $button = '<div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        '.$additionalButton.'
                    </div>
                </div>';
}

return $button;