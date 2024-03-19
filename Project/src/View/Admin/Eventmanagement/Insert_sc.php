<?php
include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST["purport"], $_POST["start"], $_POST["end"], $_POST["detail_id"]) && !empty($_POST["purport"])) {
    $query = "
    INSERT INTO venue_schedule 
    (purport, start_event, end_event, detail_id) 
    VALUES (:purport, :start_event, :end_event, :detail_id)
    ";
    $statement = $connect->prepare($query);
    if ($statement->execute(
        array(
            ':purport' => $_POST['purport'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':detail_id' => $_POST['detail_id'] // ใช้ $_POST['detail_id'] ที่ส่งมาจาก AJAX
        )
    )) {
        echo "Data added successfully.";
    } else {
        echo "Error adding data: " . print_r($statement->errorInfo(), true);
    }
}
?>
