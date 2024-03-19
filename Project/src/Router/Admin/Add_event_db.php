<?php 
include '../../Config/Database.php';

//ตัวแปล
$event_name = $_POST['event_name'];
$type_id = $_POST['type_id'];

$amount = $_POST['amount'];
$detail = $_POST['detail'];

//อัพโหลดรูป
if (is_uploaded_file($_FILES['image']['tmp_name'])) {
    $new_image_name = 'image_'.uniqid().".".pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../../Image/".$new_image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}

$sql = "INSERT INTO event(event_name, type_id, amount, image, detail)
VALUES (:event_name, :type_id, :amount, :image, :detail)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_name', $event_name);
$stmt->bindParam(':type_id', $type_id);
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':image', $new_image_name);
$stmt->bindParam(':detail', $detail);

$result = $stmt->execute();

if ($result) {
    echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
    echo "<script> window.location='../../View/Add_event.php'; </script>";
} else {
    echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ ".$stmt->errorInfo()."'); </script>";
}
?>
