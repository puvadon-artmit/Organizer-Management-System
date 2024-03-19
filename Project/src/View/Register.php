<?php 

session_start();
include '../Config/Database.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTLL ORGANIZER</title>
  <link href="../../dist/output.css" rel="stylesheet">
  <link rel="icon" href="../Image/logo.png">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css"> -->
</head>
<body>
  <section class="flex flex-col md:flex-row h-screen items-center">

    <div class="bg-blue-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
      <img src="../image/bg-all-login.png" alt="" class="w-full h-full object-cover">
    </div>
  
    <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto  md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">
  
      <div class="w-full h-100">
  
       
        <h1 class="text-xl text-center md:text-4xl font-bold leading-tight mt-12">Register</h1>
  
        <form action="../Component/Members/Register_db.php" class="mt-6" enctype="multipart/form-data" method="post">
        <?php if(isset($_SESSION['error'])) { ?>
    <div class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php } ?>
<?php if(isset($_SESSION['success'])) { ?>
    <div class="bg-green-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php } ?>
<?php if(isset($_SESSION['warning'])) { ?>
    <div class="bg-yellow-500 text-white px-4 py-2 rounded-lg mb-4">
        <?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?>
    </div>
<?php } ?>

        <div>
            <label for="firstname" class="block text-gray-700">First name</label>
            <input  type="text" name="firstname" id="" aria-describedby="firstname" placeholder="Enter First Name" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>

          <div>
            <label for="lastname" class="block text-gray-700">Last name</label>
            <input type="text" name="lastname" id="" aria-describedby="lastname" placeholder="Enter Last Name" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>

          
          <div>
            <label for="email" class="block text-gray-700">Email Address</label>
            <input type="email" name="email" id="" aria-describedby="email" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>
  
          <div class="mt-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required>
          </div>

          <div class="mt-4">
            <label for="confirm password" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="c_password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required>
          </div>
  
          <div class="mt-4">
            <label for="profile_img" class="block text-gray-700">Profile Image</label>
            <input type="file" name="profile_img" id="profile_img" class="w-full bg-gray-200 border border-gray-300 py-2 px-4 rounded-lg focus:outline-none focus:border-blue-500">
          </div>
  
          <button type="submit" name="signup" class="w-full mt-5 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Register</button>
        </form>
  
        <hr class="my-6 border-gray-300 w-full">
  
       
  
        <p class="mt-4">
        if you already have an account 
          <a href="./Login.php" class="text-blue-500 hover:text-blue-700 font-semibold">
            Login
          </a>
        </p>
  
       
      </div>

    </div>
  
  </section>
  

</body>
</html>
