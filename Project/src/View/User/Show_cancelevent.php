<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';


// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

try {
    $sql = "SELECT eo.*, ce.cause FROM event_order eo
    LEFT JOIN cancel_event ce ON eo.orderID = ce.orderID
    WHERE eo.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Now you have the orders for the logged-in user, you can loop through and display the data
    foreach ($orders as $order) {
        // Display the order details here as needed
        // You can access the data like $order['orderID'], $order['fl_name'], $order['address'], etc.
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <title>My event</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</head>

<body>


    <?php
    include '../../Templates/Mainpage/Navbar2.php';
    ?>







    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700 mt-4">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">ยกเลิกจัดงานอีเว้นท์</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">งานอีเว้นท์ที่ถูกยกเลิกจัดงาน</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">งานอีเว้นท์ที่ผู้ใช้งานยกเลิก</button>
        </li>
       
    </ul>
</div>
<div id="myTabContent">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="table-responsive">
                    <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ลำดับที่</th>
                                <th scope="col" class="px-6 py-3">ชื่องานอีเว้นท์</th>
                                <th scope="col" class="px-6 py-3">สถานะ</th>
                                <th scope="col" class="px-6 py-3">วันที่จัดงาน</th>
                                <!-- <th scope="col" class="px-6 py-3">มัดจำ</th>
                    <th scope="col" class="px-6 py-3">ราคา</th> -->
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                foreach ($orders as $order) {
                    if ($order['order_status'] != 6 && $order['order_status'] != 4 && $order['order_status'] != 5) { 
                    ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4"><?php echo $order['orderID']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['name_event']; ?></td>

                                <td class="px-6 py-4">
                                    <?php
                            if ($order['order_status'] == 1) {
                                echo 'ยังไม่ชำระเงิน';
                            } elseif ($order['order_status'] == 2) {
                                echo 'รอดำเนินการ';
                            } elseif ($order['order_status'] == 3) {
                                echo 'รับจัดงานแล้ว';
                            }elseif ($order['order_status'] == 4) {
                                echo 'ยกเลิกงานอีเว้นท์';
                            }elseif ($order['order_status'] == 5) {
                                echo 'จัดงานอีเว้นท์เสร็จสิ้น';
                            }elseif ($order['order_status'] == 6) {
                                echo 'ผู้ใช้ทำการยกเลิกจัดงานอีเว้นท์';
                            } else {
                                echo 'สถานะไม่ถูกต้อง';
                            }
                            ?>
                                </td>
                                <td class="px-6 py-4"><?php echo $order['dateMonth']; ?></td>
                                <td class="px-6 py-4"><button data-popover-target="popover-no-arrow" type="button"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">ยกเลิกจัดงานอีเว้นท์</button>
                                    <div data-popover id="popover-no-arrow" role="tooltip"
                                        class="absolute z-10 invisible inline-block w-1/2 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div
                                            class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                            <h3 class="font-semibold text-gray-900 dark:text-white">ยกเลิกจัดงานอีเว้นท์
                                            </h3>
                                        </div>
                                        <div class="px-3 py-2">
                                            <section class="bg-white dark:bg-gray-900">
                                                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                                    <div
                                                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                                                        <form action="../../Router/User/Cancel_Event.php" method="post">
                                                            <div class="mb-6">
                                                                <label for="cause"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">สาเหตุที่ยกเลิกจัดงานอีเว้นท์</label>
                                                                <input type="text" id="cause" name="cause"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            </div>
                                                            <input type="hidden" name="orderID"
                                                                value="<?php echo $order['orderID']; ?>">
                                                            <div class="flex justify-center">
                                                                <button type="submit"
                                                                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">ยืนยัน</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                            </section>
                                        </div>
                                    </div>
                                </td>
                                <!-- <td class="px-6 py-4"><?php echo $order['total_price']; ?></td> -->



                            </tr>
                            <?php
                    }
                }
                ?>
                        </tbody>
                    </table>
                </div>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="table-responsive">
                    <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ลำดับที่</th>
                                <th scope="col" class="px-6 py-3">ชื่องานอีเว้นท์</th>
                                <th scope="col" class="px-6 py-3">สถานะ</th>
                                <th scope="col" class="px-6 py-3">วันที่จัดงาน</th>
                                <!-- <th scope="col" class="px-6 py-3">มัดจำ</th>
                    <th scope="col" class="px-6 py-3">ราคา</th> -->
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                foreach ($orders as $order) {
                    if ($order['order_status'] == 4 ) { 
                    ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4"><?php echo $order['orderID']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['name_event']; ?></td>

                                <td class="px-6 py-4">
                                    <?php
                            if ($order['order_status'] == 1) {
                                echo 'ยังไม่ชำระเงิน';
                            } elseif ($order['order_status'] == 2) {
                                echo 'รอดำเนินการ';
                            } elseif ($order['order_status'] == 3) {
                                echo 'รับจัดงานแล้ว';
                            }elseif ($order['order_status'] == 4) {
                                echo 'ยกเลิกงานอีเว้นท์';
                            }elseif ($order['order_status'] == 5) {
                                echo 'จัดงานอีเว้นท์เสร็จสิ้น';
                            }elseif ($order['order_status'] == 6) {
                                echo 'ผู้ใช้ทำการยกเลิกจัดงานอีเว้นท์';
                            } else {
                                echo 'สถานะไม่ถูกต้อง';
                            }
                            ?>
                                </td>
                                <td class="px-6 py-4"><?php echo $order['dateMonth']; ?></td>
                                
                                                    </div>
                                            </section>
                                        </div>
                                    </div>
                                </td>
                                <!-- <td class="px-6 py-4"><?php echo $order['total_price']; ?></td> -->



                            </tr>
                            <?php
                    }
                }
                ?>
                        </tbody>
                    </table>
                </div>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <div class="table-responsive">
                    <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ลำดับที่</th>
                                <th scope="col" class="px-6 py-3">ชื่องานอีเว้นท์</th>
                                <th scope="col" class="px-6 py-3">สถานะ</th>
                                <th scope="col" class="px-6 py-3">วันที่จัดงาน</th>
                                <!-- <th scope="col" class="px-6 py-3">มัดจำ</th>
                    <th scope="col" class="px-6 py-3">ราคา</th> -->
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>



                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order) {
    if ($order['order_status'] == 6 ) { 
?>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="px-6 py-4"><?php echo $order['orderID']; ?></td>
        <td class="px-6 py-4"><?php echo $order['name_event']; ?></td>

        <td class="px-6 py-4">
            <?php
                if ($order['order_status'] == 1) {
                    echo 'ยังไม่ชำระเงิน';
                } elseif ($order['order_status'] == 2) {
                    echo 'รอดำเนินการ';
                } elseif ($order['order_status'] == 3) {
                    echo 'รับจัดงานแล้ว';
                } elseif ($order['order_status'] == 4) {
                    echo 'ยกเลิกงานอีเว้นท์';
                } elseif ($order['order_status'] == 5) {
                    echo 'จัดงานอีเว้นท์เสร็จสิ้น';
                } elseif ($order['order_status'] == 6) {
                    echo 'ผู้ใช้ทำการยกเลิกจัดงานอีเว้นท์';
                } else {
                    echo 'สถานะไม่ถูกต้อง';
                }
            ?>
        </td>
        <td class="px-6 py-4"><?php echo $order['dateMonth']; ?></td>
        <td>
                    <?php if (!empty($order['cause'])) { ?>
                        <div class="bg-red-200 text-red-800 p-2 rounded-md mt-3">
                            สถานะ: งานอีเว้นท์นี้ถูกยกเลิกเนื่องจาก : <?php echo $order['cause']; ?>
                        </div>
                    <?php } ?>
                </td>
    </tr>
<?php
    }
}
?>
                        </tbody>
                    </table>
                </div>
    </div>
   
</div>

                

                <!-- <div class="mt-8 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
    <div class="flex justify-center">
        <a href="./Contract_event.php?orderID=<?php echo $order['orderID']; ?>" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ปริ้นสัญญาจ้างจัดงาน</a>
        <a href="./View_contract.php?contract_id" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ดูสัญญาที่แนบ</a>
    <form action="../../Router/User/Contracts_user.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <label for="contract_pdf">แนบสัญญา (PDF)</label>
    <input type="file" name="contract_pdf" accept=".pdf" required>
    <button type="submit" class="text-white bg-green-500 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">แนบสัญญา</button>
    
</form>
</div> -->

            </div>

        </div>
        </div>
    </section>


</body>

</html>