<table class="table table-striped datatable" style="width:100%">
    <thead>
        <tr>
            <th>No. Terima Kas</th>
            <th>Tgl. Terima Kas</th>
            <th>Tipe</th>
            <th>Sumber</th>
            <th>Referensi</th>
            <th>Penerimaan Kas</th>
            <th>Bank</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?= $item->noterimakas ?></td>
                <td><?= $item->tglterimakas ?></td>
                <td><?= $item->cash_type ?></td>
                <td><?= $item->cash_resource ?></td>
                <td>
                    <?= $item->reference_number ?> / <?=$item->reference_date?><br>
                    <?= $item->reference_name?> / <?= $item->police_number_reference ?>
                </td>
                <td>DISC <?=number_format($item->discount)?> / <?= number_format($item->total_payment) ?><br> <?= number_format($item->cash_total) ?></td>
                <td><?=$item->namabank?></td>
                <td>
                    <a class="btn btn-sm btn-danger" href="<?= routeTo('manajemen/status/cash/cancel', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>