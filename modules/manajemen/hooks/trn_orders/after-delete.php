<?php
header("location:" . routeTo("crud/index", ['table' => 'trn_orders', 'filter' => ['order_type' => $_GET['filter']['order_type']]]));
die;
