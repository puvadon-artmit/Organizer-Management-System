<?php
session_start();
include '../../Config/Database.php';

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตัวแปร
    $fl_name = $_POST['fl_name'];
    $phone = $_POST['phone'];
    $dateMonth = $_POST['dateMonth'];
    $userID = $_SESSION["user_id"];
    $name_event = $_POST['name_event'];
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 

  // เพิ่มรายการในตาราง event_order
  $sql = "INSERT INTO event_order (fl_name, phone, total_price, deposit, order_status, dateMonth, user_id, name_event)
          VALUES (:fl_name, :phone, :total_price, :deposit, :order_status, :dateMonth, :user_id, :name_event)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':fl_name', $fl_name);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':total_price', $_SESSION["sum_price"]);
  $stmt->bindParam(':deposit', $_SESSION["de_posit"]);
  
  $stmt->bindParam(':name_event', $name_event);
  $orderStatus = 1; // 1 หมายถึงสถานะใหม่
  $stmt->bindParam(':order_status', $orderStatus);
  $stmt->bindParam(':dateMonth', $dateMonth);
  $stmt->bindParam(':user_id', $userID);
  $stmt->execute();

 

        $orderID = $conn->lastInsertId();
    $_SESSION["order_id"] = $orderID;

    for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
        if ($_SESSION["strProductID"][$i] != "") {
            $sql1 = "SELECT event_detail.*, event.event_name, type_detail.type_dtname
         FROM event_detail
         INNER JOIN event ON event_detail.event_id = event.event_id
         INNER JOIN type_detail ON type_detail.type_dtid = event_detail.type_dtid
         WHERE event_detail.detail_id = :detail_id";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam(':detail_id', $_SESSION["strProductID"][$i]);
            $stmt1->execute();
            $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
            $price = $result1['price'];
            $type_dtname = $result1['type_dtname'];
            $total = (int)$_SESSION["strQty"][$i] * $price;

            // เพิ่มรายการในตาราง event_receipt โดยใช้คำสั่ง INSERT INTO
            $sql2 = "INSERT INTO event_receipt (receipt_id, detail_id, orderID, orderPrice, orderQty, Total, type_dtname)
                     VALUES (NULL, :detail_id, :orderID, :price, :quantity, :total, :type_dtname)";
            $stmt2 = $conn->prepare($sql2);
            // กำหนดค่าให้กับคอลัมน์ในตาราง event_receipt
            $stmt2->bindParam(':detail_id', $_SESSION["strProductID"][$i]);
            $stmt2->bindParam(':orderID', $orderID);
            $stmt2->bindParam(':price', $price);
            $stmt2->bindParam(':quantity', $_SESSION["strQty"][$i]);
            $stmt2->bindParam(':total', $total);
            $stmt2->bindParam(':type_dtname', $type_dtname);
            $stmt2->execute();
            }
        }
       
        
        
        unset($_SESSION["event_name"]);
        unset($_SESSION["sum_price"]);
        unset($_SESSION["de_posit"]);
        unset($_SESSION["intLine"]);
        unset($_SESSION["strProductID"]);
        unset($_SESSION["strQty"]);

        
        $_SESSION['success10'] = 'จ้างจัดงานเรียบร้อยแล้ว';
        header("Location: ../../View/Index.php");
        exit;
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
    $conn = null;
}
?>
