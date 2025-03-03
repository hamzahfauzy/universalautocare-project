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

$query = "SELECT 
                $this->table.*, 
                CONCAT(date,' <br> ',done_date) order_date,
                CONCAT(mst_employees.name, ' <br>', mst_partners.name) employee,
                CONCAT(mst_customers.name,'<br>',$this->table.customer_police_number,' / ',mst_customers.phone,' / ',$this->table.customer_vehicle_type) customer,
                CONCAT('Barang : ', FORMAT($this->table.total_item_value,0), '<br>Jasa : ', FORMAT($this->table.total_service_value,0)) nilai_order
            FROM $this->table 
            LEFT JOIN mst_employees ON mst_employees.id = $this->table.employee_id
            LEFT JOIN mst_partners ON mst_partners.id = $this->table.partner_id
            LEFT JOIN mst_customers ON mst_customers.id = $this->table.customer_id
            $where ";

$db->query = $query;
$total = $this->db->exec('exists');

$db->query .= " ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');


return compact('data', 'total');