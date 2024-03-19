<?php
include '../../Config/Database.php';
session_start(); // เปิดใช้งาน session

if (isset($_POST['submit'])) {
    // ตรวจสอบว่ามีค่า orderID ที่เป็นค่าที่ถูกต้อง
    if (isset($_GET['orderID']) && !empty($_GET['orderID'])) {
        // รับค่าที่ส่งมาจากฟอร์ม
        $orderID = $_GET['orderID'];

        // Validate and sanitize the address input (you can customize this validation as needed)
        $province = $_POST['province'];
        $district = $_POST['district'];
        $subdistrict = $_POST['subdistrict'];
        $address_list = $_POST['address_list'];
        $address_list = trim($address_list);

        // Check if the address is not empty
        if (!empty($address_list)) {
            try {
                $sql = "INSERT INTO address (orderID, address_list, province, district, subdistrict) 
                VALUES (:orderID, :address_list, :province, :district, :subdistrict)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':orderID', $orderID);
                $stmt->bindParam(':address_list', $address_list);
                $stmt->bindParam(':province', $province);
                $stmt->bindParam(':district', $district);
                $stmt->bindParam(':subdistrict', $subdistrict);

                if ($stmt->execute()) {
                    // หากเพิ่มข้อมูลสำเร็จ ให้ทำการ redirect หรือแสดงข้อความตามที่คุณต้องการ
                    header('Location: ../../View/User/Address_user.php?success=1');
                    exit();
                } else {
                    // เกิดข้อผิดพลาดในการ execute คำสั่ง SQL
                    echo "Error: Unable to insert data.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            // กรณีที่ไม่ได้กรอกที่อยู่
            echo "Error: Address cannot be empty.";
        }
    } else {
        // หากไม่มีค่า orderID ที่ถูกต้อง
        echo "Error: Invalid order ID.";
    }
}
?>