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
            <div class="col-3">
                <div class="row">
                    <div class="col-6">
                        <label>Dari Tgl. Order</label>
                        <?= \Core\Form::input('date', 'from_date', ['class' => 'form-control', 'placeholder' => 'Dari Tgl. Order']) ?>
                    </div>
                    <div class="col-6">
                        <label>Sampai Tgl. Order</label>
                        <?= \Core\Form::input('date', 'to_date', ['class' => 'form-control', 'placeholder' => 'Sampai Tgl. Order']) ?>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-2">
                        <label>Customer</label>
                        <?= \Core\Form::input('options-obj:mst_customers,id,name', 'customer_id', ['class' => 'form-control', 'placeholder' => 'Pilih Customer', 'required' => '']) ?>
                    </div>
                    <div class="col-2">
                        <label>Karyawan</label>
                        <?= \Core\Form::input('options-obj:mst_employees,id,name', 'employee_id', ['class' => 'form-control', 'placeholder' => 'Pilih Karyawan', 'required' => '']) ?>
                    </div>
                    <div class="col-2">
                        <label>Partner</label>
                        <?= \Core\Form::input('options-obj:mst_partners,id,name', 'partner_id', ['class' => 'form-control', 'placeholder' => 'Pilih Partner', 'required' => '']) ?>
                    </div>
                    <div class="col-2">
                        <label>Order</label>
                        <?= \Core\Form::input('options-obj:trn_orders,id,code', 'order_id', ['class' => 'form-control', 'placeholder' => 'Pilih Order', 'required' => '']) ?>
                    </div>
                    <div class="col-2">
                        <label>Status</label>
                        <?= \Core\Form::input('options:NEW|APPROVE|CANCEL', 'status', ['class' => 'form-control', 'placeholder' => 'Pilih Status', 'required' => '']) ?>
                    </div>
                </div>
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
                        <th>Jenis Order</th>
                        <th>No. Order</th>
                        <th>Tgl. Order</th>
                        <th>Tgl. Est Selesai</th>
                        <th>Customer</th>
                        <th>Karyawan</th>
                        <th>Partner</th>
                        <th>Nilai Order</th>
                        <th>Nilai Barang</th>
                        <th>Nilai Jasa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):
                        $customer = $db->single('mst_customers', ['id' => $item->customer_id]);
                        $employee = $db->single('mst_employees', ['id' => $item->employee_id]);
                        $partner = $db->single('mst_partners', ['id' => $item->partner_id]);
                    ?>
                        <tr>
                            <td><?= $item->order_type ?></td>
                            <td><?= $item->code ?></td>
                            <td><?= $item->date ?></td>
                            <td><?= $item->done_date ?></td>
                            <td><?= $customer->name ?></td>
                            <td><?= $employee->name ?></td>
                            <td><?= $partner->name ?></td>
                            <td><?= number_format($item->total_value) ?></td>
                            <td><?= number_format($item->total_item_value) ?></td>
                            <td><?= number_format($item->total_service_value) ?></td>
                            <td><?= $item->status ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


        <div>
            <h6>Total Barang : Rp. <?= number_format(array_sum(array_column($data, 'total_item_value'))); ?></h6>
            <h6>Total Jasa : Rp. <?= number_format(array_sum(array_column($data, 'total_service_value'))); ?></h6>
            <h6>Total Order : Rp. <?= number_format(array_sum(array_column($data, 'total_value'))); ?></h6>
        </div>
    </div>
</div>
<?php get_footer() ?>