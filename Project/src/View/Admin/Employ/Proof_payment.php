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
          
       
             <!-- ข้อมูลเทเบิ้ล -->
             <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                        <!-- เลือกวันที่ -->
                        <div date-rangepicker class="flex items-center justify-center ">
                            <div class="relative">
                            <div class="relative w-40 mt-4 ">
                        <h4>ค้นหาวันที่ในการจัดงาน</h4>
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
                                ราคามัดจำ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                วันที่จัดงาน
                            </th>
                           
                            <th scope="col" class="px-6 py-3">
                                
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    
                    <?php
if (isset($_GET['success']) && $_GET['success'] === '1') {
    
    // Display the success alert message if the address was successfully added
    echo '<div id="alert-border-1" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">';
    echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
    echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
    echo '</svg>';
    echo '<div class="ml-3 text-sm font-medium">';
    echo 'อัพเดทขั้นตอนดำเนินงานสำเร็จ.';
    echo '</div>';
    echo '<button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-1" aria-label="Close">';
    echo '<span class="sr-only">Dismiss</span>';
    echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
}
?>
            <?php foreach ($eventOrders as $eventOrder) : ?>
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
                        <?php echo number_format($eventOrder['deposit'], 2); ?> บาท
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $eventOrder['dateMonth']; ?>
                    </td>
                  
                    
                    <td class="px-6 py-4 text-right">
                        <a href="./View_payment.php?orderID=<?php echo $eventOrder['orderID']; ?>" class="font-medium text-blue-400 dark:text-blue-500 hover:underline">ดูหลักฐานการชำระเงินอีเว้นท์</a>
                    </td>
                </tr>
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