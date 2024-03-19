<?php

include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


// include '../Chart/chart.php';



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
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 ml-96 mr-2">
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                <h1 class="text-xl text-center md:text-4xl font-bold leading-tight mt-12">เพิ่มผู้รับจัดงาน</h1>
                <form action="../../../Router/Organizer/Add_organizer.php" class="mt-6" enctype="multipart/form-data"
                    method="post">
          <!-- PHP code (unchanged) -->
<?php if(isset($_SESSION['error3'])) { ?>
    <div id="errorAlert" class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['error3']; unset($_SESSION['error3']); ?>
    </div>
<?php } ?>

<?php if(isset($_SESSION['success3'])) { ?>
    <div id="toast-simple" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-300 dark:bg-gray-800 dark:text-green-700">
        <?php echo $_SESSION['success3']; unset($_SESSION['success3']); ?>
    </div>
<?php } ?>

<?php if(isset($_SESSION['warning3'])) { ?>
    <div id="warningAlert" class="bg-yellow-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['warning3']; unset($_SESSION['warning3']); ?>
    </div>
<?php } ?>

                <script>
                    // Function to hide the toast message after 3 seconds
                    setTimeout(function() {
                        var toast = document.getElementById('toast-simple');
                        if (toast) {
                            toast.style.display = 'none';
                        }
                    }, 4000); // 3000 milliseconds = 3 seconds
                    </script>



                    <div>
                        <label for="firstname" class="block text-gray-700">First name</label>
                        <input type="text" name="firstname" id="" aria-describedby="firstname"
                            placeholder="Enter First Name"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                    <div>
                        <label for="lastname" class="block text-gray-700">Last name</label>
                        <input type="text" name="lastname" id="" aria-describedby="lastname"
                            placeholder="Enter Last Name"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                   

                    <label for="countries" class="block mb-4 mt-4 text-sm font-medium text-gray-900 dark:text-white">ประเภทผู้รับจัดงาน</label>
                    <select id="countries" name="type_ogzid"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php
                        $sql = "SELECT * FROM type_organizer ORDER BY type_organizer";
                        $stmt = $conn->query($sql);
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                        <option value="<?php echo $row['type_ogzid']; ?>"><?php echo $row['type_organizer']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div>
                        <label for="talent" class="block text-gray-700 mt-4">talent</label>
                        <input type="text" name="talent" id="" aria-describedby="lastname"
                            placeholder="ความสามารถผู้รับจัดงาน ตัวอย่าง ทำอารไทย,ทำอาหารฝรั่งเศส"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700">Email Address</label>
                        <input type="email" name="oz_email" id="email" aria-describedby="email"
                            placeholder="Enter Email Address"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" name="oz_password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required autofocus autocomplete required>
                    </div>

                    <div class="mt-4">
                        <label for="confirm password" class="block text-gray-700">Confirm Password</label>
                        <input type="password" name="c_password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required autofocus autocomplete required>
                    </div>

                    <div class="mt-4 mb-4">
                        <label for="profile_ogz" class="block text-gray-700">Profile Image</label>
                        <input type="file" name="profile_ogz" id="profile_ogz"
                            class="w-full bg-gray-200 border border-gray-300 py-2 px-4 rounded-lg focus:outline-none focus:border-blue-500" autofocus autocomplete required>
                    </div>

                    <button type="submit" name="addorganizer"
                        class="w-full mt-5 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">เพิ่มผู้รับจัดงาน</button>
                </form>

                <hr class="my-6 border-gray-300 w-full">
            </div>

    </section>


                        
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>