<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Core\Storage;

$tableName = 'trn_orders';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

if (Request::isMethod('POST')) {
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    $items = isset($_POST['items']) ? $_POST['items'] : [];
    $data['total_value'] = str_replace(',', '', $data['total_value']);
    $data['total_service_value'] = str_replace(',', '', $data['total_service_value']);
    $data['order_type'] = $_GET['filter']['order_type'];

    $file = $_FILES['pic_url'];
    $name = $file['name'];

    if (!empty($name)) {
        $data['pic_url'] = Storage::upload($file);
    }

    $order = $db->insert('trn_orders', $data);

    foreach ($items as $item) {
        $item['order_id'] = $order->id;
        $item['total_price'] = $item['price'] * $item['qty'];
        $db->insert('trn_order_items', $item);
    }

    set_flash_msg(['success' => "Job Order berhasil ditambahkan"]);

    header('location:' . routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => $_GET['filter']['order_type']]]));
    die();
}

// page section
$title = 'Data Job Order ' . $_GET['filter']['order_type'];
$types = ['BENGKEL' => 'workshop', 'DOORSMEER' => 'carwash'];
$order_type = $_GET['filter']['order_type'];
Page::setActive('manajemen.' . $types[$order_type] . '_orders');
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_orders', 'order_type' => $_GET['filter']['order_type']]),
        'title' => 'Data Job Order'
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
Page::pushFoot("<script src='" . asset('assets/crud/js/crud.js') . "'></script>");
Page::pushFoot("<script>var items = []</script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/orders.js') . "'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('#itemModal .modal-body')});</script>");

Page::pushHook('create');

$db->query = "SELECT COUNT(*) as `counter` FROM trn_orders WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$code = "ORD" . date('Ym') . sprintf("%04d", $counter + 1);

return view('manajemen/views/orders/create', compact('error_msg', 'old', 'tableName', 'code'));
