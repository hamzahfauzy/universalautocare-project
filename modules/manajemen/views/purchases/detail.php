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
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Pembelian</label>
                    <div class="col-8">
                        <?= $code ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Tgl. Pembelian</label>
                    <div class="col-8">
                        <?= $data->date ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Supplier</label>
                    <div class="col-8">
                        <div class="d-flex">
                            <?= $data->supplier->name ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Karyawan</label>
                    <div class="col-8">
                        <?= $data->employee->name ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Item</label>
                    <div class="col-8">
                        <?= $data->total_item ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Qty</label>
                    <div class="col-8">
                        <?= $data->total_qty ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Nilai Pembelian</label>
                    <div class="col-8">
                        Rp. <?= number_format($data->total_value) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Keterangan</label>
                    <div class="col-8">
                        <?= $data->description ?>
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
                    </tr>
                </thead>
                <tbody>
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
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer() ?>