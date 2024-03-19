<?php

include '../../Config/Database.php';
include '../../Router/User/User_login.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <title>Event Details</title>
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>

    <?php
    include "../../Templates/Mainpage/Navbar2.php";
    
    
    ?>

<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="mt-6">
        

        <div class="flex justify-center mt-6">
        <form class="flex items-center"  method="GET" action="Search_event.php">
            <label for="simple-search" class="sr-only">ค้นหา</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                </div>
                <input type="text" id="simple-search" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ค้นหาชื่ออีเว้นท์ ..." required>
               
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">ค้นหา</span>
            </button>
        </form>
    </div>
<?php 

$key_word = isset($_GET['keyword']) ? $_GET['keyword'] : "";

if (isset($_GET['keyword'])) {
    $key_word = '%' . $_GET['keyword'] . '%';
    $sql = "SELECT * FROM event WHERE event_id = :key_word OR event_name LIKE :key_word ORDER BY event_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':key_word' => $key_word
    ]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process and display results
    if (count($results) > 0) {
        $eventHtml = '';

        $row = $results[0]; // Get the first event from the search results
        $event_name = $row['event_name'];
        $detail = $row['detail'];
        $image = $row['image'];
        $event_id = $row['event_id'];

        $eventHtml .= '
        <div class="flex justify-center mt-8">
        <div class="w-80 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ml-4 ">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="../../Image/' . $image . '" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">' . $event_name . '</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">' . $detail . '.</p>
                <div class="flex items-center justify-between">   
                <a href="./Event_detail.php?id=' . $event_id . '" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">ดูรายละเอียด</a>
                </div
                </div>
            </div>
        </div>
        </div>';

        echo $eventHtml;
    } else {
        echo '
        <div class="flex justify-center mt-8">
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium"></span> ไม่ข้อมูลงานอีเว้นท์ที่ค้นหา.
            </div>
        </div>';
    }
}
?>

  
    <!-- ------------------- -->
    
</body>

</html>