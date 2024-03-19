<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


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
    <link rel="stylesheet" href="../../../CSS/replies.css">
    <link rel="icon" href="../../../Image/logo.png">
    <title>Admin</title>
</head>

<body>

    <?php
   include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>

<section class="bg-white dark:bg-gray-900 ">
    <div class="py-8 px-4  max-w-screen-xl lg:py-16 ml-auto">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

        <?php 
    
    try {
        $sql = "SELECT r.comment, r.rating, u.firstname, u.lastname, u.profile_img, eo.name_event
                FROM reviews AS r
                INNER JOIN users AS u ON r.user_id = u.id
                INNER JOIN event_order AS eo ON r.orderID = eo.orderID ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
   <section class="bg-white dark:bg-gray-900">
    <?php
    $rowCount = 0;
    foreach ($reviews as $review) :
        if ($rowCount === 0) {
            echo '<div class="grid md:grid-cols-2 gap-8 ml-4 mt-4">';
        }
    ?>
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
            <figure class="max-w-screen-md">
                <p class="mb-4 text-base text-gray-500 dark:text-gray-300">Event: <?php echo $review['name_event']; ?></p>
                <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white"><?php echo $review['comment']; ?></p>
                <div class="flex items-center mb-4 text-yellow-300">
                    <?php
                    $rating = intval($review['rating']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>';
                        }
                    }
                    ?>
                </div>
                <blockquote>
                    <!-- เพิ่มรายละเอียดอื่น ๆ ตามที่คุณต้องการ -->
                </blockquote>
                <figcaption class="flex items-center mt-6 space-x-3">
                    <img class="w-10 h-10 rounded-full" src="../../../Image/<?php echo $review['profile_img']; ?>">
                    <div class="flex items-center divide-x-2 divide-gray-300 dark:divide-gray-700">
                        <cite class="pr-3 font-medium text-gray-900 dark:text-white"><?php echo $review['firstname'] . ' ' . $review['lastname']; ?></cite>
                    </div>
                </figcaption>
            </figure>
        </div>
    <?php
        $rowCount++;
        if ($rowCount === 2) {
            echo '</div>';
            $rowCount = 0;
        }
    endforeach;

    // กรณีที่มีรีวิวเหลือที่ยังไม่ได้ปิดแถว
    if ($rowCount !== 0) {
        echo '</div>';
    }
    ?>
   
</section>
<div class="flex justify-center mt-8">
<a  href="../Index.php" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
</div>
        </div>
    </div>
</section>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>