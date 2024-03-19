<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $organizer_id = $_GET['organizer_id'];
    
    // เรียกข้อมูลคำถามทั้งหมดจากตาราง questions และเข้าร่วมกับตาราง users โดยใช้ INNER JOIN 
    $sql = "SELECT o.organizer_id, o.firstname, o.lastname, o.oz_email, o.profile_ogz, o.uroles, o.created_at, o.profile_ogz, o.talent, t.type_organizer 
            FROM organizer AS o 
            LEFT JOIN type_organizer AS t ON o.type_ogzid = t.type_ogzid 
            WHERE o.organizer_id = :organizer_id 
            ORDER BY o.created_at DESC";

        $stmt_organizer = $conn->prepare($sql);
        $stmt_organizer->bindParam(':organizer_id', $organizer_id);
        $stmt_organizer->execute();
        $organizer = $stmt_organizer->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $_SESSION['error'] = "เกิดข้อผิดพลาดในการดึงข้อมูลคำถาม";
    header("location: ../../View/User/Question.php");
    exit;
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

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 mr-8">
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

                <!-- Flex container to display questions in a single row -->
                <div class="flex flex-wrap -mx-4 ">
                    <!-- Loop to display each question -->
                    <?php if (!empty($organizer)): // Check if $organizer is not empty ?>
                    <?php foreach ($organizer as $row): ?>
                    <div class="w-full md:w-1/2 px-4 mb-8">
                        <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700">
                            <figcaption class="flex items-center justify-center space-x-3 mt-4">
                                <img class="rounded-full w-9 h-9"
                                    src="../../../Image/<?php echo $row['profile_ogz']; ?>" alt="profile picture">
                                <div class="space-y-0.5 font-medium dark:text-white text-left">
                                    <div><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo $row['oz_email']; ?></div>
                                </div>
                            </figcaption>
                            <figure
                                class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">ประเภทผู้จัดงาน:
                                        <?php echo $row['type_organizer']; ?></h3>
                                    <h3 class="text-xl mt-4 font-semibold text-gray-600 dark:text-white">
                                        ความสามารถการทำงาน : <?php echo $row['talent']; ?></h3>

                                </blockquote>

                            </figure>

                            <form
                                action="../../../Router/Organizer/Employment_DB.php?organizer_id=<?php echo $organizer_id; ?>"
                                method="POST" class="mt-4">
                                <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">
                                <div
                                    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">

                                    <div class="px-4 py-2 mt-4 bg-white rounded-t-lg dark:bg-gray-800">
                                        <div class="mb-6">
                                            <label for="orderID"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อีเว้นท์ที่จ้างงาน</label>
                                            <input type="text" id="orderID" name="orderID"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>

                                        <div class="mb-6">
                                            <label for="job_price"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ค่าตอบแทน</label>
                                            <input type="text" id="job_price" name="job_price"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>

                                        <div class="mb-6">
                                            <label for="event_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">วัน-เวลา
                                                จัดงานอีเว้นท์</label>
                                            <input type="text" id="event_date" name="event_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>

                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รายละเอียดงาน</label>
                                        <textarea id="message" name="job_dt" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="รายละเอียดหน้าที่ในงานอีเว้นท์"></textarea>
                                    </div>
                                    <div
                                        class="flex items-center justify-center px-3 py-2 border-t dark:border-gray-600">
                                        <button type="submit" name="employment"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">จ้างจัดงาน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- End loop -->
                </div>
            </div>
        </div>
    </section>

    








    <!-- <?php if (!empty($organizer)): // Check if $organizer is not empty ?>
    <?php foreach ($organizer as $row): ?>
        <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2">
            มอบหมายงาน <?php echo $row['organizer_id']; ?>
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            ชื่อ: <?php echo $row['firstname']; ?><br>
            นามสกุล: <?php echo $row['lastname']; ?><br>
            อีเมล: <?php echo $row['oz_email']; ?><br>
            ประเภทผู้จัดงาน: <?php echo $row['type_organizer']; ?><br>
            สร้างเมื่อ: <?php echo $row['created_at']; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?> -->


    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>