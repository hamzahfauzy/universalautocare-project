<table class="table table-striped datatable" style="width:100%">
    <thead>
        <tr>
            <th>No. Biaya</th>
            <th>Tgl. Biaya</th>
            <th>Tipe</th>
            <th>Sumber</th>
            <th>Referensi</th>
            <th>Biaya Kas</th>
            <th>Bank</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?= $item->nobiaya ?></td>
                <td><?= $item->tglbiaya ?></td>
                <td><?= $item->cash_type ?></td>
                <td><?= $item->cash_resource ?></td>
                <td>
                    <?= $item->reference_number ?>
                </td>
                <td>DISC <?=number_format($item->discount)?> / <?= number_format($item->total_payment) ?><br> <?= number_format($item->cash_total) ?></td>
                <td><?=$item->namabank?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?= routeTo('manajemen/status/cash/new', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan set new data ini ?')"><i class="fa-solid fa-ban"></i> New</a>
                    <a class="btn btn-sm btn-success" href="<?= routeTo('manajemen/status/cash/approve', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan approve data ini ?')"><i class="fa-solid fa-check"></i> Approve</a>
                    <a class="btn btn-sm btn-danger" href="<?= routeTo('manajemen/status/cash/cancel', ['id' => $item->id]) ?>" onclick="return confirm('Apakah anda yakin akan mengcancel data ini ?')"><i class="fa-solid fa-ban"></i> Cancel</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>