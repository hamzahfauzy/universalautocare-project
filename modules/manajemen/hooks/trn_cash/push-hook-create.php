<?php

use Core\Page;

$types = ['PENERIMAAN KAS' => 'cash_income', 'PENGELUARAN KAS' => 'cash_outcome', 'BIAYA KAS' => 'cash_cost'];
$cash_group = $_GET['filter']['cash_group'];
Page::set_title(__('manajemen.label.'.$types[$cash_group]));
Page::setActive('manajemen.'.$types[$cash_group]);

Page::pushFoot('<script>window.cash_group = "'.$cash_group.'";</script>');
Page::pushFoot('<script src="'.asset('assets/manajemen/js/create-cash.js?v='.strtotime('now')).'"></script>');