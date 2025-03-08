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
        <?php if ($success_msg) : ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif ?>

        <div class="table-responsive my-4">
            <table class="table table-striped datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Tgl. Order</th>
                        <th>Karyawan / Partner</th>
                        <th>Customer</th>
                        <th>Nilai Order</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?= $item->noorder ?><br>Rp. <?= number_format($item->total_value) ?></td>
                            <td><?= $item->tglorder ?></td>
                            <td><?= $item->employee_id ?> - <?= $item->namakaryawan ?><br><?= $item->namapartner ?></td>
                            <td>
                                <?= $item->namacustomer ?><br>
                                <?= $item->customer_police_number . " / " . $item->telpcustomer . " / " . $item->customer_vehicle_type ?>
                            </td>
                            <td>
                                Barang : Rp. <?= number_format($item->total_item_value) ?>
                                <br>
                                Jasa : Rp. <?= number_format($item->total_service_value) ?>
                            </td>
                            <td><?=$item->status?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?= routeTo('manajemen/status/orders/new', ['id' => $item->id, 'filter' => ['order_type' => $_GET['filter']['order_type']]]) ?>" onclick="return confirm('Apakah anda yakin akan memperbarui data ini ?')"><i class="fa-solid fa-pencil"></i> New</a>
                                <?php if($item->totalbayar == 0 && $item->totalbarang == 0): ?>
                                    <a class="btn btn-sm btn-danger" href="<?= routeTo('manajemen/status/orders/cancel', ['id' => $item->id, 'filter' => ['order_type' => $_GET['filter']['order_type']]]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>
                                <?php endif ?>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>