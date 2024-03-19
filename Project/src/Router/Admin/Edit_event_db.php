<?php
include '../../Config/Database.php';

$event_id = $_POST['event_id'];
$event_name = $_POST['event_name'];
$type_id = $_POST['type_id'];
$detail = $_POST['detail'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE event SET event_name = :event_name,
                type_id = :type_id,
                detail = :detail";

    $params = array(
        ':event_name' => $event_name,
        ':type_id' => $type_id,
        ':detail' => $detail,
        ':event_id' => $event_id
    );

    if (isset($_FILES['file1']['tmp_name']) && $_FILES['file1']['tmp_name'] !== '') {
        $new_image_name = 'image_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "../../Image/".$new_image_name;
        move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
        $sql .= ", image = :new_image_name";
        $params[':new_image_name'] = $new_image_name;
    }

    $sql .= " WHERE event_id = :event_id";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute($params);

    if ($stmt->rowCount() > 0) {
        echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
        echo "<script> window.location='../../View/Admin/Eventmanagement/Allevent.php'; </script>";
    } else {
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ ".$stmt->errorInfo()[2]."'); </script>";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


