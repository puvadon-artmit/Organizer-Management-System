<?php

include '../../Config/Database.php';
include '../../Router/Admin/admin_login.php';


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
    <link rel="stylesheet" href="../../CSS/dashboard.css">
    <link rel="icon" href="../../Image/logo.png">
    <title>Admin</title>
</head>

<body>

    <?php
   include '../../Templates/Dashboard/Sidebar.php';
   include '../../Templates/Dashboard/Navbar.php';
   ?>

    <!-- NAVBAR -->
    <section id="content">

        <!-- MAIN -->
        <main>
            <!-- <h8><?php           
            echo $firstname . ' ' . $lastname; ?></h8> -->
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Dashboard</a></li>
            </ul>
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            <p>ยอดการจ้างจัดงาน</p>
                            <h2><?php echo $totalEvents; ?></h2>
                            <p>งาน</p>
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">ดูรายละเอียด</button>
                        </div>

                    </div>

                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <p>กระทู้สอบถาม</p>
                            <h2><?php echo $totalQuestions; ?></h2>
                            <p>กระทู้</p>
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">ดูรายละเอียด</button>
                        </div>

                    </div>


                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <p>รีวิวการจัดงาน</p>
                            <h2>0</h2>
                            <p>รีวิว</p>
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">ดูรายละเอียด</button>
                        </div>

                    </div>

                </div>
                <div class="card">
                    <div class="head">
                        <div class="justify-center">
                            <p>การจัดงานอีเว้นท์ที่สำเร็จ</p>
                            <h2>1</h2>
                            <p>งาน</p>
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">ดูรายละเอียด</button>
                        </div>

                    </div>

                </div>
            </div>
            <!-- ส่วนกลาง -->
            <section class="bg-white dark:bg-gray-900 mt-6">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-5">

                    <div class="grid md:grid-cols-2 gap-8">
                        <div
                            class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">

                            <div>
                                <canvas id="myChart"></canvas>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                          <?php 
                        try {
                            // Fetch data from the event_order table
                            $sql = "SELECT name_event, COUNT(*) AS event_count FROM event_order GROUP BY name_event";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $eventData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }  
                        ?>
                         <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($eventData, 'name_event')); ?>,
                datasets: [{
                    label: 'ยอดจัดงานแต่ล่ะเดือน',
                    data: <?php echo json_encode(array_column($eventData, 'event_count')); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
                        </div>
                        

                        <?php
                       include "../../Templates/Dashboard/Alluser.php";
                            ?>

            </section>
            <!-- ข้อมูลเทเบิ้ล -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                       
                        <div class="flex justify-center">
                        <div class="relative mb-4">
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
                                วันที่จัดงาน
                            </th>
                            <th scope="col" class="px-6 py-3">
                               เบอร์โทรศัพท์
                            </th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <?php echo $eventOrder['dateMonth']; ?>
                    </td>
                    <td class="px-6 py-4 ">
                    <?php echo $eventOrder['phone']; ?>
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

            <!-- --- -->
            </div>
        </main>
        <!-- ------ -->



        <!-- MAIN -->
    </section>

    <!-- NAVBAR -->

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>