<?php

use Core\Database;

if(isset($_GET['filter']))
{
    $cash_group = $_GET['filter']['cash_group'];
    $code = ['PENGELUARAN KAS' => 'BPK', 'PENERIMAAN KAS' => 'KAS', 'BIAYA KAS' => 'COST'];
    $referenceType = ['PENGELUARAN KAS' => 'options-obj:trn_purchases,code,code', 'PENERIMAAN KAS' => "options-obj:trn_orders,code,code|RAW(status = 'APPROVE' AND total_value <> COALESCE(total_payment,0))", 'BIAYA KAS' => 'options-obj:mst_costs,name,name'];

    $db = new Database;
    $db->query = "SELECT COUNT(*) as `counter` FROM trn_cash WHERE cash_group = '$cash_group' AND created_at LIKE '%" . date('Y-m') . "%'";
    $counter = $db->exec('single')?->counter ?? 0;
    
    $code = $code[$cash_group] . date('Ym') . sprintf("%04d", $counter + 1);
    $fields['code']['attr']['value'] = $code;

    $fields['reference_number']['type'] = $referenceType[$cash_group];

    if($cash_group == 'PENERIMAAN KAS')
    {
        $fields['reference_number']['label'] = 'No. Referensi (No. Order)';
        $fields['reference_date']['label'] = 'Tgl. Order';
        $fields['reference_name']['label'] = 'Customer Order';
        $fields['police_number_reference']['label'] = 'No. Polisi';
        $fields['cash_total']['label'] = 'Nilai Terima Kas';
        $fields['total_payment']['label'] = 'Total Terima Kas (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Order';
        
        $fields['police_number_reference']['attr']['col'] = 'col-6';
        $fields['description']['attr']['col'] = 'col-6';
        $fields['reference_date']['attr']['col'] = 'col-6';
        $fields['total_value']['attr']['col'] = 'col-6';
        $fields['reference_name']['attr']['col'] = 'col-6';
        $fields['reference_number']['attr']['col'] = 'col-6';
    }

    if($cash_group == 'PENGELUARAN KAS')
    {
        unset($fields['police_number_reference']);
        $fields['reference_number']['label'] = 'No. Referensi (No. Pembelian)';
        $fields['reference_date']['label'] = 'Tgl. Pembelian';
        $fields['reference_name']['label'] = 'Supplier Pembelian';
        $fields['cash_total']['label'] = 'Nilai Keluar Kas';
        $fields['total_payment']['label'] = 'Total Kas Keluar (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Pembelian';
        $fields['reference_date']['attr']['col'] = 'col-6';
        $fields['total_value']['attr']['col'] = 'col-6';
        $fields['reference_name']['attr']['col'] = 'col-6';
        $fields['reference_number']['attr']['col'] = 'col-6';
    }
    
    if($cash_group == 'BIAYA KAS')
    {
        unset($fields['police_number_reference']);
        unset($fields['reference_date']);
        unset($fields['reference_name']);
        unset($fields['total_value']);
        $fields['reference_number']['label'] = 'No. Referensi (Biaya)';
        $fields['cash_total']['label'] = 'Nilai Biaya Kas';
        $fields['total_payment']['label'] = 'Total Biaya Kas (Bayar)';
    }

    $fields['cash_type']['attr']['col'] = 'col-6';
    $fields['discount']['attr']['col'] = 'col-6';
    $fields['cash_resource']['attr']['col'] = 'col-6';
    $fields['total_payment']['attr']['col'] = 'col-6';
    $fields['bank_id']['attr']['col'] = 'col-6';
    $fields['cash_total']['attr']['col'] = 'col-6';
    
}

unset($fields['status']);

return $fields;