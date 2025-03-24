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
            <a href="<?= routeTo('crud/index', ['table' => 'trn_outgoings']) ?>" class="btn btn-warning btn-sm">
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
                        <label class="mb-2 col-4">No. Pengeluaran</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[code]', array_merge($attr, ['placeholder' => 'No. Pengeluaran', 'readonly' => 'readonly', 'value' => $code])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Pengeluaran</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', $tableName . '[date]', array_merge($attr, ['placeholder' => 'Tgl. Pengeluaran', 'required' => ''])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Order</label>
                        <div class="col-8">
                            <div class="d-flex">
                                <select name="<?=$tableName?>[order_id]" id="" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php foreach($orders as $order): ?>
                                    <option value="<?=$order->id?>"><?=$order->code?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4"></label>
                        <div class="col-8">
                            <h6 id="customer">Nama Customer - No. Polisi</h6>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Karyawan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_employees,id,name', $tableName . '[employee_id]', array_merge($attr, ['placeholder' => 'Pilih Customer', 'required' => ''])) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Item</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_outgoing_items]" class="form-control" placeholder="Total Item" readonly value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Qty</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_outgoing_qty]" class="form-control" placeholder="Total Qty" readonly value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Nilai Pengeluaran</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[total_outgoing_value]', array_merge($attr, ['placeholder' => 'Total Nilai Pengeluaran', 'readonly' => 'readonly'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Keterangan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('textarea', $tableName . '[description]', array_merge($attr, ['placeholder' => 'Keterangan', 'class' => 'form-control select2-search__field'])) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <table class="table table-bordered table-item">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Pembelian</th>
                            <th>Kategori</th>
                            <th>Deskripsi Keterangan Pengeluaran</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Pengeluaran</th>
                            <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Item</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="empty_item">
                            <td colspan="9" class="text-center"><i>Belum ada item</i></td>
                        </tr>
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
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">No Pembelian</label>
                    <select name="purchase" id="purchase-select" class="form-control select2insidemodal"></select>
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