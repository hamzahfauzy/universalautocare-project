<?php get_header(); ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => $data->order_type]]) ?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Order</label>
                    <div class="col-8">
                        <?=$code ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Tgl. Order</label>
                    <div class="col-8">
                        <?= $data->date ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Tgl. Estimasi Selesai</label>
                    <div class="col-8">
                        <?= $data->done_date ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Partner</label>
                    <div class="col-8">
                        <div class="d-flex">
                            <?= $data->partner_id ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Karyawan</label>
                    <div class="col-8">
                        <?= $data->employee_id ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Barang</label>
                    <div class="col-8">
                        <?= (int)$data->total_item_value ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Jasa</label>
                    <div class="col-8">
                        <?= number_format($data->total_service_value) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Total Order</label>
                    <div class="col-8">
                        <?= number_format($data->total_value) ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">Customer</label>
                    <div class="col-8">
                        <div class="d-flex">
                            <?= $data->customer->name ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Telepon</label>
                    <div class="col-8">
                        <?= $data->customer->phone ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Plat/Polisi</label>
                    <div class="col-8">
                        <?= $data->customer_police_number ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Jenis Kendaraan</label>
                    <div class="col-8">
                        <?= $data->customer_vehicle_type ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Warna Kendaraan</label>
                    <div class="col-8">
                        <?= $data->customer_vehicle_color ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">File Dokumen</label>
                    <div class="col-8">
                        <?php if($data->pic_url): ?>
                            <a href="<?=asset($data->pic_url)?>" target="_blank">Lihat File</a>
                        <?php endif ?>
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
                        <th>Deskripsi Keterangan Jasa</th>
                        <th>@Harga</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Jumlah Jasa</th>
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
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer() ?>