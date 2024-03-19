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
    <link rel="stylesheet" href="../../../CSS/toast-success.css">
    <link rel="stylesheet" href="../../../CSS/dashboard.css">
    <link rel="icon" href="../../../Image/logo.png">
    <title>Admin</title>
</head>

<body>

    <?php
//    include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>




    <section id="content">
 
                <div class="flex flex-wrap -mx-4">
                    <?php if(isset($_SESSION['error12'])) { ?>
                    <div class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4" id="toast-success">
                        <?php echo $_SESSION['error12']; unset($_SESSION['error12']); ?>
                    </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success12'])) { ?>
                   

                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal"><?php echo $_SESSION['success12']; unset($_SESSION['success12']); ?></div>
  
</div>

                    <script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-success');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 5000); // 3000 milliseconds = 3 seconds
                    </script>



                    <?php } ?>

        <div class="flex justify-center mt-8">
    <form action="../../../Router/Admin/Add_performance.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <input type="text" name="event_name" placeholder="ชื่องาน" required>
    <button type="submit">อัพโหลด</button>
</form>


    

</div> 
        
<?php
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $select_query = "SELECT picture_work, name_event, pfm_id  FROM performance";
    $stmt = $conn->prepare($select_query);
    $stmt->execute();
    $performances = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div class="grid grid-cols-4 gap-2 ml-4 mr-4 mt-4">
    <?php foreach ($performances as $performance) : ?>
        <figure class="max-w-lg relative">
            <img class="h-auto max-w-full rounded-lg" src="data:image/jpeg;base64,<?= base64_encode($performance['picture_work']) ?>" alt="image description">
            <figcaption class="absolute top-0 right-0 mt-2 mr-2">
                <a href="./Performance_edit.php?id=<?= $performance['pfm_id'] ?>"  class="text-blue-500 dark:text-blue-400 hover:underline">แก้ไข</a>
            </figcaption>
            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400"><?= $performance['name_event'] ?></figcaption>
        </figure>
    <?php endforeach; ?>
</div>
    </section>

    <!-- -------------------------------------- -->
   

  

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>