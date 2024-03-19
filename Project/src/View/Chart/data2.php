<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","project");

$sqlQuery = "SELECT SUM(total_price) as sumTotal,dateMonth FROM event_order GROUP BY dateMonth ORDER BY FIELD(dateMonth, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);

?>
