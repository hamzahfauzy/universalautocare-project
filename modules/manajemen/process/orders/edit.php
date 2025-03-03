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
    $items = $_POST['items'];

    foreach ($items as $item) {
        $item['order_id'] = $_GET['id'];
        $item['total_price'] = $item['price'] * $item['qty'];
        $db->insert('trn_order_items', $item);
    }

    $new_items = (array) $db->all('trn_order_items', ['order_id' => $_GET['id']]);

    $data['total_value'] = str_replace(',', '', $data['total_value']);
    $data['total_service_value'] = str_replace(',', '', $data['total_service_value']);
    $data['order_type'] = $_GET['filter']['order_type'];

    $file = $_FILES['pic_url'];
    $name = $file['name'];

    if (!empty($name)) {
        $data['pic_url'] = Storage::upload($file);
    }

    $data['updated_by'] = auth()->id;
    $order = $db->update('trn_orders', $data, ['id' => $_GET['id']]);

    set_flash_msg(['success' => "Job Order berhasil ditambahkan"]);

    header('location:' . routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => $_GET['filter']['order_type']]]));
    die();
}

$db->query = "SELECT COUNT(*) as `counter` FROM trn_orders WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$data = $db->single('trn_orders', ['id' => $_GET['id']]);

$code = $data->code;


$data_items = $db->all('trn_order_items', ['order_id' => $_GET['id']]);

$items = [];

foreach ($data_items as $index => $item) {
    $service = $db->single('mst_services', ['id' => $item->service_id]);
    $category = $db->single('mst_categories', ['id' => $service->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $service->name,
        'qty' => (int) $item->qty,
        'price' => (int) $item->price,
        'total_price' => (int) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'service' => $service->id,
    ];
}

$customer = $db->single('mst_customers', ['id' => $data->customer_id]);

$data->customer = $customer;

// page section
$title = 'Edit Data Job Order';
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
Page::pushFoot("<script>var items = " . json_encode($items) . "</script>");
Page::pushFoot("<script src='" . asset('assets/manajemen/js/orders.js') . "'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('#itemModal .modal-body')});</script>");

Page::pushHook('edit');

return view('manajemen/views/orders/edit', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items'));
