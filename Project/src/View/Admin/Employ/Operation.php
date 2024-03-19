<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';

try {
    $orderID = $_GET['orderID'];
   
    $sql = "SELECT * FROM event_order WHERE orderID =:orderID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':orderID', $orderID);
    $stmt->execute();
    $eventOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    
    // Fetch data from the event_order table
    $sql = "SELECT name_event, COUNT(*) AS event_count FROM event_order GROUP BY name_event";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $eventData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate the total number of events
    $totalEvents = array_sum(array_column($eventData, 'event_count'));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    // Fetch data from the questions table
    $sql = "SELECT COUNT(*) AS question_count FROM questions";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $questionData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get the total number of questions
    $totalQuestions = $questionData['question_count'];
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


    <!-- NAVBAR -->
    <section id="content">

        <!-- MAIN -->
        <main>
            <!-- <h8><?php           
            echo $firstname . ' ' . $lastname; ?></h8> -->
            <h1 class="title">อัพเดทขั้นตอนการดำเนินงาน</h1>
            <ul class="breadcrumbs">
                <li><a href="#" class="active">หน้าหลัก</a></li>
                <li class="divider">/</li>
                <li><a href="#" >รายการจ้างจัดงานอีเว้นท์</a></li>
                <li class="divider">/</li>
                <li><a href="#" >อัพเดทขั้นตอนการดำเนินงาน</a></li>
            </ul>
       
             <!-- ข้อมูลเทเบิ้ล -->
             <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                  

            <?php foreach ($eventOrders as $eventOrder) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <p class="text-2xl font-black text-gray-900 dark:text-white text-center"><?php echo $eventOrder['name_event']; ?> คุณ : <?php echo $eventOrder['fl_name']; ?></p>    
                    
                    </th>  
                </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
                <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

        <form action="../../../Router/Admin/Operation_DB.php?orderID=<?php echo $orderID; ?>" id="form1" method="POST" enctype="multipart/form-data">
        <div class="mb-6">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ขั้นตอนดำเนินงาน</label>
<textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ข้อมูลดำเนินงานจัดงานอีเว้นท์..."autofocus autocomplete required></textarea>
</div>
<div class="flex justify-center">
<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">อัพเดท</button>
</div>
            </form>
            </div> 
        </div>
        <!-- MAIN -->
    </section>

            </div>
        </main>
        <!-- ------ -->
      

    <!-- NAVBAR -->

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>