User
<?php

include '../../Config/Database.php';
include '../../Controller/User/User_login.php';
if (!isset($_SESSION["intLine"])) {
    $_SESSION["intLine"] = 0;
}

// ตรวจสอบการเพิ่มสินค้าลงในตระกร้า
if (isset($_GET['id'])) {
    $strProductID = $_GET['id']; // รับค่ารหัสสินค้าที่เพิ่มในตระกร้า

    // ตรวจสอบว่ามีสินค้าในตาราง event_detail หรือไม่
    $sql1 = "SELECT * FROM event_detail WHERE detail_id = :detail_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':detail_id', $strProductID);
    $stmt1->execute();
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($result1) {
        $key = array_search($strProductID, $_SESSION["strProductID"]); // ค้นหาตำแหน่งของสินค้าในตระกร้า

        // ถ้ามีสินค้าอยู่ในตระกร้าแล้ว ให้เพิ่มจำนวนสินค้า
        if ($key !== false) {
            $_SESSION["strQty"][$key] += 1;
        } else {
            // ถ้าสินค้ายังไม่อยู่ในตระกร้า ให้เพิ่มสินค้าใหม่
            $intNewLine = $_SESSION["intLine"] + 1; // เพิ่มตำแหน่งสินค้าใหม่ในตระกร้า
            $_SESSION["strProductID"][$intNewLine] = $strProductID; // เก็บรหัสสินค้าในตำแหน่งใหม่
            $_SESSION["strQty"][$intNewLine] = 1; // จำนวนสินค้าในตำแหน่งใหม่เป็น 1
            $_SESSION["intLine"] = $intNewLine; // อัปเดตจำนวนสินค้าในตระกร้า
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <title>Cart</title>
</head>

<body>
    <?php
    include '../../Templates/Mainpage/Navbars.php';
    ?>
    <div class="container ">
        <form action="../../Controller/Cart/Insert_cart.php" id="form1" method="POST">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 left-20 ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ลำดับที่
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ภาพสินค้า
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ชื่อสินค้า
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ประเภทงาน
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ราคา
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ราคารวม
                            </th>
                            <th scope="col" class="px-6 py-3">
                                แก้ไข
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ลบ
                            </th>

                        </tr>
                    </thead>

                    

                    <tbody>
                        <?php
           if (isset($_SESSION["intLine"]) > 0) {
        $Total = 0;
        $Sumprice = 0;
        $m = 1;
        $eventNames = array(); // Array to store unique event names

        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
            if (isset($_SESSION["strProductID"][$i]) && $_SESSION["strProductID"][$i] !== "") {
                $sql1 = "SELECT event_detail.*, event.event_name 
                        FROM event_detail 
                        INNER JOIN event ON event_detail.event_id = event.event_id
                        WHERE event_detail.detail_id = :detail_id";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(':detail_id', $_SESSION["strProductID"][$i]);
                $stmt1->execute();
                $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                 

                $_SESSION["price"] = $result1['price'];
                $Total = (int)$_SESSION["strQty"][$i] ?? 0;
                $sum = $Total * $result1['price'];
                $Sumprice += $sum;

                $_SESSION["sum_price"] = $Sumprice;
                        ?>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4"><?php echo $m; ?></td>
                            <td class="w-32 p-4">
                                <img class="  rounded-lg" src="../../Image/<?php echo $result1["detail_img"]; ?>"
                                    alt="<?php echo $result1['name_dt']; ?>" >
                            </td>
                            <td class="px-6 py-4"><?php echo $result1['name_dt']; ?></td>

                            <td class="px-6 py-4"><?php echo $result1['event_name']; ?></td>
                            <td class="px-6 py-4"><?php echo $result1['price']; ?></td>

                            <td class="px-6 py-4" style="color: #FF9900;"><?php echo number_format($sum); ?></td>

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">




                                    <a href="../../Controller/Cart/Add_order.php?id=<?php echo $result1['detail_id']; ?>"
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                    <div>
                                        <?php echo $_SESSION["strQty"][$i]; ?>
                                    </div>

                                    <a href="../../Controller/Cart/Reduce_order.php?id=<?php echo $result1['detail_id']; ?>"
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        </svg>
                                    </a>
                                    <?php } ?>
                                </div>
                            </td>

                            <td> 
                                <a class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="reset" href="../../Controller/Cart/Delete_order.php?Line=<?=$i?>" role="button">ลบ</a>
                                </td>
                        <?php
                        $m = $m + 1;
                    }
                }
                ?>
                        <tr>
                            <td class="text-center" colspan="6" style=" font-size: 20px;"> </td>
                            
                            <td class="text-center" style=" font-size: 20px; color: #00CC00;">รวมเป็นเงิน &nbsp;&nbsp; <?= $Sumprice ?> &nbsp;&nbsp;  บาท</td>
                        </tr>
                        <?php
            }
            ?>
                    </tbody>
                </table>
            </div>




            <br>

            <!-- <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="alert alert-primary text-center " h4 role="alert">
                        ที่อยู่สำหรับจัดส่งสินค้า
                    </div>

                    <input type="text" name="cus_name" class="form-control" value="" required
                        placeholder="ชื่อ-นามสกุล...">
                    <br>
                    <textarea name="cus_add" id="cus_add" cols="30" rows="4" class="form-control"
                        placeholder="ที่อยู่..."></textarea>
                    <br>
                    <input type="number" name="cus_tel" class="form-control" value="" required
                        placeholder="เบอร์โทรศัพท์...">
                </div>
            </div>
            <br>
            <div style="text-align:center">

                <button class="btn btn-outline-success" type="submit">ยืนยันการสั่งซื้อ</button>
            </div> -->
            <br>
        </form>
    </div>
</body>

</html>