<?php

use Core\Database;

get_header();
$db = new Database();

$attr = 'form-control';

?>
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
                        <th>No. Pembelian</th>
                        <th>Tgl. Pembelian</th>
                        <th>Supplier / Karyawan</th>
                        <th>Total Items / Qty</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                        <tr>
                            <td><?= $item->nopembelian ?></td>
                            <td><?= $item->tglpembelian ?></td>
                            <td><?= $item->supplier_id ?> - <?= $item->namasupplier ?> <br> <?= $item->namakaryawan ?></td>
                            <td><?= $item->total_item . " Items / " . $item->total_qty . " PCS" ?> <br> Rp. <?= number_format($item->total_value) ?></td>
                            <td><?=$item->status?></td>
                            <td>
                                <?php if($item->totalbayar == 0 && $item->totalpengeluaran == 0): ?>
                                <a class="btn btn-sm btn-danger" href="<?= routeTo('manajemen/status/purchases/cancel', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>
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