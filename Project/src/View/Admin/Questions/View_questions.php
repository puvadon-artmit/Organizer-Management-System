<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // เรียกข้อมูลคำถามทั้งหมดจากตาราง questions และเข้าร่วมกับตาราง users โดยใช้ INNER JOIN
    // และกรองข้อมูลเฉพาะคำถามที่มีสถานะเป็น "pending"
    $sql = "SELECT questions.*, users.firstname, users.lastname, users.email, users.profile_img
            FROM questions
            INNER JOIN users ON questions.user_id = users.id
            WHERE questions.status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

            <!-- Flex container to display questions in a single row -->
            <div class="flex flex-wrap -mx-4">
            <?php if(isset($_SESSION['error3'])) { ?>
    <div class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['error3']; unset($_SESSION['error3']); ?>
    </div>
<?php } ?>
<?php if(isset($_SESSION['success3'])) { ?>
    <div id="toast-simple" class="flex items-center mb-4 w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
  <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
  </svg>
  <?php echo $_SESSION['success3']; unset($_SESSION['success3']); ?>
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
                <!-- Loop to display each question -->
                <?php foreach ($questions as $question): ?>
    <div class="w-full md:w-1/2 px-4 mb-8 ">
        <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700">
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo $question['question']; ?></h3>
                    <p class="my-4"><?php echo $question['created_at']; ?></p>
                    <a href="./Replies.php?question_id=<?php echo $question['question_id']; ?>" class="text-blue-500 text-xl">ตอบ</a>
                </blockquote>
                <figcaption class="flex items-center justify-center space-x-3 ">
                    <img class="rounded-full w-9 h-9 " src="../../../Image/<?php echo $question['profile_img']; ?>" alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div><?php echo $question['firstname'] . ' ' . $question['lastname']; ?></div>
                        <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $question['email']; ?></div>
                    </div>
                </figcaption>    
            </figure>
        </div>
    </div>
<?php endforeach; ?>
                <!-- End loop -->
            </div>
        </div>
    </div>
</section>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>