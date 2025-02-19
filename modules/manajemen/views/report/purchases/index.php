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
                <label>Dari Tgl. Pembelian</label>
                <?= \Core\Form::input('date', 'from_date', ['class' => 'form-control', 'placeholder' => 'Dari Tgl. Pembelian']) ?>
            </div>
            <div class="col-2">
                <label>Sampai Tgl. Pembelian</label>
                <?= \Core\Form::input('date', 'to_date', ['class' => 'form-control', 'placeholder' => 'Sampai Tgl. Pembelian']) ?>
            </div>
            <div class="col-2">
                <label>Supplier</label>
                <?= \Core\Form::input('options-obj:mst_suppliers,id,name', 'supplier_id', ['class' => 'form-control', 'placeholder' => 'Pilih supplier', 'required' => '']) ?>
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
            <table class="table table-striped datatable-crud" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Pembelian</th>
                        <th>Tgl. Pembelian</th>
                        <th>Supplier</th>
                        <th>Karyawan</th>
                        <th>Jumlah</th>
                        <th>Nilai Pembelian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):
                        $supplier = $db->single('mst_suppliers', ['id' => $item->supplier_id]);
                        $employee = $db->single('mst_employees', ['id' => $item->employee_id]);
                    ?>
                        <tr>
                            <td><?= $item->code ?></td>
                            <td><?= $item->date ?></td>
                            <td><?= $supplier->name ?></td>
                            <td><?= $employee->name ?></td>
                            <td><?= $item->total_item . " / " . $item->total_qty . $unit ?></td>
                            <td>Rp. <?= number_format($item->total_value) ?></td>
                            <td><?= $item->status ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


        <div>
            <h6>Total Item(s) : <?= array_sum(array_column($data, 'total_item')); ?> Item(s)</h6>
            <h6>Total Qty : <?= array_sum(array_column($data, 'total_qty')); ?> <?= $unit ?></h6>
            <h6>Total Pembelian : Rp. <?= number_format(array_sum(array_column($data, 'total_value'))); ?></h6>
        </div>
    </div>
</div>
<?php get_footer() ?>