<?php
include "../../Config/Database.php";
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);

$data = array();

$query = "SELECT * FROM schedule WHERE organizer_id = :organizer_id ORDER BY schedule_id";

$statement = $connect->prepare($query);
$statement->bindParam(':organizer_id', $_SESSION['user_id'], PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
    $data[] = array(
        'schedule_id' => $row["schedule_id"],
        'title' => $row["title"],
        'start' => $row["start_event"],
        'end' => $row["end_event"],
        'organizer_id' => $row["organizer_id"]
    );
}

echo json_encode($data);
?>
