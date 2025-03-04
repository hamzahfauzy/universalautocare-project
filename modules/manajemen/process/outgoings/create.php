<?php

use Core\Database;
use Core\Page;
use Core\Request;

$tableName = 'trn_outgoings';
$module = 'manajemen';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$db = new Database;

if (Request::isMethod('POST')) {
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    $items = $_POST['items'];
    $data['total_outgoing_items'] = count($items);
    $data['total_outgoing_qty'] = array_sum(array_column($items, 'outgoing_qty'));
    $data['total_outgoing_value'] = str_replace(',', '', $data['total_outgoing_value']);
    $outgoing = $db->insert('trn_outgoings', $data);

    foreach ($items as $index => $item) {
        $item['outgoing_id'] = $outgoing->id;
        $item['total_price'] = $item['price'] * $item['outgoing_qty'];
        $db->insert('trn_outgoing_items', $item);
    }

    set_flash_msg(['success' => "Pengeluaran berhasil ditambahkan"]);

    header('location:' . routeTo('crud/index', ['table' => 'trn_outgoings']));
    die();
}

// page section
$title = 'Pengeluaran';
Page::setActive("manajemen.trn_outgoings");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'trn_outgoings']),
        'title' => 'Data Pengeluaran'
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
Page::pushFoot("<script src='" . asset('assets/manajemen/js/outgoings.js') . "'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('#itemModal .modal-body')});</script>");

Page::pushHook('create');

$db->query = "SELECT COUNT(*) as `counter` FROM trn_outgoings WHERE created_at LIKE '%" . date('Y-m') . "%'";
$counter = $db->exec('single')?->counter ?? 0;

$code = "SPG" . date('Ym') . sprintf("%04d", $counter + 1);

$db->query = "SELECT * FROM trn_orders WHERE status = 'APPROVE' AND total_value <> total_payment";
$orders = $db->exec('all');

return view('manajemen/views/outgoings/create', compact('error_msg', 'old', 'tableName', 'code','orders'));
