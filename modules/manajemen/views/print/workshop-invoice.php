<?php
$date = \Core\Form::getData('date', $order->date);
$doneDate = \Core\Form::getData('date', $order->done_date);
?>
<pre>
<div style="width:230px">
<center>
    <img src="<?= asset('assets/kaosful/img/logo.jpg') ?>" alt="" width="100" height="81">
</center>
</div>
--------------------------------
<?= centerText("UNIVERSAL AUTO CARE", 32) ?>

<?= centerText("Jl. Pabrik Tenun Medan", 32) ?>

<?= centerText("0813-9607-8292", 32) ?>

<?= centerText("Sumatera Utara", 32) ?>

<?= centerText("INVOICE", 32) ?>

--------------------------------
NO ORDER : #<?= $order->code ?> <?= renderRight($order->customer->name, 31 - strlen("NO ORDER : #" . $order->code)) ?>

<?= $date ?> <?= renderRight($order->customer->phone, 31 - strlen($date)) ?>

Tgl. Est. Selesai : <?= $doneDate ?>

--------------------------------
<?= centerText("Item(s) Order", 32) ?>

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

x <?= $item->qty ?> <?= $item->unit ?> @<?= number_format($item->price) ?> <?= renderRight("Rp. " . number_format($item->total_price), 31 - strlen('x ' . $item->qty . ' ' . $item->unit . ' @' . number_format($item->price))) ?>

................................
<?php endforeach ?>


Total Items <?= renderRight(count($order->items) . ' Item(s)', 20) ?>

Total Qty <?= renderRight($qty, 22) ?>

--------------------------------
Grand Total <?= renderRight('Rp. ' . number_format($total), 20) ?>

--------------------------------
Total Bayar <?= renderRight('Rp. ' . number_format($order->total_value), 20) ?>

Sisa <?= renderRight('Rp. ' . number_format($total - $order->total_value), 27) ?>

--------------------------------
<?= centerText('Terima kasih sudah berbelanja disini', 32) ?>

<?= centerText(date('d-m-Y H:i:s'), 32) ?>

<?= centerText("Barang yang sudah diorder tidak dapat ditukar atau dikembalikan", 32) ?>
</pre>