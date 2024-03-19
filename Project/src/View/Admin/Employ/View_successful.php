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
          
          <p class="text-4xl font-black text-gray-900 dark:text-white">รายการจัดงานอีเว้นท์สำเร็จ</p>
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
                         
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($eventOrders as $eventOrder) : ?>
    <?php if ($eventOrder['order_status'] == 5) : ?>
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
                รับจัดงานแล้ว
            </td>
            <td class="px-6 py-4">
                <?php echo $eventOrder['dateMonth']; ?>
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
        <div class="flex justify-center "> 
                <a href="./All_employ.php" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
                </div>


        <!-- MAIN -->
    </section>

    <!-- NAVBAR -->

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>