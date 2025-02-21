<?php

use Core\Page;

$types = ['PENERIMAAN KAS' => 'cash_income', 'PENGELUARAN KAS' => 'cash_outcome', 'BIAYA KAS' => 'cash_cost'];
$cash_group = $_GET['filter']['cash_group'];
Page::set_title(__('manajemen.label.'.$types[$cash_group]));
Page::setActive('manajemen.'.$types[$cash_group]);