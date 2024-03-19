<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';

//ตรวจสอบว่ามีการส่งค่า event_id ผ่านพารามิเตอร์ id
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
} else {
    // หากไม่ได้รับค่า event_id ให้กลับไปหน้าที่ต้องการ
    header('Location: ../../View/Add_event.php');
    exit();
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



<section id="content">
        <!-- MAIN -->
        <main>
            

            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                    <div
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                        <form name="form1" method="post" action="../../../Router/Admin/Add_detail_db.php?event_id=<?php echo $event_id; ?>"
                        enctype="multipart/form-data"> <!-- เพิ่ม enctype="multipart/form-data" -->
                            
                            <div class="mb-6">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสงานอีเว้นท์</label>
                                <input type="text" name="event_id" value="<?php echo $event_id; ?>"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อรายละเอียด</label>
                                <input type="text" name="name_dt" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                            </div>

                            <div class="mb-6">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รายละเอียด</label>
                                <input type="text" name="detail" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                            </div>
                            <div class="mb-6">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวน</label>
                                <input type="number" name="dt_amount"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                            </div>

                            <div class="mb-6">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคา</label>
                                <input type="number" name="price" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                            </div>
                           
                            <label for="countries" class="block mb-4 mt-4 text-sm font-medium text-gray-900 dark:text-white">ประเภทรายละเอียดอีเว้นท์</label>
                    <select id="countries" name="type_dtid"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        <?php
                        $sql = "SELECT * FROM type_detail ORDER BY 	type_dtname";
                        $stmt = $conn->query($sql);
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                        <option value="<?php echo $row['type_dtid']; ?>"><?php echo $row['type_dtname']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                                
                            <label class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white"
                                for="file1">Upload file</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="image" type="file" autofocus autocomplete required>

                            <div class="flex items-center justify-center w-full mt-8">
                                <button type="submit"
                                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                                    อัพโหลด</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>