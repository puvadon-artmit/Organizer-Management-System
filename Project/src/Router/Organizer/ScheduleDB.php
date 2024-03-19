<?php
include '../../Config/Database.php';
session_start(); // เปิดใช้งาน session

if (isset($_POST['Schedule'])) {
    // ตรวจสอบว่ามีค่า session ใน user_id และไม่ใช่ค่า null
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
       
        // รับค่าที่ส่งมาจากฟอร์ม
        $organizer_id = $_SESSION['user_id'];
        $work_schedule = $_POST['work_schedule']; 
        $detail_schedule = $_POST['detail_schedule'];

        try {
            $insert_schedule = $conn->prepare("INSERT INTO schedule (work_schedule, detail_schedule, organizer_id) VALUES (:work_schedule, :detail_schedule, :organizer_id)");
            $insert_schedule->bindParam(":work_schedule", $work_schedule);
            $insert_schedule->bindParam(":detail_schedule", $detail_schedule);
            $insert_schedule->bindParam(':organizer_id', $organizer_id); // Corrected binding variable
            $insert_schedule->execute();
    
            $_SESSION['success9'] = 'อัพตารางงานสำเร็จ';
            header("Location: ../../View/Organizer/Update_schedule.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error9'] = 'เกิดข้อผิดพลาดในการอัพตารางงาน: ' . $e->getMessage();
            header("Location: ../../View/Organizer/Update_schedule.php");
            exit;
        }
    } else {
        $_SESSION['error9'] = 'กรุณาเข้าสู่ระบบก่อนอัพตารางงาน';
        header("Location: login.php");
        exit;
    }
}
?>
