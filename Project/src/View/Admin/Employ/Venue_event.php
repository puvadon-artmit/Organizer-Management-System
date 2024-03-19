<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


try {
    $orderID = $_GET['orderID'];
    
    // Fetch the data from the event_order table for the logged-in user and the specified orderID
    $sql = "SELECT * FROM event_order WHERE orderID = :orderID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':orderID', $orderID);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

   

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
        <div class="py-16 px-4 max-w-screen-xl lg:py-16 ml-auto">
        <div class="flex flex-wrap -mx-4 justify-center">
            <div
                class="max-w-sm mr-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
               
                  
                    <?php foreach ($orders as $order) : ?>
                    <?php
    $sql_address = "SELECT address_list, province, district, subdistrict FROM address WHERE orderID = :orderID"; // เพิ่มชื่อคอลัมน์ที่ต้องการดึงออกมาใน SELECT statement
    $stmt_address = $conn->prepare($sql_address);
    $stmt_address->bindParam(':orderID', $order['orderID']);
    $stmt_address->execute();
    $address = $stmt_address->fetchAll(PDO::FETCH_ASSOC); // ใช้ fetchAll เพื่อรับผลลัพธ์ทั้งหมด
    foreach ($address as $addressData) {
    ?>
<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-8 mt-8">
    <div class="flex items-center justify-center">
        <div class="w-full max-w-lg bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <h5 class="mb-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center"></h5>
            <h5 class="mb-4 text-4xl font-bold tracking-tight text-green-500 dark:text-white text-center">
                ที่อยู่ : <?php echo $addressData['address_list']; ?> </h5>
            <div class="flex flex-col justify-between p-8 leading-normal">
                <h5 class="mb-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                    จังหวัด : <?php echo $addressData['province']; ?></h5>
                <p class="mb-5 text-xl font-normal text-gray-700 dark:text-gray-400">
                    อำเภอ : <?php echo $addressData['district']; ?></p>
                <p class="mb-5 text-xl font-normal text-gray-700 dark:text-gray-400">
                    ตำบล : <?php echo $addressData['subdistrict']; ?></p>
            </div>
        </div>
    </div>
</div>
                    <?php
    }
    ?>
                    <?php endforeach; ?>

                </div>
                <!-- -------------------- -->
                 <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                
                        <?php foreach ($orders as $order) : ?>
                        <?php
   $sql_event_info = "SELECT event_detail.name_dt, event_detail.detail, event_detail.detail_img 
   FROM event_receipt 
   INNER JOIN event_detail ON event_receipt.detail_id = event_detail.detail_id 
   WHERE event_receipt.orderID = :orderID AND event_receipt.type_dtname = 'สถานที่จัดงาน'";

$stmt_event_info = $conn->prepare($sql_event_info);
$stmt_event_info->bindParam(':orderID', $order['orderID']);
$stmt_event_info->execute();
$event_info = $stmt_event_info->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($event_info as $eventData) {
    ?>
       <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mt-2">
                    <div class="flex items-center justify-center">
                        <div class="w-full max-w-lg bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                สถานที่จัดงานอีเว้นท์ :</h5>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-500 dark:text-white text-center">
                                <?php echo $eventData['name_dt']; ?></h5>
                            <img class="object-cover w-full h-full"
                                src="../../../Image/<?php echo $eventData['detail_img']; ?>" alt="">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <?php echo $eventData['name_dt']; ?></h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <?php echo $eventData['detail']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
    }
    ?>
                        <?php endforeach; ?>

                    </div>


                </div>
            </div>
            <div class="flex justify-center mt-4">
                <a href="./View_venue.php" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
            </div>
        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>