
<?php

include('database_connection.php');

$column = array('transportation_bill_id');

$query = "
SELECT * FROM transportation_bill 
";

if(isset($_POST['student_id']))
{
 $query .= '
 WHERE payment_type = "'.$_POST['student_id'].'" 
 ';
}


if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY `transportation_bill`.`transportation_bill_id` DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $pdo_conn->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $pdo_conn->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['bank_cr_sl_num'];
 $sub_array[] = $row['start_month_selection'];
 $sub_array[] = $row['month_duration'];
 $sub_array[] = $row['end_month_selection'];
 $sub_array[] = $row['payment_type'];
 $sub_array[] = $row['transportation_fee'];
 $sub_array[] = $row['fee_paid_date'];
 $data[] = $sub_array;
}

function count_all_data($pdo_conn)
{
 $query = "SELECT * FROM transportation_bill";
 $statement = $pdo_conn->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($pdo_conn),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);

?>
