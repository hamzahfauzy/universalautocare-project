<?php
get_header();
$attr  = ['class' => "form-control"];
?>
<style>
    .select2 {
        width: 100% !important
    }
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('crud/index', ['table' => 'trn_purchases']) ?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if ($error_msg): ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif ?>
        <form action="" method="post" onsubmit="if(items.length == 0){ alert('Maaf! Item order belum di isi'); return false }else{ return true }" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Pembelian</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[code]', array_merge($attr, ['placeholder' => 'No. Pembelian', 'readonly' => 'readonly', 'value' => $code])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Pembelian</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', $tableName . '[date]', array_merge($attr, ['placeholder' => 'Tgl. Pembelian', 'required' => '', 'value' => $data->date])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Supplier</label>
                        <div class="col-8">
                            <div class="d-flex">
                                <?= \Core\Form::input('options-obj:mst_suppliers,id,name', $tableName . '[supplier_id]', array_merge($attr, ['placeholder' => 'Pilih Customer', 'required' => '', 'value' => $data->supplier_id])) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Karyawan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_employees,id,name', $tableName . '[employee_id]', array_merge($attr, ['placeholder' => 'Pilih Customer', 'required' => '', 'value' => $data->employee_id])) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Item</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_item]" class="form-control" placeholder="Total Item" readonly value="<?= $data->total_item ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Qty</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_qty]" class="form-control" placeholder="Total Qty" readonly value="<?= $data->total_qty ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Nilai Pembelian</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[total_value]', array_merge($attr, ['placeholder' => 'Total Nilai Pembelian', 'readonly' => 'readonly', 'value' => number_format($data->total_value)])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Keterangan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('textarea', $tableName . '[description]', array_merge($attr, ['placeholder' => 'Keterangan', 'class' => 'form-control select2-search__field', 'value' => $data->description])) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <table class="table table-bordered table-item">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Deskripsi Keterangan Pembelian</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Pembelian</th>
                            <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Item</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="empty_item" style="<?= count($items) ? 'display:none' : '' ?>">
                            <td colspan="8" class="text-center"><i>Belum ada item</i></td>
                        </tr>

                        <?php foreach ($items as $idx => $item): ?>
                            <tr id="item_<?= $idx + 1 ?>">
                                <td>
                                    <?= $idx + 1 ?>
                                </td>
                                <td><?= $item['category_name'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td>Rp. <?= number_format($item['price']) ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= $item['unit'] ?></td>
                                <td id="total_price_<?= $idx + 1 ?>">Rp. <?= number_format($item['total_price']) ?></td>
                                <td><a href="<?= routeTo('crud/delete', ['table' => 'trn_purchase_items', 'id' => $item['id'], 'purchase_id' => $_GET['id']]) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="itemModalLabel">Form Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">Kategori</label>
                    <?= \Core\Form::input('options-obj:mst_categories,id,name|record_type,BARANG', 'category', array_merge($attr, ['class' => 'form-control select2insidemodal', 'placeholder' => 'Pilih Kategori'])) ?>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">Produk</label>
                    <select name="product" id="product-select" class="form-control select2insidemodal"></select>
                </div>
                <div id="new-product" style="display: none;">
                    <div class="form-group mb-3">
                        <label class="mb-2 w-100">Nama Produk</label>
                        <input type="text" id="product_name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2 w-100">Satuan</label>
                        <input type="text" id="product_unit" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-item-button">Tambahkan</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>