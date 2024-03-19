<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];



    try {
        $orderID = $_GET['orderID'];
        // Fetch the data from the event_order table for the logged-in user and the specified Pay_deposit value
        $sql = "SELECT * FROM event_order WHERE user_id = :user_id AND orderID = :orderID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':orderID', $orderID); // ใช้ $orderID ที่รับมาจาก URL ในการ bind พารามิเตอร์ pay_deposit
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_payment = "SELECT pay_status, pay_type FROM payment WHERE orderID = :orderID";
        $stmt_payment = $conn->prepare($sql_payment);
        $stmt_payment->bindParam(':orderID', $orderID);
        $stmt_payment->execute();
        $payment = $stmt_payment->fetch(PDO::FETCH_ASSOC);

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
 
 <form action="../../Router/User/Pay_depositDB.php?orderID=<?php echo $orderID; ?>" id="form1" method="POST" enctype="multipart/form-data">  
<?php foreach ($orders as $order) : ?>
    <div class="flex justify-center mt-8">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            
            <!-- Add the payment status loop here -->
            <?php
$sql_payment = "SELECT pay_type, pay_image FROM payment WHERE orderID = :orderID";
$stmt_payment = $conn->prepare($sql_payment);
$stmt_payment->bindParam(':orderID', $order['orderID']);
$stmt_payment->execute();
$payments = $stmt_payment->fetchAll(PDO::FETCH_ASSOC);

foreach ($payments as $payment) {
    if ($payment['pay_type'] === 'ค่ามัดจำ') {
        echo '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">สถานะการชำระเงิน :</h5>';
        echo '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">ชำระเงิน ' . $payment['pay_type'] . ' แล้ว</h5>';

        $pay_image = $payment['pay_image']; // Move this line inside the loop

        echo '
        <div class="flex justify-center">
            <button data-popover-target="popover-offset" data-popover-offset="30" type="button" class="justify-center text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-lg px-5 py-2.5 text-center mr-2 mb-2">ดูสลิป</button>
            <div data-popover id="popover-offset" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                    <img class="rounded-t-lg" src="../../Image/' . $pay_image . '" alt="" />
                </div>
                <div class="px-3 py-2">
                    <p>หลักฐานการโอนเงิน</p>
                </div>
                <div data-popper-arrow></div>
            </div>
        </div>';
    }
}
?>
                <!-- End of payment status loop -->

            <a href="#">
                <img class="rounded-t-lg" src="../../Image/qr_codes.jpg" alt="" />
            </a>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">รหัสงานอีเว้นท์ : <?php echo $order['orderID']; ?></h5>
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">ค่าจัดงานอีเว้นท์ : <?php echo $order['total_price']; ?></h5>
                

                <label class="text-center mt-4 block mb-2 text-lg font-medium text-gray-900 dark:text-white" for="file_input">แนบสลิป</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="pay_image" autofocus autocomplete required>
                <div class="flex justify-center">
                    <button type="submit" class="mt-4  text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-lg px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit_payment">ชำระเงิน</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</form>
</body>

</html>
