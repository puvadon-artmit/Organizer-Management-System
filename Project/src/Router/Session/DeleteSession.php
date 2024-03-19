<?php
// DeleteSession.php


// ตรวจสอบว่ามี parameter 'name' ที่ถูกส่งมาหรือไม่
if(isset($_GET['name'])) {
    $sessionName = $_GET['name'];

    // ตรวจสอบว่า session นี้มีอยู่หรือไม่
    if(isset($_SESSION[$sessionName])) {
        // ลบ session ออกจากเซิร์ฟเวอร์
        unset($_SESSION[$sessionName]);
        echo "Session '$sessionName' has been deleted.";
    } else {
        echo "Session '$sessionName' does not exist.";
    }
} else {
    echo "Missing parameter 'name'.";
}
?>
