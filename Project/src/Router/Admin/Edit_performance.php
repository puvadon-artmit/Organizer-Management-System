<?php
include '../../Config/Database.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_name"])) {
    $new_event_name = $_POST["new_event_name"];
    $pfm_id = $_POST["pfm_id"];

    // Check if a file was uploaded
    if (isset($_FILES['new_picture']) && $_FILES['new_picture']['error'] === UPLOAD_ERR_OK) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $new_picture = file_get_contents($_FILES['new_picture']['tmp_name']);

            $update_query = "UPDATE performance SET name_event = :new_event_name, picture_work = :new_picture WHERE pfm_id = :pfm_id";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(":new_event_name", $new_event_name, PDO::PARAM_STR);
            $update_stmt->bindParam(":new_picture", $new_picture, PDO::PARAM_LOB);
            $update_stmt->bindParam(":pfm_id", $pfm_id, PDO::PARAM_INT);
            $update_stmt->execute();

           
             $_SESSION['success12'] = 'แก้ไขผลงานจัดงานอีเว้นเรียบร้อยแล้ว';
             header("Location: ../../View/Admin/Eventmanagement/Performance.php");
             exit;
         } catch (PDOException $e) {
             $_SESSION['error12'] = 'เกิดข้อผิดพลาดในแก้ไขผลงาน';
             header("Location: ../../View/Admin/Eventmanagement/Performance.php");
             exit;
        }
    }
}
?>
