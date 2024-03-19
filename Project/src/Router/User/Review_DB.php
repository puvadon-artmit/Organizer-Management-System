<?php
session_start();
include '../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderID']) && isset($_POST['comment'])) {
    $orderID = $_POST['orderID'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
    if (isset($_SESSION['user_login']) || isset($_SESSION['admin_login']) || isset($_SESSION['organizer_login'])) {
        if (empty($comment)) {
            $_SESSION['error2'] = 'กรุณากรอกความคิดเห็น';
            header("Location: ../../View/User/Question.php");
            exit;
        } else {
            $user_id = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : null;

      try {
                // เพิ่มข้อมูลรีวิวลงในตาราง reviews
                $insert_review = $conn->prepare("INSERT INTO reviews (comment, user_id, orderID, rating) VALUES (:comment, :user_id, :orderID, :rating)");
                $insert_review->bindParam(":comment", $comment, PDO::PARAM_STR);
                $insert_review->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $insert_review->bindParam(":orderID", $orderID, PDO::PARAM_INT);
                $insert_review->bindParam(":rating", $rating, PDO::PARAM_INT);

                $insert_review->execute();

                 

                $_SESSION['success11'] = 'รีวิวจัดงานอีเว้นท์เรียบร้อยแล้ว';
                header("Location: ../../View/User/Operation.php");
                exit;
            } catch (PDOException $e) {
                $_SESSION['error11'] = 'เกิดข้อผิดพลาดในการส่งรีวิว';
                header("Location: ../../View/User/Operation.php");
                exit;
            }
        }
    } else {
        $_SESSION['error2'] = 'กรุณาเข้าสู่ระบบก่อนโพสต์รีวิว';
        header("Location: login.php");
        exit;
    }
}
?>
