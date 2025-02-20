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

        <div class="row">
            <div class="col-2">
                <label>Dari Tgl. Pengeluaran</label>
                <?= \Core\Form::input('date', 'from_date', ['class' => 'form-control', 'placeholder' => 'Dari Tgl. Pengeluaran']) ?>
            </div>
            <div class="col-2">
                <label>Sampai Tgl. Pengeluaran</label>
                <?= \Core\Form::input('date', 'to_date', ['class' => 'form-control', 'placeholder' => 'Sampai Tgl. Pengeluaran']) ?>
            </div>
            <div class="col-2">
                <label>Customer</label>
                <?= \Core\Form::input('options-obj:mst_customers,id,name', 'customer_id', ['class' => 'form-control', 'placeholder' => 'Pilih customer', 'required' => '']) ?>
            </div>
            <div class="col-2">
                <label>Karyawan</label>
                <?= \Core\Form::input('options-obj:mst_employees,id,name', 'employee_id', ['class' => 'form-control', 'placeholder' => 'Pilih Karyawan', 'required' => '']) ?>
            </div>
            <div class="col-2">
                <label>Status</label>
                <?= \Core\Form::input('options:NEW|APPROVE|CANCEL', 'status', ['class' => 'form-control', 'placeholder' => 'Pilih Status', 'required' => '']) ?>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Submit</button>
            <button class="btn btn-success">Export XLS</button>
        </div>

        <div class="table-responsive my-4">
            <table class="table table-striped datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Pengeluaran</th>
                        <th>Tgl. Pengeluaran</th>
                        <th>No. Order</th>
                        <th>Customer</th>
                        <th>Karyawan</th>
                        <th>Jumlah</th>
                        <th>Nilai Pengeluaran</th>
                        <th>Status</th>
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
                            <td><?= $order->code ?></td>
                            <td><?= $customer->name ?></td>
                            <td><?= $employee->name ?></td>
                            <td><?= $item->total_outgoing_items . " / " . $item->total_outgoing_qty . $unit ?></td>
                            <td>Rp. <?= number_format($item->total_outgoing_value) ?></td>
                            <td><?= $item->status ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


        <div>
            <h6>Total Item(s) : <?= array_sum(array_column($data, 'total_outgoing_items')); ?> Item(s)</h6>
            <h6>Total Qty : <?= array_sum(array_column($data, 'total_outgoing_qty')); ?> <?= $unit ?></h6>
            <h6>Total Pengeluaran : Rp. <?= number_format(array_sum(array_column($data, 'total_outgoing_value'))); ?></h6>
        </div>
    </div>
</div>
<?php get_footer() ?>