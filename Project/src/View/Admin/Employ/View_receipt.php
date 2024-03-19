<?php
include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


$orderID = $_GET['orderID'];

try {
    
    $sql_order = "SELECT * FROM event_order WHERE orderID = :orderID";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bindParam(':orderID', $orderID);
    $stmt_order->execute();
    $orders = $stmt_order->fetchAll(PDO::FETCH_ASSOC);

    
    $sql_receipt = "SELECT er.*, ed.name_dt
               FROM event_receipt er
               INNER JOIN event_detail ed ON er.detail_id = ed.detail_id
               WHERE er.orderID = :orderID";

$stmt_receipt = $conn->prepare($sql_receipt);
$stmt_receipt->bindParam(':orderID', $orderID);
$stmt_receipt->execute();
$receipts = $stmt_receipt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="icon" href="../../../Image/logo.png">
    <title>My event</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</head>

<body>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
   
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-3xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">รายการ รายละเอียด</span> การจ้างจ้างจัดงานอีเว้นท์.</h1>
<p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400 mb-8">รายการ รายละเอียด การจ้างจ้างจัดงานอีเว้นท์ทั้งหมด.</p>
        <!-- Table for event_order data -->
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <div class="table-responsive">
            
                    <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <!-- Display event_order data here -->
                                <td class="px-6 py-4"><?php echo $order['orderID']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['name_event']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['dateMonth']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['total_price']; ?></td>
                                <td class="px-6 py-4"><?php echo $order['deposit']; ?></td>
                                <!-- Add other columns from event_order table... -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table for event_receipt data -->
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <div class="table-responsive">
                <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">ราคารายละเอียดการจัดงาน</th>
                            <th scope="col" class="px-6 py-3">จำนวนรายละเอียด</th>
                            <th scope="col" class="px-6 py-3">ชื่อรายละเอียด</th>
                            <th scope="col" class="px-6 py-3">ประเภทรายละเอียด</th>
                            <!-- Add other columns for event_receipt table... -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receipts as $receipt) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <!-- Display event_receipt data here -->
                                <td class="px-6 py-4"><?php echo $receipt['receipt_id']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['Total']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['orderQty']; ?></td>	
                                <td class="px-6 py-4"><?php echo $receipt['name_dt']; ?></td>

                                <td class="px-6 py-4"><?php echo $receipt['type_dtname']; ?></td>
                                <!-- Add other columns from event_receipt table... -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>



</body>

</html>
