<style>
h2, h3 {
    margin:0;
    padding:0;
}
table.item tr:first-child td {
    font-weight: bold;
    border-top:1px dashed #000;
    border-bottom:1px dashed #000;
}

table.item {
    border-bottom:1px dashed #000;
}

table.item td {
    padding:10px;
}
</style>
<div style="width:750px;">
    <table width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <h3>UNIVERSAL AUTOCARE</h3>
                JL. PABRIK TENUN MEDAN<br>
                0813-9607-8292<br>
                SUMATERA UTARA
            </td>
            <td>
                <b>NO ORDER :</b> <?=$code ?> / <?= $data->employee->name ?><br>
                <b>TGL ORDER :</b> <?= $data->date ?><br>
                <b>TGL EST SELESAI :</b> <?= $data->done_date ?><br>
                <b>PARTNER :</b> <?= $data->partner->name ?><br>
            </td>
            <td style="vertical-align: bottom;">
                <h2>INVOICE</h2>
            </td>
        </tr>
    </table>
    <br>
    <table class="item" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td>KETERANGAN</td>
            <td>QTY</td>
            <td>@HARGA</td>
            <td>JUMLAH</td>
        </tr>
        <?php foreach ($items as $idx => $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['qty'] ?></td>
            <td>Rp. <?= number_format($item['price']) ?></td>
            <td>Rp. <?= number_format($item['total_price']) ?></td>
        </tr>
        <?php endforeach ?>
    </table>
    <br>
    <table width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <b>CUSTOMER :</b> <?= $data->customer->name ?> (<?= $data->customer->phone ?>)<br>
                <b>NO PLAT/POLISI :</b> <?= $data->customer_police_number ?><br>
                <b>KENDARAAN :</b> <?= $data->customer_vehicle_type ?> / <?= $data->customer_vehicle_color ?>
            </td>
            <td>
                <b>TOTAL :</b> Rp. <?= number_format($data->total_value) ?><br>
                <b>BAYAR :</b> Rp. <?= number_format($data->total_payment) ?><br>
                <b>SISA :</b> Rp. <?= number_format($data->total_value-$data->total_payment) ?>
            </td>
        </tr>
    </table>
</div>