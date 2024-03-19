<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql_order = "SELECT * FROM event_order WHERE user_id = :user_id";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bindParam(':user_id', $user_id);
    $stmt_order->execute();
    $orders = $stmt_order->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data from the event_receipt table for the logged-in user using orderID
    $sql_receipt = "SELECT * FROM event_receipt WHERE orderID IN (SELECT orderID FROM event_order WHERE user_id = :user_id)";
    $stmt_receipt = $conn->prepare($sql_receipt);
    $stmt_receipt->bindParam(':user_id', $user_id);
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
    <link rel="icon" href="../../Image/logo.png">
    <title>My event</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</head>

<body>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
    
        <!-- Table for event_order data -->
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <div class="table-responsive">
            <h1 class="text-center text-3xl">สัญญาการจัดงาน</h1>
            <p class="text-center text-xl mt-8">สัญญาฉบับนี้ทำขึ้นเมื่อ ..........................................ณ...............................................</p>
            <p class="text-center text-xl mt-8 mb-8">ชื่อ-นามสกุล ...................................................ที่อยู่.....................................................</p>
                <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Order ID</th>
                            <th scope="col" class="px-6 py-3">ชื่องานอีเว้นท์</th>
                            <th scope="col" class="px-6 py-3">เวลาวันที่จัดงาน</th>
                            <th scope="col" class="px-6 py-3">ราคารวมงานอีเว้นท์</th>
                            <th scope="col" class="px-6 py-3">ราคามัดจำงานอีเว้นท์</th>
                            <!-- Add other columns for event_order table... -->
                        </tr>
                    </thead>
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
                            <th scope="col" class="px-6 py-3">Receipt ID</th>
                            <th scope="col" class="px-6 py-3">ราคารายละเอียดการจัดงาน</th>
                            <th scope="col" class="px-6 py-3">จำนวนรายละเอียด</th>
                            <th scope="col" class="px-6 py-3">ประเภทรายละเอียด</th>
                            <!-- Add other columns for event_receipt table... -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receipts as $receipt) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <!-- Display event_receipt data here -->
                                <td class="px-6 py-4"><?php echo $receipt['receipt_id']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['orderPrice']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['orderQty']; ?></td>
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

<button onclick="window.print()" class="btn btn-warning">Print</button>
<!-- Your existing code below... -->

</body>

</html>
