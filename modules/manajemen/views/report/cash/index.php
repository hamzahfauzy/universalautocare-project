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
                <label>Dari Tgl. Kas</label>
                <?= \Core\Form::input('date', 'start_date', ['class' => 'form-control filters', 'placeholder' => 'Dari Tgl. Kas']) ?>
            </div>
            <div class="col">
                <label>Sampai Tgl. Kas</label>
                <?= \Core\Form::input('date', 'end_date', ['class' => 'form-control filters', 'placeholder' => 'Sampai Tgl. Kas']) ?>
            </div>
            <div class="col">
                <label>Kelompok</label>
                <?= \Core\Form::input('options:- Pilih -|PENERIMAAN KAS|PENGELUARAN KAS|BIAYA KAS', 'cash_group', ['class' => 'form-control filters', 'placeholder' => 'Pilih Kelompok', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Sumber</label>
                <?= \Core\Form::input('options:- Pilih -|CASH|TRANSFER|E-MONEY|BG (BILYET GIRO)', 'cash_resource', ['class' => 'form-control filters', 'placeholder' => 'Pilih Sumber', 'required' => '']) ?>
            </div>
            <div class="col">
                <label>Bank</label>
                <?= \Core\Form::input('options-obj:mst_banks,name,name', 'bank_name', ['class' => 'form-control filters', 'placeholder' => 'Pilih Bank', 'required' => '']) ?>
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
                        <th>Kelompok</th>
                        <th>No. Kas</th>
                        <th>Tgl. Kas</th>
                        <th>Tipe</th>
                        <th>Sumber</th>
                        <th>Bank</th>
                        <th>Referensi</th>
                        <th>Diskon</th>
                        <th>Nilai Kas</th>
                        <th>Total Kas</th>
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