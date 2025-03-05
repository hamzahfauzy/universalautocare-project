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
        $fields['code']['label'] = 'No. Terima Kas';
        $fields['date']['label'] = 'Tgl. Terima Kas';
        $fields['cash_type']['label'] = 'Tipe';
        $fields['cash_resource']['label'] = 'Sumber';
        $fields['reference_number']['label'] = 'Referensi';
        $fields['total_payment']['label'] = 'Penerimaan Kas';
        $fields['total_payment']['type'] = 'text';

        unset($fields['reference_name']);
        unset($fields['reference_date']);
        unset($fields['police_number_reference']);
        unset($fields['cash_total']);
        unset($fields['total_value']);
        unset($fields['bank_id']);
        unset($fields['description']);
        // $fields['reference_number']['label'] = 'No. Referensi (No. Order)';
        // $fields['reference_date']['label'] = 'Tgl. Order';
        // $fields['reference_name']['label'] = 'Customer Order';
        // $fields['police_number_reference']['label'] = 'No. Polisi';
        // $fields['cash_total']['label'] = 'Total Terima Kas (Bayar)';
        // $fields['total_value']['label'] = 'Total Nilai Order';
    }
    
    if($cash_group == 'PENGELUARAN KAS')
    {
        $fields['code']['label'] = 'No. BPK';
        $fields['date']['label'] = 'Tgl. BPK';
        $fields['cash_type']['label'] = 'Tipe';
        $fields['cash_resource']['label'] = 'Sumber';
        $fields['reference_number']['label'] = 'Referensi';
        $fields['total_payment']['label'] = 'Pengeluaran Kas';
        $fields['total_payment']['type'] = 'text';

        unset($fields['reference_name']);
        unset($fields['reference_date']);
        unset($fields['police_number_reference']);
        unset($fields['cash_total']);
        unset($fields['total_value']);
        unset($fields['bank_id']);
        unset($fields['description']);
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