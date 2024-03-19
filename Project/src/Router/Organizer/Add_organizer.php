<?php

session_start();
include '../../Config/Database.php';

if (isset($_POST['addorganizer'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $oz_email = $_POST['oz_email'];
    $oz_password = $_POST['oz_password'];
    $c_password = $_POST['c_password'];
    $uroles = 'organizer';
    $profile_ogz = $_FILES['profile_ogz']['name'];
    $type_ogzid = $_POST['type_ogzid'];
    $talent = $_POST['talent'];

    if (empty($firstname)) {
        $_SESSION['error3'] = 'กรุณากรอกชื่อ';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (empty($lastname)) {
        $_SESSION['error3'] = 'กรุณากรอกนามสกุล';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (empty($oz_email)) {
        $_SESSION['error3'] = 'กรุณากรอกอีเมล';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (!filter_var($oz_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error3'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (empty($oz_password)) {
        $_SESSION['error3'] = 'กรุณากรอกรหัสผ่าน';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (strlen($oz_password) > 10 || strlen($oz_password) < 5) {
        $_SESSION['error3'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 10 ตัวอักษร';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if (empty($c_password)) {
        $_SESSION['error3'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else if ($oz_password != $c_password) {
        $_SESSION['error3'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: ../../View/Admin/Member/Addorganizer.php");
    } else {
        try {
            $check_email = $conn->prepare("SELECT oz_email FROM organizer WHERE oz_email = :oz_email");
            $check_email->bindParam(":oz_email", $oz_email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row && $row['oz_email'] == $oz_email) {
                $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: ../../View/Index.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($oz_password, PASSWORD_DEFAULT);

                // ตรวจสอบว่ามีไฟล์รูปถูกอัปโหลดหรือไม่
                if (is_uploaded_file($_FILES['profile_ogz']['tmp_name'])) {
                    $new_image_name = 'image_' . uniqid() . "." . pathinfo(basename($_FILES['profile_ogz']['name']), PATHINFO_EXTENSION);
                    $image_upload_path = "../../Image/" . $new_image_name;
                    move_uploaded_file($_FILES['profile_ogz']['tmp_name'], $image_upload_path);

                    // บันทึกข้อมูลผู้ใช้งานลงในฐานข้อมูล 
                    $stmt = $conn->prepare("INSERT INTO organizer(firstname, lastname, oz_email, oz_password, uroles, profile_ogz, type_ogzid, talent) 
                    VALUES(:firstname, :lastname, :oz_email, :oz_password, :uroles, :profile_ogz, :type_ogzid, :talent)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":oz_email", $oz_email);
                    $stmt->bindParam(":oz_password", $passwordHash); // <-- Changed to $passwordHash
                    $stmt->bindParam(":uroles", $uroles);
                    $stmt->bindParam(":profile_ogz", $new_image_name);
                    $stmt->bindParam(":type_ogzid", $type_ogzid);
                    $stmt->bindParam(":talent", $talent);
                    $stmt->execute();

                    $_SESSION['success3'] = " <a href='signin.php' class='alert-link'>เพิ่มผู้รับจัดงานเรียบร้อยแล้ว!</a>";
                    header("location: ../../View/Admin/Member/Addorganizer.php");
                } else {
                    // บันทึกข้อมูลผู้ใช้งานลงในฐานข้อมูล (ไม่มีรูปภาพ)
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, oz_email, oz_password, uroles, talent) 
                    VALUES(:firstname, :lastname, :oz_email, :oz_password, :uroles, :talent)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":oz_email", $oz_email);
                    $stmt->bindParam(":oz_password", $passwordHash); // <-- Changed to $passwordHash
                    $stmt->bindParam(":uroles", $uroles);
                    $stmt->bindParam(":talent", $talent);
                    $stmt->execute();

                    $_SESSION['success3'] = "เพิ่มผู้รับจัดงานเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: ../../View/Admin/Member/Addorganizer.php");
                }
            } else {
                $_SESSION['error3'] = "มีบางอย่างผิดพลาด";
                header("location: ../../View/Admin/Member/Addorganizer.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
