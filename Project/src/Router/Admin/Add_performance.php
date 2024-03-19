<?php 
include '../../Config/Database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && isset($_POST["event_name"])) {
    $event_name = $_POST["event_name"];
    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

    try {
        
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $insert_query = "INSERT INTO performance (picture_work, name_event) VALUES (:image, :event_name)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(":image", $image_data, PDO::PARAM_LOB);
        $insert_stmt->bindParam(":event_name", $event_name, PDO::PARAM_STR);
        $insert_stmt->execute();

            $_SESSION['addperformance'] = 'เพิ่มผลงานจัดงานอีเว้นเรียบร้อยแล้ว';
             header("Location: ../../View/Admin/Eventmanagement/Performance.php");
             exit;
         } catch (PDOException $e) {
             $_SESSION['addperformance2'] = 'เกิดข้อผิดพลาดในเพิ่มผลงาน';
             header("Location: ../../View/Admin/Eventmanagement/Performance.php");
             exit;
    }
}
?>


