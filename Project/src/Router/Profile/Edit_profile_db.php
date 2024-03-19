<?php
include '../../Config/Database.php';

$user_id = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$profile_img = $_FILES['profile_img']['name'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE users SET 
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                profile_img = :profile_img
            WHERE id = :user_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':profile_img', $profile_img);

    if (is_uploaded_file($_FILES['profile_img']['tmp_name'])) {
        $image_upload_path = "../../Image/".$profile_img;
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $image_upload_path);
    }

    $result = $stmt->execute();

    if ($result) {
        echo "<script> alert('บันทึกข้อมูลสำเร็จ'); </script>";
        echo "<script> window.location='../../View/User/Profile.php'; </script>";
    } else {
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ'); </script>";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>