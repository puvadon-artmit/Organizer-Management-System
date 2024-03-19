<?php

session_start();
include '../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['orderID']) && is_numeric($_GET['orderID'])) {
        $orderID = intval($_GET['orderID']);
        $order_status = '5';

        // Update the job_status for the specified employment record
        $sql = "UPDATE event_order SET order_status = :order_status WHERE orderID = :orderID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':order_status', $order_status, PDO::PARAM_STR);
        $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        
        $stmt->execute();

        $_SESSION['success13'] = 'จัดงานอีเว้นท์สำเร็จ';
        header("Location: ../../View/Admin/Employ/All_employ.php");
        exit();
    }
}
