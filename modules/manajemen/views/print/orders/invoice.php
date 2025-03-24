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

<?= centerText("Jl. Sampul No. 29 Medan", 32) ?>

<?= centerText("0811-6127-988", 32) ?>

<?= centerText("Sumatera Utara", 32) ?>


<?= centerText("INVOICE", 32) ?>

--------------------------------
NO. ORDER : <?= renderRight('#' . $order->code, 31 - strlen("NO. ORDER :")) ?>

TGL. ORDER : <?= renderRight(date('d-m-Y', strtotime($order->date)), 31 - strlen("TGL. ORDER :")) ?>

KARYAWAN : <?=substr($order->employee->name,0,10)?> <?= renderRight(date('d-m-Y', strtotime($order->done_date)), 31 - strlen("KARYAWAN : ".substr($order->employee->name,0,10))) ?>

--------------------------------
<?=substr($order->customer->name,0,20)?> <?= renderRight($order->customer->phone, 31 - strlen(substr($order->customer->name,0,20)))?> 
<?=substr($order->partner->name,0,20)?> <?= renderRight($order->customer_police_number, 31 - strlen(substr($order->partner->name,0,20)))?> 
--------------------------------
<?= centerText("Deskripsi Item(s)", 32) ?>

--------------------------------
<?php
$total = 0;
$qty = 0;
foreach ($order->items as $index => $item):
    $total += $item->total_price;
    $qty += $item->qty;
    $service = $db->single('mst_services', ['id' => $item->service_id]);
?>
#<?= wordwrap($service->name, 32, "\n", true); ?>

x <?= $item->qty ?> <?= $item->unit ?> @<?=number_format($item->price)?> <?= renderRight('Rp. '.number_format($item->total_price), 31 - strlen('x '.$item->qty.' '.$item->unit.' @'.number_format($item->price))) ?>
<?php if(end($order->items) != $item): ?>

................................
<?php endif ?>
<?php endforeach ?>

--------------------------------
Total <?= renderRight('Rp. ' . number_format($order->total_value), 31 - strlen("Total")) ?>

Pembayaran <?= renderRight('Rp. ' . number_format($order->total_payment), 31 - strlen("Pembayaran")) ?>

--------------------------------
Sisa/Lunas <?= renderRight('Rp. ' . number_format($order->total_value-$order->total_payment), 31 - strlen("Sisa/Lunas")) ?>

--------------------------------

<?= centerText('Notes', 32) ?>

<?= centerText('Harap tidak meninggalkan barang berharga', 32) ?>

<?= centerText('Segala kehilangan bukan merupakan tanggung jawab Universal Auto Care', 32) ?>


<?= centerText('Terima Kasih Atas Kunjungan Anda', 32) ?>

<?= centerText(date('d-m-Y H:i:s'), 32) ?>
</pre>