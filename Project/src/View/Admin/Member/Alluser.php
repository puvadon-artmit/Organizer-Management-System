<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';



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
            
        <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
           
            <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2">ผู้ใช้งานที่เป็นสมาชิกในระบบ</h1>
            <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-6"></p>
           


            
<!-- --------------------- -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        <div class="ml-4">
          ผู้ใช้งานที่เป็นสมาชิกทั้งหมด
        </div>

        <div class="relative ">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>
    <input type="text" id="table-search-user" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for organizers">
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
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                
                <th scope="col" class="px-6 py-3">
                    ชื่อ
                </th>
                <th scope="col" class="px-6 py-3">
                    อีเมล
                </th>
                <th scope="col" class="px-6 py-3">
                    เวลาที่สมัครสมาชิก
                </th>
                <th scope="col" class="px-6 py-3">
                    แก้ไขข้อมูลส่วนตัว
                </th>
                <th scope="col" class="px-6 py-3">
                    ลบบัญชี
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $sql = "SELECT firstname, lastname, email, profile_img, urole, created_at FROM users WHERE urole = 'user' ORDER BY created_at DESC ";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch()) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $created_at = $row['created_at'];
            $profile_img = $row['profile_img'];
            $urole = $row['urole'];
    ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="../../../Image/<?php echo $profile_img; ?>" alt="Jese image">
                    <div class="pl-3">
                        <div class="text-base font-semibold"> <?php echo $firstname . ' ' . $lastname; ?></div>
                        
                    </div>  
                </th>
                <td class="px-6 py-4">
                <?php echo $email; ?>
                </td>
                <td class="px-6 py-4">
                <?php echo $created_at; ?>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete user</a>
                </td>
            </tr>
            <?php
        }
    ?>
            </tr>
        </tbody>
    </table>
</div>
<!-- --------------------------- -->
        </div>
       
        </div>
    </div>
</section>


        </main>
        <!-- ------ -->



        <!-- MAIN -->
    </section>

    <!-- NAVBAR -->

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>