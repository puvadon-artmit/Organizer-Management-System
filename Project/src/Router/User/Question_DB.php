<?php
session_start();
include '../../Config/Database.php';

if (isset($_POST['question'])) {
    $question = $_POST['question'];
    
    // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
    if (isset($_SESSION['user_login']) || isset($_SESSION['admin_login']) || isset($_SESSION['organizer_login'])) {
        if (empty($question)) {
            $_SESSION['error'] = 'กรุณากรอกคำถาม';
            header("Location: ../../View/User/Question.php");
            exit;
        } else {
            $user_id = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : null;
            $status = 'pending'; // กำหนดสถานะของคำถามเป็น 'pending'
            
            try {
                $insert_question = $conn->prepare("INSERT INTO questions (user_id, question, status, created_at) VALUES (:user_id, :question, :status, NOW())");
                $insert_question->bindParam(":user_id", $user_id);
                $insert_question->bindParam(":question", $question);
                $insert_question->bindParam(":status", $status);
                $insert_question->execute();
                

                $update_status = $conn->prepare("UPDATE event_order SET order_status = '4' WHERE orderID = :orderID");
                        $update_status->bindParam(":orderID", $orderID);
                        $update_status->execute();
                // คำถามถูกเพิ่มลงในตาราง questions แล้ว
                
                $_SESSION['success2'] = 'คำถามถูกส่งเรียบร้อยแล้ว';
                header("Location: ../../View/User/Question.php");
                exit;
            } catch (PDOException $e) {
                $_SESSION['error2'] = 'เกิดข้อผิดพลาดในการส่งคำถาม';
                header("Location: ../../View/User/Question.php");
                exit;
            }
        }
    } else {
        $_SESSION['error2'] = 'กรุณาเข้าสู่ระบบก่อนโพสต์คำถาม';
        header("Location: login.php");
        exit;
    }
}
?>

