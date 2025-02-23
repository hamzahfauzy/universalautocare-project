<?php
$date = \Core\Form::getData('date', $order->date);
$doneDate = \Core\Form::getData('date', $order->done_date);
?>
<pre>
<div style="width:230px">
<center>
    <img src="<?= getSidebarLogo() ?>" alt="" width="100" height="81">
</center>
</div>
--------------------------------
<?= centerText("UNIVERSAL AUTO CARE", 32) ?>

<?= centerText("Jl. Pabrik Tenun Medan", 32) ?>

<?= centerText("0813-9607-8292", 32) ?>

<?= centerText("Sumatera Utara", 32) ?>

<?= centerText("INVOICE", 32) ?>

--------------------------------
NO ORDER : <?= renderRight('#' . $order->code, 31 - strlen("NO ORDER :")) ?>

--------------------------------
<?= centerText("Item(s) Jasa", 32) ?>

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
Total Barang <?= renderRight('Rp. ' . number_format($order->total_item_value), 31 - strlen("Total Barang")) ?>

Total Jasa <?= renderRight('Rp. ' . number_format($order->total_service_value),  31 - strlen("Total Jasa")) ?>

--------------------------------
Grand Total <?= renderRight('Rp. ' . number_format($order->total_value), 31 - strlen("Grand Total")) ?>

--------------------------------
<?= centerText('Notes', 32) ?>

<?= centerText('Harap tidak meninggalkan barang berharga', 32) ?>

<?= centerText('Segala kehilangan bukan merupakan tanggung jawab Universal Auto Care', 32) ?>


<?= centerText('Terima Kasih Atas Kunjungan Anda', 32) ?>

<?= centerText(date('d-m-Y H:i:s'), 32) ?>
</pre>