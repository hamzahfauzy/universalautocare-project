<?php

$button = "<a href='" . routeTo('manajemen/orders/create', ['filter' => ['order_type' => $_GET['filter']['order_type']]]) . "' class='btn btn-success btn-sm'><i class='fa-solid fa-plus'></i> Tambah</a>";

return $button;
