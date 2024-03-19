<?php
include '../../Config/Database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['organizer_id'])) {
    $user_id = $_POST['organizer_id'];

    // อัปเดตค่า system_status เป็น 'block'
    $query = "UPDATE organizer SET system_status = 'block' WHERE organizer_id  = :user_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($statement->execute()) {
        // อัปเดตสำเร็จ
        header("Location: ../../View/Admin/Member/Allorganizer.php");
        exit();
    } else {
        // เกิดข้อผิดพลาด
        echo "Error updating user status.";
    }
}
?>
