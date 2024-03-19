<?php

include '../Config/Database.php';
include '../Router/User/User_login.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Image/logo.png">
    
    <title>Event Details</title>
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
<?php if(isset($_SESSION['success10'])) { ?>
    <div id="toast-simple" class="p-4 mb-4 text-sm text-slate-950 rounded-lg bg-green-300 dark:bg-gray-800 dark:text-green-400" role="alert">
  <span class="font-medium text-center"> <?php echo $_SESSION['success10']; unset($_SESSION['success10']); ?></span> 
</div>
<script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-simple');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 2000); // 3000 milliseconds = 3 seconds
                    </script>
<?php } ?>
    <?php
    include "../Templates/Mainpage/Navbar.php";
    // if(isset($_SESSION['success10'])) {
    //     echo "<script>";
    //     echo "alert('".$_SESSION['success10']."');";
    //     echo "deleteSession('success10');"; // เรียกใช้งานฟังก์ชัน deleteSession
    //     echo "</script>";
    // }
    // echo "deleteSession('success10');";
    // // ฟังก์ชัน deleteSession ใช้สำหรับลบ session
    // echo "<script>";
    // echo "function deleteSession(name) {";
    // echo "    fetch('../Router/Session/DeleteSession.php?name=' + name);"; // ใช้ fetch เรียกไปยัง Router ที่ทำงานในการลบ session
    // echo "}";
    // echo "</script>";
    include "../Templates/Mainpage/Slider.php";
    include "../Templates/Mainpage/Present.php";
    // include "../Templates/Mainpage/Category.php";
    
    
    ?>
 <!-- หมวดหมู่ -->
<p class="text-6xl font-black text-gray-900 dark:text-white text-center mt-8">Event Category</p>
<p class="text-xl text-gray-500 dark:text-gray-400 text-center mt-4">
    เราเป็นออแกไนเซอร์ที่มีงานอีเว้นท์ให้ท่านได้เลือกจัดงานหลากหลาย พร้อมให้บริการตอบโจทย์ทุกงาน Event
</p>
<hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

<div class="flex justify-center mt-8 mb-5 space-x-8">
    <?php
    // Fetch data from the type_event table
    $query = "SELECT * FROM type_event";
    $result = $conn->query($query);

    $counter = 0; // Initialize a counter

    // Loop through the fetched data and display each category
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Start a new row after every 5 categories
        if ($counter % 5 == 0 && $counter > 0) {
            echo '</div><div class="flex justify-center mt-8 mb-5 space-x-8">';
        }
        $type_img = $row['type_img'];
        echo '<a href="./User/Event_category.php?type_id=' . $row['type_id'] . '">';
        echo '<div class="flex flex-col items-center">';
        echo '<img class="w-12 h-12 mx-4 rounded-full" src="../Image/category/' . $type_img . '" alt="Rounded avatar">';
        echo '</a>';
        echo '<p class="mt-2">' . $row['type_name'] . '</p>';
        echo '</div>';

        $counter++;
    }
    ?>
</div>
<!-- ------------------ -->


<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="mt-6">
        <p class="text-6xl font-black text-gray-900 dark:text-white text-center mt-8">All event</p>
        <p class="text-xl text-gray-500 dark:text-gray-400 text-center mt-4">
            งานอีเว้นท์
        </p>
        
        <a href="../View/User/Search_event.php" >
        <div class="flex justify-center mt-6">
        <form class="flex items-center"  method="GET" action="Index.php">
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
    </a>
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
        <div class="w-80  max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ml-4 ">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="../Image/' . $image . '" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">' . $event_name . '</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">' . $detail . '.</p>
                <div class="flex items-center justify-between">   
                <a href="../View/User/Event_detail.php?id=' . $event_id . '" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">ดูรายละเอียด</a>
                </div
                </div>
            </div>
        </div>';

        echo $eventHtml;
    } else {
        echo "No events found.";
    }
}
?>

    <?php
