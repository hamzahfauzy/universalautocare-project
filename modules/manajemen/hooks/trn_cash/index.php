<?php

$having = "";

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$where = $where ." ". $having;

$this->db->query = "SELECT 
                        $this->table.*,
                        CASE 
                            WHEN cash_group = 'PENERIMAAN KAS' THEN CONCAT(reference_number, ' / ', reference_date, '<br>', reference_name, ' / ', police_number_reference)
                            WHEN cash_group = 'PENGELUARAN KAS' THEN CONCAT(reference_number, ' / ', reference_date, '<br>', reference_name)
                            WHEN cash_group = 'BIAYA KAS' THEN CONCAT(reference_number, '<br>', description)
                            ELSE reference_number
                        END reference_number,
                        CONCAT('DISC ', FORMAT(discount, 0), ' / ', FORMAT(total_payment, 0), '<br>', FORMAT(cash_total, 0)) total_payment
                    FROM $this->table 
                    $where 
                    ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where);

return compact('data', 'total');