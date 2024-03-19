<?php


include '../../Config/Database.php';
include '../../Router/Organizer/Organizer_login.php';


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>
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
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                <ul class="grid w-full gap-6 md:grid-cols-3 mt-4 mb-4">
                    <a href="./Received_job.php">
                        <li>
                            <label for="react-option"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <svg class="mb-2 w-7 h-7 text-green-400" fill="currentColor" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                    </svg>
                                    <div class="w-full text-lg font-semibold ">งานอีเว้นท์ที่รับแล้ว</div>
                                    <div class="w-full text-sm">
                                        งานอีเว้นท์ที่รับแล้วทั้งหมด</div>
                                </div>
                            </label>
                        </li>
                    </a>




                    <a href="./Cancal_job.php">
                        <li>
                            <label for="flowbite-option"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <svg class="mb-2 text-red-500 w-7 h-7" fill="currentColor" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <div class="w-full text-lg font-semibold">งานอีเว้นท์ที่ยกเลิกแล้ว</div>
                                    <div class="w-full text-sm">
                                        งานอีเว้นท์ที่ยกเลิกแล้วทั้งหมด.
                                    </div>
                                </div>
                            </label>
                        </li>
                    </a>

         
                    <a href="./Update_schedule.php">
                        <li>
                            <label for="angular-option"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <svg class="mb-2 text-blue-400 w-7 h-7" fill="currentColor" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z"/>
    <path d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z"/>
  </svg>

                                    <div class="w-full text-lg font-semibold">อัพเดทตารางงาน</div>
                                    <div class="w-full text-sm">อัพเดทตารางงานในการจัดงานอีเว้นท์.</div>
                                </div>
                            </label>
                        </li>
                    </a>
                </ul>
            </div>
            <!-- -------------------------- -->

            <div class="grid md:grid-cols-2 gap-8">
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">


                    <div
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                        <?php
             $organizer_id = $_SESSION['user_id'];
             $sql = "SELECT event_date, job_dt, job_price, organizer_id, orderID, job_status, epm_id FROM employment WHERE organizer_id = :organizer_id AND job_status = 'pending' ORDER BY event_date DESC LIMIT 3";
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
                                    
                                    <!-- <a href="" class="mb-2 text-base text-blue-600">รายละเอียดงาน</a> -->
                                </div>

                            </div>
                        </li>
                        <div class="flex">
                            <form action="../../Router/Organizer/AcceptJob.php?epm_id=<?php echo $row['epm_id']; ?>"
                                id="form1" method="POST" enctype="multipart/form-data">
                                <button type="submit"
                                    class="text-white bg-green-500 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">รับงาน</button>
                            </form>
                            <form action="../../Router/Organizer/CancelJob.php?epm_id=<?php echo $row['epm_id']; ?>"
                                id="form1" method="POST" enctype="multipart/form-data">
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">ยกเลิก</button>
                            </form>
                        </div>


                        <?php
                          }
                          ?>

                        <div class="flex -space-x-4 justify-center mt-4">
                            <!-- Add any additional elements or buttons as needed -->
                        </div>
                    </div>


                </div>

                

                <!-- -------------------ตารางงาน----------------------- -->
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                    <div
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                        <?php
             $organizer_id = $_SESSION['user_id'];
             $sql = "SELECT work_schedule, detail_schedule, organizer_id FROM schedule WHERE organizer_id = :organizer_id  ORDER BY work_schedule DESC LIMIT 3";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(':organizer_id', $organizer_id, PDO::PARAM_INT);
             $stmt->execute();
            
            while ($row = $stmt->fetch()) {
            $work_schedule = $row['work_schedule'];
            $detail_schedule = $row['detail_schedule'];
            $organizer_id = $_SESSION['user_id'];
              ?>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-3">
                                <!-- Your other HTML code remains the same -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                        เวลา : <?php echo $work_schedule; ?>
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        รายละเอียด : <?php echo $detail_schedule; ?>
                                    </p>
                                    <p class="text-xs text-gray-500 truncate dark:text-gray-400 mt-2">
                                        Organizer ID: <?php echo $organizer_id; ?>
                                    </p>
                                    
                                    
                                </div>

                            </div>
                        </li>
                      


                        <?php
                          }
                          ?>

                        <div class="flex -space-x-4 justify-center mt-4">
                            <!-- Add any additional elements or buttons as needed -->
                        </div>
                    </div>


            </div>
        </div>
    </section>

   








</body>

</html>