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

<form>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-7 d-flex" style="gap:8px">
                        <input type="date" class="form-control" name="filter[date]" value="<?= isset($_GET['filter']['date']) ? $_GET['filter']['date'] : date('Y-m-d') ?>" style="width:min-content">
                        <?= \Core\Form::input('options:- Pilih -|BENGKEL|DOORSMEER|RENTAL', 'filter[type]', ['class' => 'form-control', 'placeholder' => '- Pilih -', 'required' => '', 'style' => 'width:100%', 'value' => isset($_GET['filter']['type']) ? $_GET['filter']['type'] : '']) ?>
                        <button class="btn btn-info">Refresh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="m-0 p-0">Pembelian</h5>
                <p><?= $date ?></p>
                <b>Rp. <?=number_format($data['purchases']->total) ?></b>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="m-0 p-0">Job Order</h5>
                <p><?= $date ?></p>
                <b>Rp. <?=number_format($data['orders']->total) ?></b>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="m-0 p-0">Biaya Kas</h5>
                <p><?= $date ?></p>
                <b>Rp. <?=number_format($data['cash']->total) ?></b>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="m-0 p-0">Piutang</h5>
                <p><?= $date ?></p>
                <b>Rp. <?=number_format($data['piutang']->total) ?></b>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <table class="w-100">
                    <tr>
                        <td>
                            <canvas id="myChart1"></canvas>
                        </td>
                        <td style="text-align: right;">
                            <h5 class="m-0 p-0">Daily/Harian</h5>
                            <span><?= $date ?></span>
                            <div style="height: 200px;"></div>
                            <a href="<?=routeTo('manajemen/report/orders')?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <table class="w-100">
                    <tr>
                        <td>
                            <canvas id="myChart2"></canvas>
                        </td>
                        <td style="text-align: right;">
                            <h5 class="m-0 p-0">By Metode/Cara Bayar</h5>
                            <span><?= $date ?></span>
                            <div style="height: 200px;"></div>
                            <a href="<?=routeTo('manajemen/report/acsh')?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="min-height: 200px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">Last 10 Job Order</th>
                                <th><?= $date ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['lastOrders'] as $order): ?>
                            <tr>
                                <td><?=$order->tglorder?></td>
                                <td><?=$order->noorder?></td>
                                <td><?=$order->total_value?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?=routeTo('manajemen/report/orders')?>" class="btn btn-primary btn-sm">Detail</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mt-3">
        <div class="card">
            <div class="card-body">
                <table class="w-100">
                    <tr>
                        <td>
                            <canvas id="myChart3"></canvas>
                        </td>
                        <td style="text-align: right;">
                            <h5 class="m-0 p-0">By Jenis Order</h5>
                            <span><?= $date ?></span>
                            <div style="height: 200px;"></div>
                            <a href="<?=routeTo('manajemen/report/orders')?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
