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
            <div class="col-3">
                <label>Periode Tgl. Pembelian</label>
                <?= \Core\Form::input('month', 'month', ['class' => 'form-control filters', 'placeholder' => 'Periode Tgl. Pembelian', 'value'=>date("Y-m")]) ?>
            </div>
            <div class="col-3">
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
                        <th>Tgl. Pembelian</th>
                        <th>Jlh. Pembelian</th>
                        <th>Jlh. Item(s)</th>
                        <th>Jlh. Qty</th>
                        <th>Total Pembelian</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>