<?php
include '../../Config/Database.php';
session_start(); // เปิดใช้งาน session

try {
   
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // รับค่าจากฟอร์ม
        $orderID = $_GET["orderID"];
        $operation_at = date("Y-m-d H:i:s");
        $update_diy = $_POST["message"];

        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง `operation`
        $sql = "INSERT INTO `operation` (`orderID`, `operation_at`, `update_diy`)
                VALUES ('$orderID', '$operation_at', '$update_diy')";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            // หากเพิ่มข้อมูลสำเร็จ ให้ทำการ redirect หรือแสดงข้อความตามที่คุณต้องการ
            header('Location: ../../View/Admin/Employ/All_operation.php?success=1');
            exit();
        } else {
            // เกิดข้อผิดพลาดในการ execute คำสั่ง SQL
            echo "Error: Unable to insert data.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
