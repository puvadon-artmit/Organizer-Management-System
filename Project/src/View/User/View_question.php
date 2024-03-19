

<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get the user ID of the currently logged-in user
    $user_id = $_SESSION['user_id'];

    // Fetch only the questions that belong to the currently logged-in user
    $sql = "SELECT q.*, r.reply, r.reply_time
    FROM questions q
    INNER JOIN replies r ON q.question_id = r.question_id
    WHERE q.user_id = :user_id ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <title>My event</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</head>

<body>


    <?php
    include '../../Templates/Mainpage/Navbar2.php';
    ?>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

            <!-- Flex container to display questions in a single row -->
            <div class="flex flex-wrap -mx-4">
                <!-- Loop to display each question -->
                <?php foreach ($questions as $question): ?>
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700">
                        <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">คำถาม : <?php echo $question['question']; ?></h3>
                                <p class="my-4 text-xs font-semibold text-gray-400 dark:text-white"><?php echo $question['created_at']; ?></p>
                                <div class="reply-container">
  <h3 class="text-lg font-semibold text-gray-950 dark:text-white">ตอบกลับ : 
  <span class="text-lg font-semibold text-blue-500 dark:text-white"><?php echo $question['reply'] ?? 'No reply'; ?></span><br>
<span class="text-xs font-semibold text-gray-400 dark:text-white"><?php echo $question['reply_time'] ?></span>
  </h3>
</div>
                                
                            </blockquote>
                            <figcaption class="flex items-center justify-center space-x-3">
                                <img class="rounded-full w-9 h-9" src="../../Image/<?php echo $profile_img; ?>" alt="profile picture">
                                <div class="space-y-0.5 font-medium dark:text-white text-left">
                                    <div><?php echo $firstname . ' ' . $lastname; ?></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $email; ?></div>
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





</body>

</html>
