
<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/Admin_login.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="../../../Image/logo.png">
    <link rel="stylesheet" href="../../../CSS/dashboard.css">
    <link rel="stylesheet" href="../../CSS/dashboard.css">
</head>
<body>
<?php
   include '../../../Templates/Dashboard/Linkboard.php'; 
 ?>

<?php
   include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile.php';
   ?>

<h8><?php echo $firstname . ' ' . $lastname; ?></h8>
<div class="flex justify-center items-center mt-4">
<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 items-center justify-center">
    <div class="flex justify-end px-4 pt-4">
        
      
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="../../../Image/<?php echo $profile_img; ?>" alt="Bonnie image"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $firstname . ' ' . $lastname; ?></h5>
        <span class="text-xl text-gray-500 dark:text-gray-800">แอดมิน</span>
        <span class="text-sm text-gray-500 dark:text-gray-600 mt-2"><?php echo $email; ?></span>
        <div class="flex mt-4 space-x-3 md:mt-6">
            <a href="./Admin_edit_profile.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">แก้ไขข้อมูลส่วนตัว</a>
            
        </div>
    </div>
</div>
</div>





<script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>