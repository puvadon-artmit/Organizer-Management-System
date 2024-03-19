<?php
include '../../Config/Database.php';
session_start(); // เปิดใช้งาน session

if (isset($_POST['submit_payment'])) {
    // ตรวจสอบว่ามีค่า session ใน user_id และไม่ใช่ค่า null
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
        // ตรวจสอบว่ามีค่า orderID ที่เป็นค่าที่ถูกต้อง
        if (isset($_GET['orderID']) && !empty($_GET['orderID'])) {
            // รับค่าที่ส่งมาจากฟอร์ม
            $user_id = $_SESSION['user_id'];
            $formatted_pay_time = date('Y-m-d H:i:s', $pay_time);
            $orderID = $_GET['orderID'];

            // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพ
            if (isset($_FILES['pay_image']) && $_FILES['pay_image']['error'] === UPLOAD_ERR_OK) {
                // สร้างชื่อใหม่ให้กับไฟล์รูปภาพ
                $new_image_name = 'image_' . uniqid() . "." . pathinfo(basename($_FILES['pay_image']['name']), PATHINFO_EXTENSION);

                // กำหนดเส้นทางสำหรับเก็บไฟล์ภาพ
                $image_upload_path = "../../Image/" . $new_image_name;

                // อัปโหลดไฟล์ภาพไปยังเส้นทางที่กำหนด
                if (move_uploaded_file($_FILES["pay_image"]["tmp_name"], $image_upload_path)) {
                    // เมื่อเก็บไฟล์ภาพสำเร็จ ก็นำข้อมูลที่ต้องการเพิ่มลงในฐานข้อมูล
                    try {
                        $sql = "INSERT INTO payment (user_id, pay_time, pay_image, orderID, pay_status, pay_type) VALUES (:user_id, :pay_time, :pay_image, :orderID, :pay_status, :pay_type)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->bindParam(':pay_time', $formatted_pay_time);
                        $stmt->bindParam(':pay_image', $new_image_name); // ใช้ชื่อไฟล์ใหม่ที่สร้างขึ้นในการเก็บลงในฐานข้อมูล
                        $stmt->bindParam(':orderID', $orderID);
                        $stmt->bindValue(':pay_status', 'แนปสลิปแล้ว'); // กำหนดสถานะการชำระเงินตามที่คุณต้องการ
                        $stmt->bindValue(':pay_type', 'ค่าจัดงานอีเว้นท์'); // กำหนดประเภทการชำระเงินตามที่คุณต้องการ

                        $update_status = $conn->prepare("UPDATE event_order SET order_status = '2' WHERE orderID = :orderID");
                        $update_status->bindParam(":orderID", $orderID);
                        $update_status->execute();

                        if ($stmt->execute()) {
                            // หากเพิ่มข้อมูลสำเร็จ ให้ทำการ redirect หรือแสดงข้อความตามที่คุณต้องการ
                            header('Location: ../../View/User/Payment.php');
                            exit();
                        } else {
                            // เกิดข้อผิดพลาดในการ execute คำสั่ง SQL
                            echo "Error: Unable to insert data.";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
                    // เกิดข้อผิดพลาดในการอัปโหลดไฟล์ภาพ
                    echo "Error: Failed to upload the image.";
                }
            } else {
                // ไม่มีการอัปโหลดไฟล์ภาพ
                echo "Error: No image uploaded.";
            }
        } else {
            // หากไม่มีค่า orderID ที่ถูกต้อง
            echo "Error: Invalid order ID.";
        }
    } else {
        // หากไม่มีค่า session user_id หรือค่า user_id เป็นค่า null
        echo "Error: Missing user ID.";
    }
}
?>


