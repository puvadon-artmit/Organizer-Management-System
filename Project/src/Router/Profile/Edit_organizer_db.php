<?php
include '../../Config/Database.php';

$organizer_id = $_POST['organizer_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$oz_email = $_POST['oz_email'];
$profile_ogz = $_FILES['profile_ogz']['name'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE organizer SET 
                firstname = :firstname,
                lastname = :lastname,
                oz_email = :oz_email,
                profile_ogz = :profile_ogz
            WHERE organizer_id = :organizer_id";  

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':organizer_id', $organizer_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':oz_email', $oz_email);  
    $stmt->bindParam(':profile_ogz', $profile_ogz);

    if (is_uploaded_file($_FILES['profile_ogz']['tmp_name'])) {
        $image_upload_path = "../../Image/".$profile_ogz;
        move_uploaded_file($_FILES['profile_ogz']['tmp_name'], $image_upload_path);
    }

    $result = $stmt->execute();

    if ($result) {
        echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
        echo "<script> window.location='../../View/Admin/Member/Allorganizer.php'; </script>";
    } else {
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ'); </script>";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
