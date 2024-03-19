<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
} else {
    header('Location: ../../View/Index.php');
    exit();
}

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql_order = "SELECT * FROM event_order WHERE orderID = :orderID";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bindParam(':orderID', $orderID);
    $stmt_order->execute();
    $orders = $stmt_order->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data from the event_receipt table for the specified orderID
    $sql_receipt = "SELECT * FROM event_receipt WHERE orderID = :orderID";
    $stmt_receipt = $conn->prepare($sql_receipt);
    $stmt_receipt->bindParam(':orderID', $orderID);
    $stmt_receipt->execute();
    $receipts = $stmt_receipt->fetchAll(PDO::FETCH_ASSOC);

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
    
    
    <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">รายการ <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">รายละเอียด การจ้างจ้างจัดงานอีเว้นท์</span></h1>
<p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400 mb-8">รายการ รายละเอียด การจ้างจ้างจัดงานอีเว้นท์ทั้งหมด.</p>
   
<?php
   
   $orderID = $_GET['orderID'];

   // ดึงข้อมูลสัญญาจากฐานข้อมูล
   $sql = "SELECT * FROM contracts WHERE orderID = :orderID";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':orderID', $orderID);
   $stmt->execute();
   $contract = $stmt->fetch(PDO::FETCH_ASSOC);
   ?>

   <!-- แสดงชื่อผู้ใช้งาน, รายละเอียดสัญญา หรืออื่น ๆ ตามที่คุณต้องการ -->

   <!-- แสดงไฟล์ PDF โดยใช้ <embed> หรือ <iframe> -->
   <div class="pdf-container">
       <embed src="<?php echo $contract['contract_path']; ?>" type="application/pdf" width="100%" height="600px">
       <!-- หรือ -->
       <!-- <iframe src="<?php echo $contract['contract_path']; ?>" width="100%" height="600px"></iframe> -->
   </div>
      
           
           
<div class="flex justify-center mt-8">
        <a href="./My_event.php" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">กลับ</a>
       
    </div>
</section>
<!-- Your existing code below... -->




</body>

</html>
