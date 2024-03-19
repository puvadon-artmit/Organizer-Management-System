<?php
include '../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cause = $_POST['cause'];
    $orderID = $_POST['orderID'];

    // ทำความสะอาดข้อมูลและเตรียม SQL statement
    $cause = htmlspecialchars($cause);
    $orderID = intval($orderID); // แนะนำให้ใช้ intval() เพื่อป้องกัน SQL Injection

    // ทำการเพิ่มข้อมูลลงในตาราง cancel_event
    try {
        $sql = "INSERT INTO cancel_event (cause, orderID) VALUES (:cause, :orderID)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cause', $cause, PDO::PARAM_STR);
        $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $stmt->execute();

        // อัปเดตสถานะในตาราง event_order เป็นสถานะยกเลิกงาน (order_status = 4)
        $updateSql = "UPDATE event_order SET order_status = 6 WHERE orderID = :orderID";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $updateStmt->execute();

        header("Location: ../../User/Your_Event.php"); // ส่งกลับไปยังหน้าที่คุณต้องการ
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
