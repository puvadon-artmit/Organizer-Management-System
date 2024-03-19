<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';

try {
    // Fetch data from the event_order table
    $sql = "SELECT * FROM event_order";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $eventOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    
    $sql = "SELECT name_event, COUNT(*) AS event_count FROM event_order GROUP BY name_event";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $eventData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $totalEvents = array_sum(array_column($eventData, 'event_count'));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
   
    $sql2 = "SELECT * FROM address";
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
    $address = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <h1 class="title">รายการจ้างจัดงานอีเว้นท์</h1>
            <ul class="breadcrumbs">
                <li><a href="#" class="active">หน้าหลัก</a></li>
                <li class="divider">/</li>
                <li><a href="#" >รายการจ้างจัดงานอีเว้นท์</a></li>
            </ul>
         <!-- รายการ -->
            <ul class="grid w-full gap-6 md:grid-cols-3 mt-4">
                <a href="./View_confirm.php">
    <li>    
        <label for="react-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
            <div class="block">
       
                <svg class="mb-2 w-7 h-7 text-green-400" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
    <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
  
            </svg>
                <div class="w-full text-lg font-semibold ">ดูรายการรับงานอีเว้นท์</div>
                <div class="w-full text-sm">รายการรับงานอีเว้นท์ทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>
    <a href="./All_operation.php">
    <li>
        <label for="flowbite-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
                <svg class="mb-2 text-yellow-400 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M19 4h-1a1 1 0 1 0 0 2v11a1 1 0 0 1-2 0V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V5a1 1 0 0 0-1-1ZM3 4a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4Zm9 13H4a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-3H4a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-3H4a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-3h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2Zm0-3h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2Z"/>
    <path d="M6 5H5v1h1V5Z"/></svg>
                <div class="w-full text-lg font-semibold">อัพเดทขั้นตอนการดำเนินงาน</div>
                <div class="w-full text-sm">อัพเดทขั้นตอนการดำเนินงานการจ้างจัดงานทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>
    <a href="#">
    <li>
        <label for="angular-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
                <svg class="mb-2 text-red-600 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20"><path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/></svg>
                <div class="w-full text-lg font-semibold">ดูรายการสถานที่จัดงาน</div>
                <div class="w-full text-sm">ดูรายการสถานที่จัดงานอีเว้นท์ทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>

    <a href="./Proof_payment.php">
    <li>    
        <label for="react-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
            <div class="block">
         
                <svg class="mb-2 w-7 h-7 text-sky-500" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
    <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/></svg>
                <div class="w-full text-lg font-semibold ">ดูหลักฐานการชำระเงิน</div>
                <div class="w-full text-sm">หลักฐานการชำระเงินของการจ้างจัดงานทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>
    <a href="./View_successful.php">
    <li>
        <label for="angular-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
                <svg class="mb-2 text-green-500 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
                <div class="w-full text-lg font-semibold">ดูรายการจัดงานอีเว้นท์สำเร็จ</div>
                <div class="w-full text-sm">ดูรายการจัดงานอีเว้นท์สำเร็จทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>

    <a href="./View_cencal.php">
    <li>
        <label for="angular-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="block">
                <svg class="mb-2 text-red-600 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20"><path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/></svg>
                <div class="w-full text-lg font-semibold">ดูรายการยกเลิกจัดงานอีเว้นท์</div>
                <div class="w-full text-sm">ดูรายการยกเลิกจัดงานอีเว้นท์ทั้งหมด.</div>
            </div>
        </label>
    </li>
    </a>
   
    
</ul>
           <!-- ----------------- -->
             <!-- ข้อมูลเทเบิ้ล -->
             <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                        <!-- เลือกวันที่ -->
                        <div date-rangepicker class="flex items-center justify-center ">
                            <div class="relative">
                            <div class="relative w-40 mt-4 ">
                        
                        <div class="flex justify-center">
                        <div class="relative ">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>
    <input type="text" id="table-search-user" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for dateMonth">
</div>
</div>
<!-- ... Your existing table code ... -->

<script>
    // Function to handle the search event
    function handleSearch() {
        const input = document.getElementById("table-search-user");
        const filter = input.value.toUpperCase();
        const table = document.querySelector("table");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let rowMatchesSearch = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const cellText = cell.textContent || cell.innerText;
                    if (cellText.toUpperCase().indexOf(filter) > -1) {
                        rowMatchesSearch = true;
                        break;
                    }
                }
            }

            rows[i].style.display = rowMatchesSearch ? "" : "none";
        }
    }

    // Attach the search event listener
    document.getElementById("table-search-user").addEventListener("keyup", handleSearch);
