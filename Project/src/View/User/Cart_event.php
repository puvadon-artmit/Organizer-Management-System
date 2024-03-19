<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

// ตรวจสอบสถานะการเข้าสู่ระบบของผู้ใช้
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Router/User/User_login.php');
    exit();
}

// ดึงรายการในตะกร้าของผู้ใช้
$user_id = $_SESSION['user_id'];
$sql = "SELECT cart_event.*, event_detail.name_dt, event.image
        FROM cart_event
        INNER JOIN event_detail ON cart_event.detail_id = event_detail.detail_id
        INNER JOIN event ON event_detail.event_id = event.event_id
        WHERE cart_event.user_id = :user_id AND cart_event.cart_status = 'unsettled'";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <title>รายการตะกร้า</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
    <?php include '../../Templates/Mainpage/Navbar2.php'; ?>

    <div class="container">
        <h1>รายการตะกร้า</h1>
        <table>
            <thead>
                <tr>
                    <th>รายการ</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>รวม</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $cart_item) : ?>
                    <tr>
                        <td><?php echo $cart_item['cart_id']; ?></td>
                        <td>
                            <img src="../../Image/<?php echo $cart_item['image']; ?>" alt="รูปภาพสินค้า">
                            <?php echo $cart_item['name_dt']; ?>
                        </td>
                        <td><?php echo $cart_item['quantity']; ?></td>
                        <td><?php echo $cart_item['price']; ?></td>
                        <td><?php echo $cart_item['total_price']; ?></td>
                        <td>
                            <a href="remove_from_cart.php?cart_id=<?php echo $cart_item['cart_id']; ?>">ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="checkout.php">ชำระเงิน</a>
        </div>
    </div>
</body>

</html>
