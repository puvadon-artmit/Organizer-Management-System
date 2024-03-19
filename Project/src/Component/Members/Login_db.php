<?php
ob_start();
session_start();
include '../../Config/Database.php';

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมลและรหัสผ่าน';
        header("location: ../../View/Login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: ../../View/Login.php");
        exit();
    }

    if (strlen($password) > 10 || strlen($password) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 10 ตัวอักษร';
        header("location: ../../View/Login.php");
        exit();
    }

    try {
        $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $check_data->bindParam(":email", $email);
        $check_data->execute();
        $row = $check_data->fetch(PDO::FETCH_ASSOC);

        if ($check_data->rowCount() > 0) {
            if ($email == $row['email']) {
                if (password_verify($password, $row['password'])) {
                    if ($row['urole'] == 'admin') {
                        $_SESSION['admin_login'] = $row['id'];
                        $_SESSION['user_id'] = $row['id'];
                        header("location: ../../View/Admin/Index.php");
                        exit();
                    } else {
                        $_SESSION['user_login'] = $row['id'];
                        $_SESSION['user_id'] = $row['id'];
                        header("location: ../../View/Index.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'รหัสผ่านผิด';
                    header("location: ../../View/Login.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'ไม่มีบัญชีนี้';
                header("location: ../../View/Login.php");
                exit();
            }
        }

        $check_data2 = $conn->prepare("SELECT * FROM organizer WHERE oz_email = :oz_email");
        $check_data2->bindParam(":oz_email", $email);
        $check_data2->execute();
        $row2 = $check_data2->fetch(PDO::FETCH_ASSOC);

        if ($check_data2->rowCount() > 0) {
            if ($email == $row2['oz_email']) {
                if ($row2['uroles'] == 'organizer') {
                    if (password_verify($password, $row2['oz_password'])) {
                        $_SESSION['user_id'] = $row2['organizer_id'];
                        $_SESSION['organizer_login'] = $row2['organizer_id'];
                        header("location: ../../View/Organizer/Index.php");
                        exit();
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: ../../View/Login.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'ไม่มีบัญชีนี้';
                    header("location: ../../View/Login.php");
                    exit();
                }
            }
        }

        $_SESSION['error'] = "อีเมลไม่ถูกต้องหรือไม่มีบัญชี";
        header("location: ../../View/Login.php");
        exit();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    // ถ้าไม่มีการล็อกอิน ให้นำไปยังหน้า login.php เพื่อให้ผู้ใช้ล็อกอิน
    header("location: ../../View/Login.php");
    exit();
}

ob_end_flush();
?>

