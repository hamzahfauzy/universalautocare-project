<?php

use Core\Database;
use Core\Page;
use Core\Request;

$old        = get_flash_msg('old');
$error_msg  = get_flash_msg('error');
$db = new Database;

$date = isset($_GET['filter']['date']) ? $_GET['filter']['date'] : date('Y-m-d');
$orderType = isset($_GET['filter']['type']) && $_GET['filter']['type'] != '- Pilih -' ? " AND A.order_type = '".$_GET['filter']['type']."' " : "";

$db->query = "Select COALESCE(SUM(A.total_value), 0) As total From trn_purchases A Where A.date = '$date' And A.status = 'APPROVE'";
$purchases = $db->exec('single');

$db->query = "Select COALESCE(SUM(A.total_value), 0) As total From trn_orders A Where A.date = '$date' And A.status = 'APPROVE' $orderType";
$orders = $db->exec('single');

$db->query = "Select COALESCE(SUM(A.total_value), 0) As total From trn_cash A Where A.date = '$date' And A.status = 'APPROVE' And A.cash_group = 'BIAYA KAS'";
$cash = $db->exec('single');

$db->query = "Select COALESCE(SUM(A.total_value - Coalesce(A.total_payment, 0)), 0) As total From trn_orders A Where A.status = 'APPROVE' And A.total_value <> Coalesce(A.total_payment, 0) $orderType";
$piutang = $db->exec('single');

$db->query = "Select 'JobOrder' As Keterangan,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -7 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last7Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -7 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last7Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -6 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last6Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -6 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last6Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -5 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last5Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -5 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last5Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -4 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last4Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -4 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last4Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -3 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last3Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -3 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last3Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -2 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last2Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -2 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last2Trx,
SUM(Case When DATE_ADD(\"$date\", INTERVAL -1 DAY) = A.date And A.status = 'APPROVE' 
	Then A.total_value Else 0 End) As Last1Nilai,
Count(Case When DATE_ADD(\"$date\", INTERVAL -1 DAY) = A.date And A.status = 'APPROVE' 
	Then 1 Else 0 End) As Last1Trx
From trn_orders A";
$daily = $db->exec('single');

$db->query = "Select A.cash_resource, SUM(A.total_value) As NilaiBayar From trn_cash A Where A.date = '$date' And A.status = 'APPROVE' And A.cash_group = 'PENERIMAAN KAS' Group By A.cash_resource";
$paymentType = $db->exec('single') ?? [];

$db->query = "Select A.order_type, SUM(A.total_value) As NilaiJenisOrder From trn_orders A Where A.date = '$date' And A.status = 'APPROVE' $orderType Group By A.order_type";
$orderTypeData = $db->exec('single') ?? [];
// return $paymentType;

$db->query = "Select A.order_type, A.date As tglorder, A.code As noorder, A.customer_police_number, A.customer_vehicle_type, A.customer_vehicle_color, FORMAT(A.total_value, 0) total_value From trn_orders A Where A.date = '$date' And A.status = 'APPROVE' $orderType Order By A.id Desc Limit 10";
$lastOrders = $db->exec('all');

$dailyChart = [
    'labels' => [
        date('Y-m-d', strtotime('-7 days', strtotime($date))),
        date('Y-m-d', strtotime('-6 days', strtotime($date))),
        date('Y-m-d', strtotime('-5 days', strtotime($date))),
        date('Y-m-d', strtotime('-4 days', strtotime($date))),
        date('Y-m-d', strtotime('-3 days', strtotime($date))),
        date('Y-m-d', strtotime('-2 days', strtotime($date))),
        date('Y-m-d', strtotime('-1 days', strtotime($date))),
    ],
    'datasets' => [
        [
            'label' => 'Nilai',
            'data' => [
                (int) $daily?->Last7Nilai,
                (int) $daily?->Last6Nilai,
                (int) $daily?->Last5Nilai,
                (int) $daily?->Last4Nilai,
                (int) $daily?->Last3Nilai,
                (int) $daily?->Last2Nilai,
                (int) $daily?->Last1Nilai,
            ],
            // 'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
            // 'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1
        ],
        [
            'label' => 'Transaksi',
            'data' => [
                (int) $daily?->Last7Trx,
                (int) $daily?->Last6Trx,
                (int) $daily?->Last5Trx,
                (int) $daily?->Last4Trx,
                (int) $daily?->Last3Trx,
                (int) $daily?->Last2Trx,
                (int) $daily?->Last1Trx,
            ],
            // 'backgroundColor' => 'rgba(54, 235, 123, 0.5)',
            // 'borderColor' => 'rgba(54, 235, 123, 1)',
            'borderWidth' => 1
        ],
    ]
];

$paymentChart = [
    'labels' => $paymentType ? array_values(array_column((array) $paymentType, 'cash_resource')) : [],
    'data' => [
        [
            'label' => 'Metode Pembayaran',
            'data' => [12, 19], //$paymentType ? array_values(array_column((array) $paymentType, 'NilaiBayar')) : [],
            'borderWidth' => 1
        ]
    ]
];

$orderChart = [
    'labels' => $orderTypeData ? array_values(array_column((array) $orderTypeData, 'order_type')) : [],
    'data' => [
        [
            'label' => 'Tipe Order',
            'data' => [10, 20], // $orderTypeData ? array_values(array_column((array) $orderTypeData, 'NilaiJenisOrder')) : [],
            'borderWidth' => 1
        ]
    ]
];

$data = compact('purchases', 'orders', 'cash', 'piutang', 'lastOrders');

// page section
$title = 'Dashboard';
Page::setActive("manajemen.dashboard");
Page::setTitle($title);

Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>');
Page::pushFoot('<script src="'.asset('assets/manajemen/js/chart.js').'"></script>');
Page::pushFoot('<script>
const dailyChart = '.json_encode($dailyChart).';
const paymentChart = '.json_encode($paymentChart).';
const orderChart = '.json_encode($orderChart).';
chart("#myChart1", "bar", dailyChart)
chart("#myChart2", "pie", paymentChart)
chart("#myChart3", "pie", orderChart)
</script>');

return view('manajemen/views/dashboard/index', compact('error_msg', 'old', 'data', 'date'));
