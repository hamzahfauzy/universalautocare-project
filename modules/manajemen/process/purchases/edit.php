<?php

use Core\Database;
use Core\Page;
use Core\Request;

$tableName = 'trn_purchases';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

if (Request::isMethod('POST')) {
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    $items = $_POST['items'];
    foreach ($items as $index => $item) {
        $item['purchase_id'] = $_GET['id'];
        $item['total_price'] = $item['price'] * $item['total_qty'];
        $db->insert('trn_purchase_items', $item);
    }

    $new_items = (array) $db->all('trn_purchase_items', ['purchase_id' => $_GET['id']]);

    $data['total_item'] = count($new_items);
    $data['total_qty'] = array_sum(array_column($new_items, 'total_qty'));
    $data['total_value'] = str_replace(',', '', $data['total_value']);
    $data['updated_by'] = auth()->id;
    $purchase = $db->update('trn_purchases', $data, ['id' => $_GET['id']]);


    set_flash_msg(['success' => "Pembelian berhasil diedit"]);

    header('location:' . routeTo('crud/index', ['table' => 'trn_purchases']));
    die();
}


$db->query = "SELECT COUNT(*) as `counter` FROM trn_purchases WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$data = $db->single('trn_purchases', ['id' => $_GET['id']]);

$code = $data->code;

$data_items = $db->all('trn_purchase_items', ['purchase_id' => $_GET['id']]);

$items = [];

foreach ($data_items as $index => $item) {
    $product = $db->single('mst_items', ['id' => $item->item_id]);
    $category = $db->single('mst_categories', ['id' => $product->category_id]);
    $items[] = [
        'id' => $item->id,
        'key' => $index + 1,
        'name' => $product->name,
        'qty' => (double) $item->total_qty,
        'price' => (double) $item->price,
        'total_price' => (double) $item->total_price,
        'unit' => $item->unit,
        'category_name' => $category->name,
        'category' => $category->id,
        'product' => $product->id,
    ];
}

// page section
$title = 'Edit Pembelian';
Page::setActive("manajemen.purchases.create");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_purchases']),
        'title' => 'Data Pembelian'
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
Page::pushFoot("<script src='" . asset('assets/manajemen/js/purchases.js?v=1.0') . "'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('#itemModal .modal-body')});</script>");

Page::pushHook('edit');

return view('manajemen/views/purchases/edit', compact('error_msg', 'old', 'tableName', 'code', 'data', 'items'));
