<?php
include '../../Config/Database.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $orderID = $_POST['orderID'];
    $contract_pdf = $_FILES['contract_pdf'];
    
    // ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
    if ($contract_pdf['error'] === UPLOAD_ERR_OK) {
        $file_name = $contract_pdf['name'];
        $file_tmp = $contract_pdf['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // ตรวจสอบสกุลไฟล์เป็น PDF
        if ($file_ext === 'pdf') {
            $upload_path = '../../Contract_uploads/' . $file_name;
            move_uploaded_file($file_tmp, $upload_path);

            // เพิ่มข้อมูลเข้าฐานข้อมูล
            $sql = "INSERT INTO contracts (user_id, contract_path, orderID) VALUES (:user_id, :contract_path, :orderID)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->bindParam(':contract_path', $upload_path);
            $stmt->execute();

            echo "อัปโหลดสัญญาเรียบร้อยแล้ว";
        } else {
            echo "กรุณาอัปโหลดไฟล์ PDF เท่านั้น";
        }
    } else {
        echo "เกิดข้อผิดพลาดในการอัปโหลด";
    }
}
?>
