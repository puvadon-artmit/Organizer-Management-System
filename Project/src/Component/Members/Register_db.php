<?php

session_start();
include '../../Config/Database.php';

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $urole = 'user';
    $profile_img = $_FILES['profile_img']['name'];

    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: ../../View/Index.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: ../../View/Index.php");
    } else if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: ../../View/Index.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: ../../View/Index.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: ../../View/Index.php");
    } else if (strlen($_POST['password']) > 10 || strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: ../../View/Index.php");
    } else if (empty($c_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: ../../View/Index.php");
    } else if ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: ../../View/Index.php");
    } else {
        try {
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row && $row['email'] == $email) {
                $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: ../../View/Index.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // ตรวจสอบว่ามีไฟล์รูปถูกอัปโหลดหรือไม่
                if (is_uploaded_file($_FILES['profile_img']['tmp_name'])) {
                    $new_image_name = 'image_' . uniqid() . "." . pathinfo(basename($_FILES['profile_img']['name']), PATHINFO_EXTENSION);
                    $image_upload_path = "../../Image/" . $new_image_name;
                    move_uploaded_file($_FILES['profile_img']['tmp_name'], $image_upload_path);

                    // บันทึกข้อมูลผู้ใช้งานลงในฐานข้อมูล
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole, profile_img) 
                                            VALUES(:firstname, :lastname, :email, :password, :urole, :profile_img)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->bindParam(":profile_img", $new_image_name);
                    $stmt->execute();

                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว";
                    header("location: ../../View/Index.php");
                } else {
                    // บันทึกข้อมูลผู้ใช้งานลงในฐานข้อมูล (ไม่มีรูปภาพ)
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) 
                                            VALUES(:firstname, :lastname, :email, :password, :urole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();

                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: ../../View/Index.php");
                }
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: ../../View/Index.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