</script>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['success11'])) { ?>
    <div id="toast-simple" class="p-4 mb-4 text-sm text-slate-950 rounded-lg bg-green-300 dark:bg-gray-800 dark:text-green-400" role="alert">
  <span class="font-medium text-center"> <?php echo $_SESSION['success11']; unset($_SESSION['success11']); ?></span> 
</div>
<script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-simple');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 3000); // 3000 milliseconds = 3 seconds
                    </script>
<?php } ?>
<?php if(isset($_SESSION['success12'])) { ?>
    <div id="toast-simple" class="p-4 mb-4 text-sm text-slate-950 rounded-lg bg-red-400 dark:bg-gray-800 dark:text-slate-50" role="alert">
  <span class="font-medium text-center"> <?php echo $_SESSION['success12']; unset($_SESSION['success12']); ?></span> 
</div>
<script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-simple');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 3000); // 3000 milliseconds = 3 seconds
                    </script>
<?php } ?>
<?php if(isset($_SESSION['success13'])) { ?>
    <div id="toast-simple" class="p-4 mb-4 text-sm text-slate-950 rounded-lg bg-green-400 dark:bg-gray-800 dark:text-slate-50" role="alert">
  <span class="font-medium text-center"> <?php echo $_SESSION['success13']; unset($_SESSION['success13']); ?></span> 
</div>
<script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-simple');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 3000); // 3000 milliseconds = 3 seconds
                    </script>
<?php } ?>
                        <!-- ------ -->
                        <tr>
                            <th scope="col" class="px-6 py-3 mt-4">
                                ชื่องานอีเว้นท์
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ชื่อ-นามสกุล
                            </th>
                           
                            
                            <th scope="col" class="px-6 py-3">
                                ราคา
                            </th>
                            <th scope="col" class="px-6 py-3">
                                สถานะอีเว้นท์
                            </th>
                            
                            <th scope="col" class="px-6 py-3">
                                วันที่จัดงาน
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

            <?php foreach ($eventOrders as $eventOrder) : ?>
                <?php if ($eventOrder['order_status'] == 2) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $eventOrder['name_event']; ?>
                    </th>
                    <td class="px-6 py-4">
                       
                        <?php echo $eventOrder['fl_name']; ?>
                    </td>
                   
                    <td class="px-6 py-4">
                        <?php echo number_format($eventOrder['total_price'], 2); ?> บาท
                    </td>
                    <td class="px-6 py-4">
                    <?php
                            if ($eventOrder['order_status'] == 1) {
                                echo 'ยังไม่ชำระเงิน';
                            } elseif ($eventOrder['order_status'] == 2) {
                                echo 'รอดำเนินการ';
                            } elseif ($eventOrder['order_status'] == 3) {
                                echo 'รับจัดงานแล้ว';
                            }elseif ($eventOrder['order_status'] == 4) {
                                echo 'ยกเลิกงานอีเว้นท์';
                            }elseif ($eventOrder['order_status'] == 5) {
                                echo 'จัดงานอีเว้นท์สำเร็จ';
                            } else {
                                echo 'สถานะไม่ถูกต้อง';
                            }
                            ?>
                    
                    </td>
                    <td class="px-6 py-4">
                    <?php echo $eventOrder['dateMonth']; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                       
                                <a href="#" type="button"  
                                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">รายละเอียดงานอีเว้นท์</a>
                            
                        <!-- <a href="#" class="font-medium text-yellow-400 dark:text-blue-500 hover:underline">รายละเอียดงานอีเว้นท์</a> -->
                    </td>
                    <td class="px-6 py-4 text-right">
                         <form action="../../../Router/Admin/Cancel_event.php?orderID= <?php echo $eventOrder['orderID']; ?>"
                                id="form1" method="POST" enctype="multipart/form-data">
                                <button type="submit"  
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">ยกเลิก</button>
                            </form>
                        <!-- <a href="#" class="font-medium text-red-600 dark:text-blue-500 hover:underline">ยกเลิก</a> -->
                    </td>
                    <td class="px-6 py-4 text-right">
                    <form action="../../../Router/Admin/Confirm_event.php?orderID= <?php echo $eventOrder['orderID']; ?>"
                                id="form1" method="POST" enctype="multipart/form-data">
                                <button type="submit"  
                                    class="text-white bg-green-500 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">รับจัดงาน</button>
                            <!-- </form> -->
                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">รับจัดงาน</a> -->
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
                </table>
                <!-- เลือกหน้า -->

                <nav aria-label="Page navigation example ">
                    <ul class="flex items-center -space-x-px h-10 text-base ">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
</div>
            <!-- --- -->
            </div>
        </main>
        <!-- ------ -->



        <!-- MAIN -->
    </section>

    <!-- NAVBAR -->

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>