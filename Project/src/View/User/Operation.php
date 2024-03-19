

<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';


// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql = "SELECT * FROM event_order WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Now you have the orders for the logged-in user, you can loop through and display the data
    foreach ($orders as $order) {
        // Display the order details here as needed
        // You can access the data like $order['orderID'], $order['fl_name'], $order['address'], etc.
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
        <div class="table-responsive">
        <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ลำดับที่</th>
                    <th scope="col" class="px-6 py-3">ชื่องานอีเว้นท์</th>
                    <th scope="col" class="px-6 py-3">สถานะ</th>
                    <th scope="col" class="px-6 py-3"></th>
                   
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orders as $order) {
                    ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4"><?php echo $order['orderID']; ?></td>
                        <td class="px-6 py-4"><?php echo $order['name_event']; ?></td>
                        
                        <td class="px-6 py-4">
                            <?php
                            if ($order['order_status'] == 1) {
                                echo 'ยังไม่ชำระเงิน';
                            } elseif ($order['order_status'] == 2) {
                                echo 'กำลังดำเนินงาน';
                            } elseif ($order['order_status'] == 3) {
                                echo 'ยกเลิก';
                            } else {
                                echo 'สถานะไม่ถูกต้อง';
                            }
                            ?>
                        </td>
                       
                        
                        <td class="px-6 py-4">
                            <a href="../User/View_operation.php?orderID=<?php echo $order['orderID']; ?>" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                ดูขั้นตอนการดำเนินงาน
                            </a>
                        </td>
                        
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>


        </div>
    </div>
</section>


</body>

</html>
