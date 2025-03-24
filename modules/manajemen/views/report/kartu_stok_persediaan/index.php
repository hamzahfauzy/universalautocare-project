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
                <label>Dari Tgl</label>
                <?= \Core\Form::input('date', 'start_date', ['class' => 'form-control filters', 'placeholder' => 'Dari Tgl']) ?>
            </div>
            <div class="col-3">
                <label>Sampai Tgl</label>
                <?= \Core\Form::input('date', 'end_date', ['class' => 'form-control filters', 'placeholder' => 'Sampai Tgl']) ?>
            </div>
            <div class="col-3">
                <label>Barang</label>
                <?= \Core\Form::input('options-obj:mst_items,id,name|item_type,1', 'item', ['class' => 'form-control filters', 'placeholder' => 'Pilih barang', 'required' => '']) ?>
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
                        <th>Tgl Transaksi</th>
                        <th>Jenis Transaksi</th>
                        <th>No Dokumen</th>
                        <th>Keterangan</th>
                        <th>Qty Beli</th>
                        <th>Qty Keluar</th>
                        <th>Saldo Persediaan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>