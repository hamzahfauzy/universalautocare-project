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

        <div class="row">
            <div class="col">
                <label>Dari Tgl. Pengeluaran</label>
                <?= \Core\Form::input('date', 'start_date', ['class' => 'form-control filters', 'placeholder' => 'Dari Tgl. Pengeluaran']) ?>
            </div>
            <div class="col">
                <label>Sampai Tgl. Pengeluaran</label>
                <?= \Core\Form::input('date', 'end_date', ['class' => 'form-control filters', 'placeholder' => 'Sampai Tgl. Pengeluaran']) ?>
            </div>
            <div class="col">
                <label>Customer</label>
                <?= \Core\Form::input('options-obj:mst_customers,name,name', 'customer_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih customer', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Karyawan</label>
                <?= \Core\Form::input('options-obj:mst_employees,name,name', 'employee_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih Karyawan', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Status</label>
                <?= \Core\Form::input('options:- Pilih -|NEW|APPROVE|CANCEL', 'status', ['class' => 'form-control', 'placeholder filters' => 'Pilih Status', 'required' => '']) ?>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary" onclick="window.reportData.draw()">Submit</button>
            <button class="btn btn-success" onclick="downloadReport()">Export XLS</button>
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
                    <?php foreach ([] as $item):
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
    </div>
</div>
<?php get_footer() ?>