try {
    $sql = "SELECT * FROM event ORDER BY event_id DESC";
    $stmt = $conn->query($sql);
    $eventHtml = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $event_name = $row['event_name'];
       
        $detail = $row['detail'];
        $image = $row['image']; 
        $event_id = $row['event_id'];
        $eventHtml .= '
        <div class="w-80 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ml-4 ">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="../Image/' . $image . '" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">' . $event_name . '</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">' . $detail . '.</p>
                <div class="flex items-center justify-between">   
                <a href="../View/User/Event_detail.php?id=' . $event_id . '" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">ดูรายละเอียด</a>
                </div
                </div>
            </div>
        </div>';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<div class="flex flex-wrap justify-center mt-8 space-x-4">
    <?php echo $eventHtml; ?>
</div>
    


    <!-- งานอีเว้นท์ -->

    
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <!-- ------------------ -->
    <p class="text-6xl font-black text-gray-900 dark:text-white text-center mt-4">questions</p>
    <p class="text-xl text-gray-800 dark:text-gray-400 text-center mt-4">
        กระทู้สอบถาม
    </p>

    <!-- กระทู้สอบถาม -->

    <section class="bg-blue-500 dark:bg-gray-900" style="background-image: url('../Image/bg-all-login.png');">

        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                <a href="#" class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                     ถามคำถาม
                </a>
                <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2 mt-4">โพสต์กระทู้สอบถาม</h1>
                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-6">เราจะเห็นกระทู้คำถามของคุณคนเดียวเท่านั้นเพื่อความเป็นส่วนตัวของคุณ.</p>
                <a href="../View/User/Question.php" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">โพสคำถาม</a>

            </div>

    </section>

    <!-- --------------- -->
    <p class="text-6xl font-black text-gray-900 dark:text-white text-center mt-4">What We Works</p>
    <p class="text-xl text-gray-500 dark:text-gray-400 text-center mt-4">
        ตัวอย่างงานของเรา
    </p>
    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">

    <!-- รูปภาพผลงานจัดงานอีเว้นท์ -->
    <div class="grid grid-cols-4 gap-2 ml-4 mr-4 mt-4">
        <figure class="max-w-lg">
            <img class="h-auto max-w-full rounded-lg" src="../Image/sample_work/ee1.png" alt="image description">
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">งานเปิดตัวสินค้า</figcaption>
        </figure>
        <figure class="max-w-lg">
            <img class="h-auto max-w-full rounded-lg" src="../Image/sample_work/ee3.png" alt="image description">
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">งานคริสต์มาสบูส</figcaption>
        </figure>
        <figure class="max-w-lg">
            <img class="h-auto max-w-full rounded-lg" src="../Image/sample_work/ee2.png" alt="image description">
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">งานพิธีมงคลสมรส</figcaption>
        </figure>
        <figure class="max-w-lg">
            <img class="h-auto max-w-full rounded-lg" src="../Image/sample_work/ee4.png" alt="image description">
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">งานคริสต์มาส</figcaption>
        </figure>
        <figure class="max-w-lg">
            <img class="h-auto max-w-full rounded-lg" src="../Image/Bamboo-BNK48-3.jpg" alt="image description">
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">งานพิธีมงคลสมรส</figcaption>
        </figure>
    </div>
    <!-- ------------------- -->
    

    <!-- แชร์กับโพส -->
    <div data-dial-init class="fixed right-6 bottom-6 group">
        <div id="speed-dial-menu-default" class="flex-col items-center hidden mb-4 space-y-2">
            <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M14.419 10.581a3.564 3.564 0 0 0-2.574 1.1l-4.756-2.49a3.54 3.54 0 0 0 .072-.71 3.55 3.55 0 0 0-.043-.428L11.67 6.1a3.56 3.56 0 1 0-.831-2.265c.006.143.02.286.043.428L6.33 6.218a3.573 3.573 0 1 0-.175 4.743l4.756 2.491a3.58 3.58 0 1 0 3.508-2.871Z"/>
                </svg>
                <span class="sr-only">แชร์</span>
            </button>
            <div id="tooltip-share" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                แชร์
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>


        
            <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 12a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm10 6H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                </svg>
                <span class="sr-only">โพสกระทู้</span>
            </button>
            <div id="tooltip-download" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                โพส
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            
              
        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-default" aria-controls="speed-dial-menu-default" aria-expanded="false" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
    <!-- ------------------- -->
    <?php
    include "../Templates/Mainpage/Footer.php";
    ?>
</body>

</html>