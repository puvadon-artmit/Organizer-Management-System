<?php
session_start();
include '../../Config/Database.php';

if (isset($_POST['reply']) && isset($_POST['question_id'])) {
    $reply = $_POST['reply'];
    $question_id = $_POST['question_id'];

    if (empty($reply)) {
        $_SESSION['error2'] = 'กรุณากรอกคำตอบ';
        header("Location: ../../View/Admin/Questions/Replies.php");
        exit;
    } else {
        try {
            $insert_reply = $conn->prepare("INSERT INTO replies (question_id, reply, reply_time) VALUES (:question_id, :reply, NOW())");
            $insert_reply->bindParam(":question_id", $question_id);
            $insert_reply->bindParam(":reply", $reply);
            $insert_reply->execute();
            
            // Update the status of the question to "answered" in the questions table
            $update_status = $conn->prepare("UPDATE questions SET status = 'answered' WHERE question_id = :question_id");
            $update_status->bindParam(":question_id", $question_id);
            $update_status->execute();

            // Reply has been successfully added to the replies table
            $_SESSION['success3'] = 'คำตอบถูกส่งเรียบร้อยแล้ว';
            header("Location: ../../View/Admin/Questions/View_questions.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error3'] = 'เกิดข้อผิดพลาดในการส่งคำตอบ';
            header("Location: ../../View/Admin/Questions/Replies.php");
            exit;
        }
    }
}
?>
