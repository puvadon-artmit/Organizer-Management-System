<?php
include '../../Config/Database.php';

//ตัวแปล
$event_id = $_GET['event_id'];
$price = $_POST['price'];
$dt_amount = $_POST['dt_amount'];
$detail = $_POST['detail'];
$type_dtid = $_POST['type_dtid'];
$name_dt = $_POST['name_dt'];

//อัพโหลดรูป
if (is_uploaded_file($_FILES['image']['tmp_name'])) {
    $new_image_name = 'image_'.uniqid().".".pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../../Image/".$new_image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}

$sql = "INSERT INTO event_detail(event_id, price, dt_amount, detail_img, detail, name_dt, type_dtid)
VALUES (:event_id, :price, :dt_amount, :detail_img, :detail, :name_dt, :type_dtid)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':dt_amount', $dt_amount);
$stmt->bindParam(':detail_img', $new_image_name);
$stmt->bindParam(':detail', $detail);
$stmt->bindParam(':name_dt', $name_dt);
$stmt->bindParam(':type_dtid', $type_dtid);

$result = $stmt->execute();

if ($result) {
    $detail_id = $conn->lastInsertId();
    echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
    echo "<script> window.location='../../View/Admin/Eventmanagement/Allevent.php'; </script>";
} else {
    echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ ".$stmt->errorInfo()[2]."'); </script>";
}
?>
