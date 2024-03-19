<?php
session_start();
include '../../Config/Database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cart</title>
</head>

<body>
    <div class="container">
        <form action="../../Controller/Cart/Insert_cart.php" id="form1" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับที่</th>
                            <th></th>
                            <th>ชื่ออีเว้นท์</th>
                            <th>รายละเอียด</th>
                            <th>ราคาของ</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ราคารวม</th>
                            <th>แก้ไข</th>
                        </tr>
                        <?php
                        if (isset($_SESSION["eventID"]) && is_array($_SESSION["eventID"])) {
                            $Total = 0;
                            $Sumprice = 0;
                            $m = 1;
                            foreach ($_SESSION["eventID"] as $i => $eventID) {
                                if (!empty($eventID)) {
                                    $strSQL = "SELECT * FROM event_detail WHERE detail_id = :detail_id";
                                    $stmt = $conn->prepare($strSQL);
                                    $stmt->bindParam(':detail_id', $eventID);
                                    $stmt->execute();
                                    $objResult = $stmt->fetch();
                                    $_SESSION["price"][$i] = $objResult['price'];

                                    if (!isset($_SESSION["strQty"]) || !is_array($_SESSION["strQty"])) {
                                        $_SESSION["strQty"] = []; // กำหนดเป็นอาร์เรย์เปล่าหากไม่มีค่าใน $_SESSION["strQty"]
                                    }

                                    $Total = isset($_SESSION["strQty"][$i]) ? $_SESSION["strQty"][$i] : 0;

                                    $sum = $Total * $objResult['price'];
                                    $Sumprice += $sum;
                                    $_SESSION["sum_price"] = $Sumprice;
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $m; ?></td>
                                        <td><img src="../../Image/<?php echo $objResult["detail_img"]; ?>" width="160px" height="120" class="border"></td>
                                        <td><?php echo $objResult['name_dt']; ?></td>
                                        <td><?php echo $objResult['detail']; ?></td>
                                        <td><?php echo $objResult['price']; ?></td>
                                        <td><?php echo isset($_SESSION["strQty"][$i]) ? $_SESSION["strQty"][$i] : 0; ?></td>
                                        <td class="" style="color: #FF9900;"><?php echo number_format($sum); ?></td>
                                        <td>
                                            <a href="../../Controller/Cart/Order_cart.php?id=<?php echo $objResult['detail_id']; ?>" class="btn btn-outline-primary">+</a>
                                            <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                                <a href="../../Controller/Cart/Reduce_order.php?id=<?php echo $objResult['detail_id']; ?>" class="btn btn-outline-danger">-</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-danger" type="reset" href="../../Controller/Cart/Delete_order.php?Line=<?=$i?>" role="button">ลบ</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $m = $m + 1;
                                }
                            }
                            ?>
                            <tr>
                                <td class="text-end" colspan="6" style="font-size: 20px;">รวมเป็นเงิน</td>
                                <td class="text-end" style="color: #00CC33; font-size: 20px;"><?= $Sumprice ?></td>
                                <td class="text-center" style="font-size: 20px;">บาท</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">ยืนยันการสั่งซื้อ</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
