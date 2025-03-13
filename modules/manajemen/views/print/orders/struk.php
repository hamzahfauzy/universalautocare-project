<style>
h2, h3 {
    margin:0;
    padding:0;
}
.header-table {
    font-weight: bold;
}

.header-table td {
    padding-bottom: 8px;
}

.dashed-cell {
    border-top:1px dashed #000;
    border-bottom:1px dashed #000;
}

table.item {
    padding-bottom: 8px;
    border-bottom:1px dashed #000;
}

table.item td {
    padding-left:10px;
    padding-right:10px;
    padding-top:8px;
}

.text-right {
    text-align: right;
}
</style>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td width="300">
            <h3>UNIVERSAL AUTOCARE</h3>
            JL. PABRIK TENUN MEDAN<br>
            0813-9607-8292<br>
            SUMATERA UTARA
        </td>
        <td width="300">
            <b>NO ORDER :</b> <?=$code ?> / <?= $data->employee->name ?><br>
            <b>TGL ORDER :</b> <?= $data->date ?><br>
            <b>TGL EST SELESAI :</b> <?= $data->done_date ?><br>
            <b>PARTNER :</b> <?= $data->partner->name ?><br>
        </td>
        <td width="130" style="vertical-align: bottom;" class="text-right">
            <h2>INVOICE</h2>
        </td>
    </tr> 
</table>
<br>
<table class="item" cellpadding="5" cellspacing="0">
    <tr class="header-table">
        <td class="dashed-cell" width="350">KETERANGAN</td>
        <td class="dashed-cell">QTY</td>
        <td class="dashed-cell text-right" width="110">@HARGA</td>
        <td class="dashed-cell text-right" width="110">JUMLAH</td>
    </tr>
    <?php foreach ($items as $idx => $item): ?>
        <?php for($i=0;$i<10;$i++): ?>
    <tr>
        <td><?= $item['name'] ?></td>
        <td><?= $item['qty'] ?> <?= $item['unit'] ?></td>
        <td class="text-right">Rp. <?= number_format($item['price']) ?></td>
        <td class="text-right">Rp. <?= number_format($item['total_price']) ?></td>
    </tr>
        <?php endfor ?>
    <?php endforeach ?>
</table>
<br>
<table cellpadding="5" cellspacing="0">
    <tr>
        <td width="550">
            <b>CUSTOMER :</b> <?= $data->customer->name ?> (<?= $data->customer->phone ?>)<br>
            <b>NO PLAT/POLISI :</b> <?= $data->customer_police_number ?><br>
            <b>KENDARAAN :</b> <?= $data->customer_vehicle_type ?> / <?= $data->customer_vehicle_color ?>
        </td>
        <td>
            <b>TOTAL</b> <br> 
            <b>BAYAR</b> <br>
            <b>SISA</b> <br>
        </td>
        <td class="text-right" width="135">
            Rp. <?= number_format($data->total_value) ?><br>
            Rp. <?= number_format($data->total_payment) ?><br>
            Rp. <?= number_format($data->total_value-$data->total_payment) ?>
        </td>
    </tr>
</table>