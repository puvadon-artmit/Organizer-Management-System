<?php
// products.php

include '../../Config/Database.php';
include '../../Router/User/User_login.php';

if (isset($_GET['type_id'])) {
    $type_id = $_GET['type_id'];

    try {
        $sql = "SELECT * FROM event WHERE type_id = :type_id ORDER BY event_id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->execute();

        // ...
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    
    <title>Event Details</title>
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
<?php
include "../../Templates/Mainpage/Navbar2.php";

$eventHtml = '';

try {
    if ($type_id !== null) {
        $sql = "SELECT * FROM event WHERE type_id = :type_id ORDER BY event_id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->execute();
    } else {
        $sql = "SELECT * FROM event ORDER BY event_id DESC";
        $stmt = $conn->query($sql);
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $event_name = $row['event_name'];
        $detail = $row['detail'];
        $image = $row['image']; 
        $event_id = $row['event_id'];

        $eventHtml .= '
        <div class="w-80 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ml-4 ">
            <a href="#">
                <img class="p-8 rounded-t-lg" src="../../Image/' . $image . '" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">' . $event_name . '</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">' . $detail . '.</p>
                <div class="flex items-center justify-between">   
                    <a href="./Event_detail.php?id=' . $event_id . '&type_id=' . $type_id . '" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">ดูรายละเอียด</a>
                </div>
            </div>
        </div>';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<div class="flex flex-wrap justify-center mt-8 space-x-4">
    <?php echo $eventHtml; ?>
</div>
  
</body>
</html>