<?php
$date = \Core\Form::getData('date', $order->date);
$doneDate = \Core\Form::getData('date', $order->done_date);
?>
<pre>
<div style="width:230px;margin:0;text-align:center">
<img src="<?= getSidebarLogo() ?>" alt="" height="81">
</div>
--------------------------------
<?= centerText("UNIVERSAL AUTO CARE", 32) ?>

<?= centerText("Jl. Pabrik Tenun Medan", 32) ?>

<?= centerText("0813-9607-8292", 32) ?>

<?= centerText("Sumatera Utara", 32) ?>


<?= centerText("ORDER", 32) ?>

<?= centerText($order->code, 32) ?>

--------------------------------
Tgl. Order <?= renderRight($date, 31 - strlen("Tgl. Order")) ?>

Tgl. Est. Selesai <?= renderRight($doneDate, 31 - strlen("Tgl. Est. Selesai")) ?>

Customer <?= renderRight($order->customer->name, 31 - strlen("Customer")) ?>

No. Telepon <?= renderRight($order->customer->phone, 31 - strlen("No. Telepon")) ?>

Karyawan <?= renderRight($order->employee->name, 31 - strlen("Karyawan")) ?>

Partner <?= renderRight($order->partner->name, 31 - strlen("Partner")) ?>

--------------------------------
<?= centerText("Deskripsi Kendaraan", 32) ?>

--------------------------------
No. Plat / Polisi <?= renderRight($order->customer_police_number, 31 - strlen("No. Plat / Polisi")) ?>

Jenis Kendaraan <?= renderRight($order->customer_vehicle_type, 31 - strlen("Jenis Kendaraan")) ?>

Warna Kendaraan <?= renderRight($order->customer_vehicle_color, 31 - strlen("Warna Kendaraan")) ?>

Keterangan
<?php if($order->description): ?>
<?= $order->description ?>
<?php endif ?>

--------------------------------

Pemilik/Pembawa <?= renderRight('Diterima Oleh', 31 - strlen("Pemilik/Pembawa")) ?>





--------------- <?= renderRight('---------------', 31 - strlen("---------------")) ?>

Nama & Ttd <?= renderRight('Nama & Ttd', 31 - strlen("Nama & Ttd")) ?>


--------------------------------
<?= centerText('Terima kasih atas kunjungan anda', 32) ?>

<?= centerText(date('d-m-Y H:i:s'), 32) ?>
</pre>