<?php

include '../../Config/Database.php';

$venue_id = $_POST['venue_id'];
$update_time = $_POST['update_time'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE venue SET update_time = :update_time WHERE venue_id = :venue_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':update_time', $update_time);
    $stmt->bindParam(':venue_id', $venue_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
        echo "<script> window.location='../../View/Admin/Update_venue.php'; </script>";
    } else {
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ ".$stmt->errorInfo()[2]."'); </script>";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>