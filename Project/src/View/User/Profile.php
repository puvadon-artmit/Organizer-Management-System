<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <title>Event Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    
</head>

<body>


    <?php
    include '../../Templates/Mainpage/Navbar2.php';
    ?>

         
<div class="flex justify-center items-center mt-4">
<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
   
    <div class="flex flex-col items-center pb-10">
        <img class="mt-4 w-24 h-24 mb-3 rounded-full shadow-lg" src="../../Image/<?php echo $profile_img; ?>" alt="Bonnie image"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $firstname . ' ' . $lastname; ?></h5>
        <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo $email; ?></span>
        <div class="flex mt-4 space-x-3 md:mt-6">
            <a href="./Edit_profile.php" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">แก้ไขโปรไฟล์</a>
           
        </div>
    </div>
</div>
    </div>



            
</body>

</html>