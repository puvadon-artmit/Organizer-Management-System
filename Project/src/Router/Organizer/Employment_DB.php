<?php
session_start();
include '../../Config/Database.php';

if (isset($_POST['employment'])) {
    $orderID = $_POST['orderID']; // อีเว้นท์ที่จ้างงาน
    $job_price = $_POST['job_price']; // ค่าตอบแทน
    $event_date = $_POST['event_date']; // วัน-เวลา จัดงานอีเว้นท์
    $job_dt = $_POST['job_dt']; // รายละเอียดงาน
    $job_status = 'pending';

    // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่

        $organizer_id = $_GET['organizer_id']; // เก็บค่า organizer_id จาก URL parameter (query string)

        try {
            $insert_employment = $conn->prepare("INSERT INTO employment (event_date, job_dt, job_price, organizer_id, orderID, job_status) VALUES (:event_date, :job_dt, :job_price, :organizer_id, :orderID, :job_status)");
    $insert_employment->bindParam(":event_date", $event_date);
    $insert_employment->bindParam(":job_dt", $job_dt);
    $insert_employment->bindParam(":job_price", $job_price);
    $insert_employment->bindParam(":organizer_id", $organizer_id);
    $insert_employment->bindParam(":orderID", $orderID);
    $insert_employment->bindParam(":job_status", $job_status); // ผูกค่า job_status เข้ากับ :job_status
    $insert_employment->execute();

           

            $_SESSION['success8'] = 'การจ้างจัดงานอีเว้นท์ถูกส่งเรียบร้อยแล้ว';
            header("Location: ../../View/Admin/Employ/Employment.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error8'] = 'เกิดข้อผิดพลาดในการจ้างจัดงานอีเว้นท์';
            header("Location: ../../View/Admin/Employ/Employment.php");
            exit;
        }
    } else {
        $_SESSION['error8'] = 'กรุณาเข้าสู่ระบบก่อนโพสต์คำถาม';
        header("Location: login.php");
        exit;
    }

?>