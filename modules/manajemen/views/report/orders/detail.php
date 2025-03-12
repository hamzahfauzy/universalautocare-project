<?php get_header(); ?>
<style>
    table td img {
        max-width: 150px;
    }

    table.table td,
    table.table th {
        white-space: nowrap;
    }
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <?php if ($error_msg) : ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif ?>

        <form method="get">

            <div class="row">
                <div class="col">
                    <label>No. Order</label>
                    <?= \Core\Form::input('options-obj:trn_orders,code,code', 'code', ['class' => 'form-control filters', 'placeholder' => 'Pilih Order', 'value' => $_GET['code'] ?? '']) ?>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>

        </form>

        <?php if ($order) : ?>

            <hr>

            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <label class="col" style="font-weight: bold;">No Order</label>
                        <div class="col"><?= $order->code ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Tgl Order</label>
                        <div class="col"><?= $order->date ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Customer</label>
                        <div class="col">
                            <div><?= $order->customer->name ?> - <?= $order->customer->phone ?></div>
                            <div><?= $order->customer_vehicle_type ?></div>
                            <div><?= $order->customer_vehicle_color ?> - <?= $order->customer_police_number ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Partner</label>
                        <div class="col"><?= $order->partner->name ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Tgl Est Selesai</label>
                        <div class="col"><?= $order->done_date ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Karyawan</label>
                        <div class="col">
                            <?= $order->employee->name ?> - <?= $order->employee->phone ?>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Nilai Jasa</label>
                        <div class="col">Rp. <?= number_format($order->total_service_value) ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Nilai Barang</label>
                        <div class="col">Rp. <?= number_format($order->total_item_value) ?></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <label class="col" style="font-weight: bold;">Nilai Order</label>
                        <div class="col">Rp. <?= number_format($order->total_value) ?></div>
                    </div>
                    <div class="row">
                        <label class="col" style="font-weight: bold;">File Dokumen</label>
                        <div class="col">
                            <button class="btn btn-primary">Preview</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive my-4">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Jasa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->services as $index => $item):

                            $service = $db->single('mst_services', ['id' => $item->service_id]);
                            $category = $db->single('mst_categories', ['id' => $service->category_id]);

                        ?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><?= $category->name ?></td>
                                <td><?= $service->name ?></td>
                                <td>Rp. <?= number_format($item->price) ?></td>
                                <td><?= $item->qty ?></td>
                                <td><?= $item->unit ?></td>
                                <td>Rp. <?= number_format($item->total_price) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            
            <div class="table-responsive my-4">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Jasa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->items as $index => $item): ?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><?= $item->category_name ?></td>
                                <td><?= $item->item_name ?></td>
                                <td>Rp. <?= number_format($item->item_price) ?></td>
                                <td><?= $item->item_qty ?></td>
                                <td><?= $item->item_unit ?></td>
                                <td>Rp. <?= number_format($item->item_total_price) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive my-4">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Terima Kas</th>
                            <th>Tgl. Terima Kas</th>
                            <th>Tipe</th>
                            <th>Sumber</th>
                            <th>Bank</th>
                            <th>Discount</th>
                            <th>Nilai Terima Kas</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($order->cash as $index => $cash): 
                            $bank = $db->single('mst_banks', ['id' => $cash->bank_id]);
                        ?>
                            <tr>
                                <td><?= $index+1 ?></td>
                                <td><?= $cash->code ?></td>
                                <td><?= $cash->date ?></td>
                                <td><?= $cash->cash_type ?></td>
                                <td><?= $bank->name ?></td>
                                <td>Rp. <?= number_format($cash->discount) ?></td>
                                <td>Rp. <?= number_format($cash->total_payment) ?></td>
                                <td>Rp. <?= number_format($cash->cash_total) ?></td>
                                <td><?= $cash->status ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>


        <?php endif ?>
    </div>
</div>
<?php get_footer() ?>