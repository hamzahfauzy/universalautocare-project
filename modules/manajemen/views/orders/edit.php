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
            <a href="<?= routeTo('crud/index', ['table' => 'trn_orders', 'filter' => ['order_type' => $_GET['filter']['order_type']]]) ?>" class="btn btn-warning btn-sm">
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
                        <label class="mb-2 col-4">No. Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[code]', array_merge($attr, ['placeholder' => 'No. Order', 'readonly' => 'readonly', 'value' => $code])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', $tableName . '[date]', array_merge($attr, ['placeholder' => 'Tgl. Order', 'required' => '', 'value' => $data->date])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Estimasi Selesai</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', $tableName . '[done_date]', array_merge($attr, ['placeholder' => 'Tgl. Estimasi Selesai', 'required' => '', 'value' => $data->done_date])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Partner</label>
                        <div class="col-8">
                            <div class="d-flex">
                                <?= \Core\Form::input('options-obj:mst_partners,id,name', $tableName . '[partner_id]', array_merge($attr, ['placeholder' => 'Pilih Partner', 'required' => '', 'value' => $data->partner_id])) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Karyawan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_employees,id,name', $tableName . '[employee_id]', array_merge($attr, ['placeholder' => 'Pilih Karyawan', 'required' => '', 'value' => $data->employee_id])) ?>
                        </div>
                    </div>
                    <div class="row mb-3 d-none">
                        <label class="mb-2 col-4">Total Barang</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_item_value]" id="total_item_value" data-type="currency" class="form-control" placeholder="Total Barang" value="<?= (int)$data->total_item_value ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Jasa</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_service_value]" id="total_service_value" class="form-control" placeholder="Total Jasa" readonly value="<?= number_format($data->total_service_value) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Order</label>
                        <div class="col-8">
                            <input type="text" name="<?= $tableName ?>[total_value]" id="total_value" class="form-control" placeholder="Total Order" readonly value="<?= number_format($data->total_value) ?>">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Customer</label>
                        <div class="col-8">
                            <div class="d-flex">
                                <?= \Core\Form::input('options-obj:mst_customers,id,name', $tableName . '[customer_id]', array_merge($attr, ['placeholder' => 'Pilih Customer', 'required' => '', 'id' => 'customer', 'value' => $data->customer_id])) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Telepon</label>
                        <div class="col-8">
                            <input type="text" name="phone" class="form-control" placeholder="No. Telepon" readonly value="<?= $data->customer->phone ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Plat/Polisi</label>
                        <div class="col-8">
                            <?= \Core\Form::input('tex', $tableName . '[customer_police_number]', array_merge($attr, ['placeholder' => 'No. Plat/Polisi', 'readonly' => 'readonly', 'value' => $data->customer_police_number])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Jenis Kendaraan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[customer_vehicle_type]', array_merge($attr, ['placeholder' => 'Jenis Kendaraan', 'readonly' => 'readonly', 'value' => $data->customer_vehicle_type])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Warna Kendaraan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', $tableName . '[customer_vehicle_color]', array_merge($attr, ['placeholder' => 'Warna Kendaraan', 'readonly' => 'readonly', 'value' => $data->customer_vehicle_color])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">File Dokumen</label>
                        <div class="col-8">
                            <input type="file" name="pic_url" class="form-control">

                            <?php if($data->pic_url): ?>
                                <a href="<?=asset($data->pic_url)?>" target="_blank">Lihat File</a>
                            <?php endif ?>
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
                            <th>Deskripsi Keterangan Jasa</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Jasa</th>
                            <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Barang/Jasa</button></th>
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
                                <td><a href="<?= routeTo('crud/delete', ['table' => 'trn_order_items', 'id' => $item['id'], 'order_id' => $_GET['id'], 'filter' => ['order_type' => $_GET['filter']['order_type']]]) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></button></td>
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
                    <?= \Core\Form::input('options-obj:mst_categories,id,name', 'category', array_merge($attr, ['class' => 'form-control select2insidemodal', 'placeholder' => 'Pilih Kategori'])) ?>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">Barang/Jasa</label>
                    <select name="item" id="service-select" class="form-control select2insidemodal"></select>
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