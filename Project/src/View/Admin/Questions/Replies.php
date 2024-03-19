<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $question = $_GET['question_id'];
    // เรียกข้อมูลคำถามทั้งหมดจากตาราง questions และเข้าร่วมกับตาราง users โดยใช้ INNER JOIN
    $sql = "SELECT questions.*, users.firstname, users.lastname, users.email, users.profile_img
            FROM questions
            INNER JOIN users ON questions.user_id = users.id WHERE question_id=:question_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':question_id', $question);
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
    <link rel="icon" href="../../../Image/logo.png">
    <title>Admin</title>
</head>

<body>

    <?php
   include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4  max-w-screen-xl lg:py-16 ml-auto">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

            <!-- Flex container to display questions in a single row -->
            <div class="flex flex-wrap -mx-4">
                <!-- Loop to display each question -->
                <?php foreach ($questions as $question): ?>
    <div class="w-full md:w-1/2 px-4 mb-8">
        <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700">
        <figcaption class="flex items-center justify-center space-x-3 mt-4">
                    <img class="rounded-full w-9 h-9" src="../../../Image/<?php echo $question['profile_img']; ?>" alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div><?php echo $question['firstname'] . ' ' . $question['lastname']; ?></div>
                        <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $question['email']; ?></div>
                    </div>
                </figcaption>    
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo $question['question']; ?></h3>
                    <p class="my-4 text-xs"><?php echo $question['created_at']; ?></p>
                    <p class="my-4 text-xs">สถานะ : <?php echo $question['status']; ?></p>
                    <!-- <a href="./Replies.php?question_id=<?php echo $question['question_id']; ?>" class="text-blue-500 text-xl">ตอบ</a> -->
                </blockquote>
                
            </figure>

            <form action="../../../Router/Admin/Replies_DB.php" method="POST" class="mt-4">
        <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="reply" class="sr-only">Your reply</label>
                <textarea id="reply" name="reply" rows="2" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="เขียนคำตอบ..." autofocus autocomplete required></textarea>
            </div>
            <div class="flex items-center justify-end px-3 py-2 border-t dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">โพสตอบ</button>
            </div>
        </div>
    </form>
        </div>
    </div>
<?php endforeach; ?>
                <!-- End loop -->
            </div>
        </div>
    </div>
</section>

    
    
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>