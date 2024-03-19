<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


try {
    $orderID = $_GET['orderID'];
    // Fetch the data from the event_order table for the logged-in user and the specified Pay_deposit value
    $sql = "SELECT * FROM event_order WHERE  orderID = :orderID";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':orderID', $orderID); // ใช้ $orderID ที่รับมาจาก URL ในการ bind พารามิเตอร์ pay_deposit
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql_payment = "SELECT pay_type FROM payment WHERE orderID = :orderID";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"
        integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../../../CSS/dashboard.css">
    <link rel="icon" href="../../../Image/logo.png">
    <title>Admin</title>
</head>

<body>

    <?php
   include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>


<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 max-w-screen-xl lg:py-16 ml-auto">
        <div class="flex justify-center "> <!-- Add flex container -->
            <div class="max-w-sm mr-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <?php foreach ($orders as $order) : ?>
                    <?php
                    $sql_payment = "SELECT pay_type, pay_image FROM payment WHERE orderID = :orderID";
                    $stmt_payment = $conn->prepare($sql_payment);
                    $stmt_payment->bindParam(':orderID', $order['orderID']);
                    $stmt_payment->execute();
                    $payments = $stmt_payment->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($payments as $payment) {
                        if ($payment['pay_type'] === 'ค่าจัดงานอีเว้นท์') {
                            ?>

                            <div class="flex items-center justify-center">
                <div class="w-full  max-w-lg bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">สถานะการชำระเงิน :</h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-500 dark:text-white text-center">ชำระเงิน <?php echo $payment['pay_type']; ?> แล้ว</h5>

                    <?php
                    $pay_image = $payment['pay_image']; // Move this line inside the loop
                    ?>

                    <img class="object-cover w-full h-full" src="../../../Image/<?php echo $pay_image; ?>" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $payment['pay_type']; ?></h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </div>
            </div>


                            <?php
                        }
                    }
                    ?>
                <?php endforeach; ?>
            </div>
            
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <?php foreach ($orders as $order) : ?>
                    <?php
                    $sql_payment = "SELECT pay_type, pay_image FROM payment WHERE orderID = :orderID";
                    $stmt_payment = $conn->prepare($sql_payment);
                    $stmt_payment->bindParam(':orderID', $order['orderID']);
                    $stmt_payment->execute();
                    $payments = $stmt_payment->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($payments as $payment) {
                        if ($payment['pay_type'] === 'ค่ามัดจำ') {
                            ?>

                           <div class="flex items-center justify-center">
                <div class="w-full max-w-lg bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">สถานะการชำระเงิน :</h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-500 dark:text-white text-center">ชำระเงิน <?php echo $payment['pay_type']; ?> แล้ว</h5>

                    <?php
                    $pay_image = $payment['pay_image']; // Move this line inside the loop
                    ?>

                    <img class="object-cover w-full h-full" src="../../../Image/<?php echo $pay_image; ?>" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $payment['pay_type']; ?></h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    </div>
                </div>
            </div>


                            <?php
                        }
                    }
                    ?>
                <?php endforeach; ?>
               
            </div>
        </div>
        <div class="flex justify-center mt-4"> 
                <a href="./Proof_payment.php" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
                </div>
    </div>
</section>

   





    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>