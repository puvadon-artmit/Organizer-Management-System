<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
} else {
    header('Location: ../../View/Index.php');
    exit();
}

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql_order = "SELECT * FROM event_order WHERE orderID = :orderID";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bindParam(':orderID', $orderID);
    $stmt_order->execute();
    $orders = $stmt_order->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data from the event_receipt table for the specified orderID
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
    
    
    <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">รายการ <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">รายละเอียด การจ้างจ้างจัดงานอีเว้นท์</span></h1>
<p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400 mb-8">รายการ รายละเอียด การจ้างจ้างจัดงานอีเว้นท์ทั้งหมด.</p>
   
        <!-- Table for event_order data -->
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <div class="table-responsive">
           
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
        <div class="inline-flex items-center justify-center w-full">
    <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">or</span>
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
                            <th scope="col" class="px-6 py-3">ประเภทรายละเอียด</th>
                            <!-- Add other columns for event_receipt table... -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receipts as $receipt) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <!-- Display event_receipt data here -->
                                <td class="px-6 py-4"><svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
         </svg></td>
                                <td class="px-6 py-4"><?php echo $receipt['Total']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['orderQty']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['type_dtname']; ?></td>
                                <td class="px-6 py-4"><?php echo $receipt['name_dt']; ?></td>
                                <!-- Add other columns from event_receipt table... -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
       <div class="flex justify-center">
        <a href="./My_event.php" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
        <!-- <a href="./Contract_event.php?orderID=<?php echo $order['orderID']; ?>" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ปริ้นสัญญาจ้างจัดงาน</a> -->
    </div>
    <!-- <div class="mt-8 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
    <div class="flex justify-center">
        
        <a href="./View_contract.php?contract_id" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ดูสัญญาที่แนบ</a>
    <form action="../../Router/User/Contracts_user.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <label for="contract_pdf">แนบสัญญา (PDF)</label>
    <input type="file" name="contract_pdf" accept=".pdf" required>
    <button type="submit" class="text-white bg-green-500 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">แนบสัญญา</button>
    
</form>
</div>
</div> -->
</section>


<!-- Your existing code below... -->

</body>

</html>
