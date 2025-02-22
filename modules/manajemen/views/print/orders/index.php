<?php

use Core\Database;

get_header();
$db = new Database();

$attr = 'form-control';

?>
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
        <?php if ($success_msg) : ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif ?>

        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group mb-3">
                <label class="mb-2 col-4">No. Order</label>
                <?= \Core\Form::input('options-obj:trn_orders,id,code|order_type,' . $_GET['filter']['order_type'], 'code', ['class' => 'form-control', 'placeholder' => 'Pilih Order', 'required' => '']) ?>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Cetak</button>
            </div>

        </form>
    </div>
</div>
<?php get_footer() ?>