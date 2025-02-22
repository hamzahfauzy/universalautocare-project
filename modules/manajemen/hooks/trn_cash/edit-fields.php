<?php

if(isset($_GET['filter']))
{
    $cash_group = $_GET['filter']['cash_group'];
    $code = ['PENGELUARAN KAS' => 'BPK', 'PENERIMAAN KAS' => 'KAS', 'BIAYA KAS' => 'COST'];
    $referenceType = ['PENGELUARAN KAS' => 'trn_purchases,id,code', 'PENERIMAAN KAS' => 'trn_orders,id,code', 'BIAYA KAS' => 'mst_costs,id,name'];

    $fields['reference_number']['type'] = 'options-obj:'.$referenceType[$cash_group];

    if($cash_group == 'PENERIMAAN KAS')
    {
        $fields['reference_number']['label'] = 'No. Referensi (No. Order)';
        $fields['reference_date']['label'] = 'Tgl. Order';
        $fields['reference_name']['label'] = 'Customer Order';
        $fields['police_number_reference']['label'] = 'No. Polisi';
        $fields['total_payment']['label'] = 'Nilai Terima Kas';
        $fields['cash_total']['label'] = 'Total Terima Kas (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Order';
        
        $fields['police_number_reference']['attr']['col'] = 'col-6';
        $fields['description']['attr']['col'] = 'col-6';
        $fields['reference_date']['attr']['col'] = 'col-6';
        $fields['total_value']['attr']['col'] = 'col-6';
    }

    if($cash_group == 'PENGELUARAN KAS')
    {
        unset($fields['police_number_reference']);
        $fields['reference_number']['label'] = 'No. Referensi (No. Pembelian)';
        $fields['reference_date']['label'] = 'Tgl. Pembelian';
        $fields['reference_name']['label'] = 'Supplier Pembelian';
        $fields['total_payment']['label'] = 'Nilai Keluar Kas';
        $fields['cash_total']['label'] = 'Total Kas Keluar (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Pembelian';
        $fields['reference_date']['attr']['col'] = 'col-6';
        $fields['total_value']['attr']['col'] = 'col-6';
    }
    
    if($cash_group == 'BIAYA KAS')
    {
        unset($fields['police_number_reference']);
        unset($fields['reference_date']);
        unset($fields['total_value']);
        $fields['reference_name']['label'] = 'Nama Biaya';
        $fields['reference_number']['label'] = 'No. Referensi (ID Biaya)';
        $fields['total_payment']['label'] = 'Nilai Biaya Kas';
        $fields['cash_total']['label'] = 'Total Biaya Kas (Bayar)';
    }

    $fields['cash_type']['attr']['col'] = 'col-6';
    $fields['discount']['attr']['col'] = 'col-6';
    $fields['cash_resource']['attr']['col'] = 'col-6';
    $fields['total_payment']['attr']['col'] = 'col-6';
    $fields['bank_id']['attr']['col'] = 'col-6';
    $fields['cash_total']['attr']['col'] = 'col-6';
    $fields['reference_number']['attr']['col'] = 'col-6';
    $fields['reference_name']['attr']['col'] = 'col-6';
}

return $fields;