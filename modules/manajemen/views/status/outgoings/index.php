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
                        <th>Customer</th>
                        <th>Karyawan</th>
                        <th>Total Items / Qty</th>
                        <th>Nilai Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):
                        $order = $db->single('trn_orders', ['id' => $item->order_id]);
                        $customer = $db->single('mst_customers', ['id' => $order->customer_id]);
                        $employee = $db->single('mst_employees', ['id' => $item->employee_id]);
                    ?>
                        <tr>
                            <td><?= $item->code ?></td>
                            <td><?= $item->date ?></td>
                            <td><?= $customer->name ?></td>
                            <td><?= $employee->name ?></td>
                            <td><?= $item->total_outgoing_items . " Items / " . $item->total_outgoing_qty . " " . $unit ?></td>
                            <td>Rp. <?= number_format($item->total_outgoing_value) ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?= routeTo('manajemen/status/outgoings/new', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan memperbarui data ini ?')"><i class="fa-solid fa-pencil"></i> New</a>
                                <a class="btn btn-success" href="<?= routeTo('manajemen/status/outgoings/approve', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengapprove data ini ?')"><i class="fa-solid fa-square-check"></i> Approve</a>
                                <a class="btn btn-danger" href="<?= routeTo('manajemen/status/outgoings/cancel', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>