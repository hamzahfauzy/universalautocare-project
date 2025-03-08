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
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <div class="table-responsive my-4">
            <?php require 'table/'.str_replace(' ', '-', strtolower($_GET['filter']['cash_group'])).'.php' ?>
        </div>
    </div>
</div>
<?php get_footer() ?>