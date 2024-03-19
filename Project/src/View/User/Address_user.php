<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

// Check if the orderID parameter exists in the URL and is not empty
if (isset($_GET['orderID']) && !empty($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
    try {
        // Fetch the data from the event_order table for the logged-in user and the specified orderID value
        $sql = "SELECT * FROM event_order WHERE user_id = :user_id AND orderID = :orderID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':orderID', $orderID);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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

    <form action="../../Router/User/Address_DB.php?orderID=<?php echo $orderID; ?>" id="form1" method="POST"
        enctype="multipart/form-data">

        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                    <?php
if (isset($_GET['success']) && $_GET['success'] === '1') {
    // Display the success alert message if the address was successfully added
    echo '<div id="alert-border-1" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">';
    echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
    echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
    echo '</svg>';
    echo '<div class="ml-3 text-sm font-medium">';
    echo 'เพิ่มที่อยู่สำเร็จ.';
    echo '</div>';
    echo '<button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-1" aria-label="Close">';
    echo '<span class="sr-only">Dismiss</span>';
    echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
}
?>
                    
                    <div class="mb-6">
        <label for="province"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จังหวัด</label>
        <input type="text" id="province" name="province"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
            autofocus autocomplete required>
    </div>

    <div class="mb-6">
        <label for="district"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อำเภอ</label>
        <input type="text" id="district" name="district"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            autofocus autocomplete required>
    </div>

    <div class="mb-6">
        <label for="subdistrict"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ตำบล</label>
        <input type="text" id="subdistrict" name="subdistrict"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            autofocus autocomplete required>
    </div>

    <label for="address_list"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ที่อยู่</label>
    <textarea id="address_list" name="address_list" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="บ้านเลขที่, หมู่บ้าน, หมู่" autofocus autocomplete required></textarea>

    <div class="flex justify-center">
        <button type="submit"
            class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            name="submit">เพิ่มที่อยู่</button>
            <a href="./My_event.php" type="button"
            class="mt-8 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            name="submit">กลับ</a>
    </div>
                </div>
            </div>
        </section>

    </form>
</body>

</html>