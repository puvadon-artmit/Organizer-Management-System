<?php
include '../../../Config/Database.php';
include '../../Admin/Eventmanagement/Update_schedule.php';
session_start();

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$detail_id = $_GET['detail_id'];





$query = "SELECT * FROM venue_schedule WHERE detail_id = :detail_id ORDER BY Venue_id";
$statement = $connect->prepare($query);
$statement->bindParam(':detail_id', $_GET['detail_id'], PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetchAll();

$data = array();
foreach ($result as $row) {
    $data[] = array(
        'id' => $row["Venue_id"],
        'title' => $row["purport"],
        'start' => $row["start_event"],
        'end' => $row["end_event"],
        'detail_id' => $detail_id
    );
}

echo json_encode($data);

?>