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
    <link rel="stylesheet" href="../../CSS/replies.css">
    <title>My event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="path-to-fontawesome/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="../../CSS/rating.css">
    <!-- <script src="../../Javascript/rating.js"></script> -->

</head>

<body>


    <?php
    // include '../../Templates/Mainpage/Navbar2.php';
    ?>

   
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

                <form action="../../Router/User/Review_DB.php" method="POST">
    <input type="hidden" name="orderID" value="<?php echo $_GET['orderID']; ?>">
    <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        
       <!-- ---------ส่วนของการให้ดาว----------- -->
       <div class="rating-box">
    <header>ให้คะแนนการจัดงานกับทางเรา</header>
    <div class="stars">
        <i class="fa-solid fa-star" data-rating="1"></i>
        <i class="fa-solid fa-star" data-rating="2"></i>
        <i class="fa-solid fa-star" data-rating="3"></i>
        <i class="fa-solid fa-star" data-rating="4"></i>
        <i class="fa-solid fa-star" data-rating="5"></i>
    </div>
    <input type="hidden" name="rating" id="selected-rating">
</div>
  <script>
 const stars = document.querySelectorAll(".stars i");
stars.forEach((star, index1) => {
    star.addEventListener("click", () => {
        stars.forEach((star, index2) => {
            if (index1 >= index2) {
                star.classList.add("active");
            } else {
                star.classList.remove("active");
            }
        });

        // กำหนดคะแนนที่ผู้ใช้เลือกให้กับ input ซ่อน
        const selectedRating = index1 + 1; // เริ่มจาก 1 ไม่ใช่ 0
        document.getElementById("selected-rating").value = selectedRating;
    });
});
  </script>
    <!-- -------------------------------------- -->
    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
            <label for="comment" class="sr-only">รีวิวจัดงานอีเว้นท์</label>
            <textarea id="comment" name="comment" rows="4"
                class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                placeholder="เขียนรีวิวงานอีเว้นท์..." autofocus autocomplete required></textarea>
        </div>

        <div class="flex items-center justify-center mt-4 px-3 py-2 border-t dark:border-gray-600">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">รีวิว</button>
        </div>
    </div>
</form> 

 



</body>

</html>