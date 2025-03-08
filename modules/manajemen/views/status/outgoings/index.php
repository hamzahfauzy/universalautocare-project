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
                        <th>No. Pengeluaran</th>
                        <th>Tgl. Pengeluaran</th>
                        <th>Customer / Karyawan</th>
                        <th>Total Items / Qty</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?= $item->nopengeluaran ?></td>
                            <td><?= $item->tglpengeluaran ?></td>
                            <td><?= $item->idcustomer ?> - <?= $item->namacustomer ?><br><?= $item->namakaryawan ?></td>
                            <td><?= $item->total_outgoing_items . " Items / " . $item->total_outgoing_qty . " PCS" ?><br>Rp. <?= number_format($item->total_outgoing_value) ?></td>
                            <td><?=$item->status?></td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="<?= routeTo('manajemen/status/outgoings/cancel', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>