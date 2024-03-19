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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</head>

<body>


    <?php
    include '../../Templates/Mainpage/Navbar2.php';
    ?>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">

               




                    <form action="../../Router/User/Question_DB.php" method="POST">
                        <div
                            class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" name="question" rows="4"
                                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="เขียนกระทู้สอบถาม..."autofocus autocomplete required></textarea>
                            </div>
                            <div class="flex items-center justify-center mt-4 px-3 py-2 border-t dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">โพสกระทู้</button>

                            </div>
                        </div>
                    </form>

    </section>

 <!-- Flex container to display questions in a single row -->
 <div class="flex flex-wrap -mx-4">
                    <?php if(isset($_SESSION['error2'])) { ?>
                    <div class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4">
                        <?php echo $_SESSION['error2']; unset($_SESSION['error2']); ?>
                    </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success2'])) { ?>
                    <div id="toast-simple"
                        class="flex items-center mb-4 w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
                        role="alert">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9" />
                        </svg>
                        <?php echo $_SESSION['success2']; unset($_SESSION['success2']); ?>
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

</body>

</html>