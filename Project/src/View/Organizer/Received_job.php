<?php


include '../../Config/Database.php';
include '../../Router/Organizer/Organizer_login.php';


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Received a job</title>
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>

    <?php 
    include "../../Templates/Organizer_page/Navbar.php";
    ?>

    <!-- --------------------------------------------- -->
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
           
            <!-- -------------------------------------- -->
            
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <p class="text-4xl font-black text-gray-900 dark:text-white">รับจัดงานอีเว้นท์แล้ว</p>
            <?php
             $organizer_id = $_SESSION['user_id'];
             $sql = "SELECT event_date, job_dt, job_price, organizer_id, orderID, job_status, epm_id FROM employment WHERE organizer_id = :organizer_id AND job_status = 'accord' ORDER BY event_date DESC LIMIT 3";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(':organizer_id', $organizer_id, PDO::PARAM_INT);
             $stmt->execute();
            
            while ($row = $stmt->fetch()) {
            $event_date = $row['event_date'];
            $job_dt = $row['job_dt'];
            $job_price = $row['job_price'];
    
            $organizer_id = $_SESSION['user_id'];
            $orderID = $row['orderID'];
            $job_status = $row['job_status'];
              ?>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-3">
                                <!-- Your other HTML code remains the same -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                        <?php echo $event_date; ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Job Price: <?php echo $job_price; ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Job Detail: <?php echo $job_dt; ?>
                                    </p>
                                    <p class="text-xs text-gray-500 truncate dark:text-gray-400 mt-2">
                                        Organizer ID: <?php echo $organizer_id; ?>, Order ID: <?php echo $orderID; ?>
                                    </p>
                                    <p class="text-xs text-gray-500 truncate dark:text-gray-400 mt-2 mb-2">
                                        Job Status: <?php echo $job_status; ?>
                                    </p>                                 
                                </div>

                            </div>
                        </li>
                       
                       
                                <hr>
                        <?php
                          }
                          ?>
                          
            </div>
            <div class="flex justify-center"> 
                        <a href="./Index.php" type="button"  class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
                        </div>
            </div>
        </div>
    </section>

   








</body>

</html>