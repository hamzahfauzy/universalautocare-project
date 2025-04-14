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
                        <button name="filter[today]" class="btn btn-primary">Today</button>
                        <input type="date" class="form-control" name="filter[date]" value="<?= isset($_GET['filter']['date']) ? $_GET['filter']['date'] : '' ?>" style="width:min-content">
                        <?= \Core\Form::input('options:- Pilih -|BENGKEL|DOORSMEER|RENTAL', 'filter[type]', ['class' => 'form-control', 'placeholder' => 'Pilih Type', 'required' => '', 'multiple' => 'multiple', 'style' => 'width:100%']) ?>
                        <button name="filter[refresh]" class="btn btn-info">Refresh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5>Pembelian</h5>
                <p>02 Feb 2024</p>
                <b>Rp. 200.000</b>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5>Job Order</h5>
                <p>02 Feb 2024</p>
                <b>Rp. 200.000</b>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5>Biaya Kas</h5>
                <p>02 Feb 2024</p>
                <b>Rp. 200.000</b>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5>Piutang</h5>
                <p>02 Feb 2024</p>
                <b>Rp. 200.000</b>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

<script>
    $('select').select2();
</script>