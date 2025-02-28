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
                <label>Dari Tgl. Order</label>
                <?= \Core\Form::input('date', 'start_date', ['class' => 'form-control filters', 'placeholder' => 'Dari Tgl. Order']) ?>
            </div>
            <div class="col">
                <label>Sampai Tgl. Order</label>
                <?= \Core\Form::input('date', 'end_date', ['class' => 'form-control filters', 'placeholder' => 'Sampai Tgl. Order']) ?>
            </div>
            <div class="col">
                <label>Customer</label>
                <?= \Core\Form::input('options-obj:mst_customers,name,name', 'customer_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih Customer', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Karyawan</label>
                <?= \Core\Form::input('options-obj:mst_employees,name,name', 'employee_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih Karyawan', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Partner</label>
                <?= \Core\Form::input('options-obj:mst_partners,name,name', 'partner_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih Partner', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Order</label>
                <?= \Core\Form::input('options:- Pilih -|BENGKEL|DOORSMEER', 'order_type', ['class' => 'form-control filters', 'placeholder' => 'Pilih Order', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Status</label>
                <?= \Core\Form::input('options:- Pilih -|NEW|APPROVE|CANCEL', 'status', ['class' => 'form-control filters', 'placeholder' => 'Pilih Status', 'required' => '']) ?>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>