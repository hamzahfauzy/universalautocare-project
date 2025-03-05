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
    }

    if($cash_group == 'BIAYA KAS')
    {
        $fields['code']['label'] = 'No. Biaya';
        $fields['date']['label'] = 'Tgl. Biaya';
        $fields['cash_type']['label'] = 'Tipe';
        $fields['cash_resource']['label'] = 'Sumber';
        $fields['reference_number']['label'] = 'Referensi';
        $fields['total_payment']['label'] = 'Biaya Kas';
        $fields['total_payment']['type'] = 'text';
    }

    unset($fields['reference_name']);
    unset($fields['reference_date']);
    unset($fields['police_number_reference']);
    unset($fields['cash_total']);
    unset($fields['total_value']);
    // unset($fields['bank_id']);
    unset($fields['description']);
}

return $fields;