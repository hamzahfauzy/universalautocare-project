<?php

use Core\Database;
use Core\Page;
use Core\Request;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$db = new Database;

if (Request::isMethod('POST')) {
    $order = $db->single('trn_orders', ['code' => $_POST['code']]);
    $customer = $db->single('mst_customers', ['id' => $order->customer_id]);
    $order->customer = $customer;
    $items = $db->all('trn_order_items', ['order_id' => $order->id]);
    $order->items = $items;
    return view('manajemen/views/print/workshop-invoice', compact('order', 'db'));
}

// page section
$title = 'Cetak Job Order ' . $_GET['filter']['order_type'];
$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash'];
$order_type = $_GET['filter']['order_type'];
Page::setActive('manajemen.print.' . $types[$order_type] . '_orders');
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => $title
    ]
]);


Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
  selector: 'textarea:not(.select2-search__field)',
  relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");

Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');

Page::pushHook('index');

Page::pushFoot("<script>$('.datatable').dataTable()</script>");

return view('manajemen/views/print/orders/index', compact('error_msg', 'success_msg', 'old'));
