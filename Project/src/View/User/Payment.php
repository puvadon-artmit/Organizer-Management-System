<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';


// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

// Declare an array to store the product details
$products = array();

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql = "SELECT * FROM event_order WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql_payment = "SELECT pay_status, pay_type FROM payment WHERE orderID = :orderID";
    $stmt_payment = $conn->prepare($sql_payment);
    $stmt_payment->bindParam(':orderID', $orderID);
    $stmt_payment->execute();
    $payment = $stmt_payment->fetch(PDO::FETCH_ASSOC);

    // Store the product details in the $products array
    foreach ($orders as $order) {
        $product = array(
            'orderID' => $order['orderID'],
            'name_event' => $order['name_event'],
            // Add other product details here as needed
        );
        $products[] = $product;
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
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">               
                <?php foreach ($products as $product) { ?>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                <h5 class="mb-2 text-6xl font-bold text-gray-900 dark:text-white text-center">ชำระเงิน</h5>
                <h5 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white text-center"><?php echo $product['name_event']; ?></h5>
                <p class="mb-5 text-2xl text-gray-500 dark:text-gray-400 text-center"> อีเว้นท์ที่ : <?php echo $product['orderID']; ?></p>

                    <!-- <?php
$sql_payment = "SELECT pay_type, pay_status FROM payment WHERE orderID = :orderID";
$stmt_payment = $conn->prepare($sql_payment);
$stmt_payment->bindParam(':orderID', $order['orderID']);
$stmt_payment->execute();
$payments = $stmt_payment->fetchAll(PDO::FETCH_ASSOC);

foreach ($payments as $payment) {
    if ($payment['pay_type'] === 'ค่ามัดจำ') {
        
        echo '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"> ' . $payment['pay_type'] . ':' . $payment['pay_status'] . '</h5>';
       

      
    }
    if ($payment['pay_type'] === 'ค่าจัดงานอีเว้นท์') {
        echo '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"> ' . $payment['pay_type'] . ':' . $payment['pay_status'] . '</h5>';

      
    }
}
?> -->
              
                <p class="mb-5 text-2xl text-gray-500  dark:text-gray-400 text-center">ชำระเงินมัดจำก่อนจัดงาน
                        ส่วนเงินค่าจัดงานทั้งหมดชำระก่อนวันที่ <td class="px-6 py-4"><?php echo $order['dateMonth']; ?>
                            น่ะครับขอบคุณที่ใช้บริการ</td>.</p>
                <!-- Add other product details here as needed -->
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                        <a href="./Pay_deposit.php?orderID=<?php echo $product['orderID']; ?>"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                            ชำระเงินมัดจำ
                        </a>
                        <a href="./Pay_event.php?orderID=<?php echo $product['orderID']; ?>"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                            ชำระเงินจัดงานอีเว้นท์
                        </a>
                        
                    </div>
            </div>
        <?php } ?>
            </div>
        </div>
    </section>
</body>

</html>

  <!-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
  <?php
                        if ($order['order_status'] == 1) {
                            echo 'ยังไม่ชำระเงิน';
                        } elseif ($order['order_status'] == 2) {
                            echo 'รอดำเนินการจัดงาน';
                        } elseif ($order['order_status'] == 3) {
                            echo 'ชำระเงินมัดจำสำเร็จ';
                        }elseif ($order['order_status'] == 4) {
                            echo 'ยกเลิกงานอีเว้นท์';
                        } else {
                            echo 'สถานะไม่ถูกต้อง';
                        }
                        ?>
                    </p> -->