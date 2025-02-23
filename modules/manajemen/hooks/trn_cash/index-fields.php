<?php

if(isset($_GET['filter']))
{
    $cash_group = $_GET['filter']['cash_group'];
    if($cash_group != 'PENERIMAAN KAS')
    {
        unset($fields['police_number_reference']);
    }
    
    if($cash_group == 'PENERIMAAN KAS')
    {
        $fields['reference_number']['label'] = 'No. Referensi (No. Order)';
        $fields['reference_date']['label'] = 'Tgl. Order';
        $fields['reference_name']['label'] = 'Customer Order';
        $fields['police_number_reference']['label'] = 'No. Polisi';
        $fields['total_payment']['label'] = 'Nilai Terima Kas';
        $fields['cash_total']['label'] = 'Total Terima Kas (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Order';
    }
    
    if($cash_group == 'PENGELUARAN KAS')
    {
        $fields['reference_number']['label'] = 'No. Referensi (No. Pembelian)';
        $fields['reference_date']['label'] = 'Tgl. Pembelian';
        $fields['reference_name']['label'] = 'Supplier Pembelian';
        $fields['total_payment']['label'] = 'Nilai Keluar Kas';
        $fields['cash_total']['label'] = 'Total Kas Keluar (Bayar)';
        $fields['total_value']['label'] = 'Total Nilai Pembelian';
    }

    if($cash_group == 'BIAYA KAS')
    {
        unset($fields['reference_name']);
        unset($fields['reference_date']);
        unset($fields['total_value']);
        $fields['reference_number']['label'] = 'No. Referensi (Biaya)';
        $fields['total_payment']['label'] = 'Nilai Biaya Kas';
        $fields['cash_total']['label'] = 'Total Biaya Kas (Bayar)';
    }
}

return $fields;