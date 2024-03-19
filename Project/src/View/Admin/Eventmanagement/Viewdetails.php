<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


//ตรวจสอบว่ามีการส่งค่า event_id ผ่านพารามิเตอร์ id
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
} else {
    // หากไม่ได้รับค่า event_id ให้กลับไปหน้าที่ต้องการ
    header('Location: ../../View/Add_event.php');
    exit();
}

$sql = "SELECT event.event_id, event.event_name, event_detail.*, type_detail.type_dtname
        FROM event
        INNER JOIN event_detail ON event.event_id = event_detail.event_id
        INNER JOIN type_detail ON type_detail.type_dtid = event_detail.type_dtid
        WHERE event.event_id = :event_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
$stmt->execute();
$event_details = $stmt->fetchAll(PDO::FETCH_ASSOC);





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
   include '../../../Templates/Dashboard/SidebarEm.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>



    <section id="content">

        <!-- MAIN -->
        <main>
            <!-- <h8><?php           
            echo $firstname . ' ' . $lastname; ?></h8>
            <h1 class="title">Dashboard</h1>
            
            <br>
            <h5>ชื่องานอีเว้นท์: <?php echo $event_details[0]['event_name']; ?></h5> -->
            <!-- ส่วนหัว -->

            <!-- <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="alert  h4 text-center mb-6 mt-4" role="alert" style="background-color: #CCCCFF;">
                            รายละเอียดงานอีเว้นท์
                            <h5 class="mt-4">รหัสงานอีเว้นท์: <?php echo $event_details[0]['event_id']; ?></h5>
                            <h5>ชื่องานอีเว้นท์: <?php echo $event_details[0]['event_name']; ?></h5>
                        </div> -->
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div class="mt-4 p-4 mb-4 text-4xl text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 text-center " role="alert">
  <span class="font-medium"><?php echo $event_details[0]['event_name']; ?></span> 
  
</div>
                    <div
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                        <div class="mt-4 p-4 mb-4 text-lg text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
  <span class="font-medium">รายล่ะเอียดงาน</span> 
</div>
                      


                        
<div class="grid grid-cols-3 gap-4 mt-4">
    <?php foreach ($event_details as $event_detail): ?>
        <?php if ($event_detail['type_dtid'] === '0000000001'): ?>
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="../../../Image/<?php echo $event_detail['detail_img']; ?>" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?php echo $event_detail['name_dt']; ?>
                        </h5>
                    </a>
                    <span class="font-medium text-lg text-green-500"><?php echo $event_detail['type_dtname']; ?></span>
                    <p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">
                        <?php echo $event_detail['detail']; ?>
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        ราคา: <?php echo $event_detail['price']; ?> บาท
                    </p>
                    <!-- <a href="#" type="button" class="mt-4 text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        ลบ
                    </a> -->
                </div>
            </div>
            
        <?php elseif ($event_detail['type_dtid'] === '0000000002'): ?>
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="../../../Image/<?php echo $event_detail['detail_img']; ?>" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?php echo $event_detail['name_dt']; ?>
                        </h5>
                    </a>
                    <span class="font-medium text-lg text-blue-500"><?php echo $event_detail['type_dtname']; ?></span>
                    <p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">
                        <?php echo $event_detail['detail']; ?>
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        ราคา: <?php echo $event_detail['price']; ?> บาท
                    </p>
                    <!-- <a href="#" type="button" class="mt-4 text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        ลบ
                    </a> -->
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>




                        <div class="mt-4 p-4 mb-4 text-lg text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
  <span class="font-medium">สถานที่จัดงาน</span> 
</div>
                       

                        <!-- ------------- -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>