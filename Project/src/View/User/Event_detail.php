<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';

// ตรวจสอบว่ามีการส่งค่า event_id ผ่านพารามิเตอร์ id
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
} else {
    // หากไม่ได้รับค่า event_id ให้กลับไปหน้าที่ต้องการ
    header('Location: ../../View/Index.php');
    exit();
}

// ดึงข้อมูลรายละเอียดงานอีเว้นท์จากฐานข้อมูล


$sql = "SELECT event.event_id, event.event_name, event.image, event_detail.*, type_detail.type_dtname
FROM event
INNER JOIN event_detail ON event.event_id = event_detail.event_id
INNER JOIN type_detail ON type_detail.type_dtid = event_detail.type_dtid
WHERE event.event_id = :event_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id);
$stmt->execute();
$event_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style> -->
    <?php
    // Include necessary templates (Tabbar and Link) for the page
    // include '../../Templates/Mainpage/Tabbar.php';
    // include '../../Templates/Mainpage/Link.php';
    include '../../Templates/Mainpage/Navbar2.php';
    ?>






    <div class="flex justify-center items-center">
        <a href="#"
            class="mt-20 flex flex-col items-center justify-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 center">
            <img class="object-cover h-196 md:h-auto md:w-64 md:rounded-none md:rounded-l-lg"
                src="../../Image/<?php echo $event_details[0]['image']; ?>" alt="">
            <div class="flex flex-col justify-center items-center p-4 leading-normal center-content">
                <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <?php echo $event_details[0]['event_name'];?>.</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-lg">
                    <?php echo $event_details[0]['event_id']; ?></p>
            
            </div>
        </a>
    </div>





    <div class="flex flex-wrap justify-center">
        <?php foreach ($event_details as $event_detail): ?>
        <div
            class="w-full max-w-sm mx-2 my-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="javascript:void(0);" onclick="showImage('<?php echo $event_detail['detail_img']; ?>')">
                <img src="../../Image/<?php echo $event_detail['detail_img']; ?>"
                    class="p-5 rounded-t-lg object-cover h-64 w-full" alt="รูปภาพกิจกรรม">
            </a>
            <div class="px-5 pb-5">
                <a href="javascript:void(0);">
                    <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        <?php echo $event_detail['name_dt']; ?></h5>
                        <h5 class="text-1xl font-semibold tracking-tight text-green-500 mt-4 mb-4">
                             <?php echo $event_detail['type_dtname']; ?>
                            </h5>
                </a>
                    <h5 class="text-1xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        <?php echo $event_detail['detail']; ?></h5>
                </a>

               

                <div class="flex items-center justify-between mt-4">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo $event_detail['price']; ?>
                        บาท</span>
                        <a class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-8 py-3 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
   href="../User/Event_cart.php?id=<?php echo $event_detail['detail_id']; ?>" role="button">เพิ่มลงในตระกร้า</a>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- JavaScript code -->
    <script>
    function showImage(imageUrl) {
        var overlay = document.createElement("div");
        overlay.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
        overlay.style.position = "fixed";
        overlay.style.top = "0";
        overlay.style.left = "0";
        overlay.style.width = "100%";
        overlay.style.height = "100%";
        overlay.style.display = "flex";
        overlay.style.justifyContent = "center";
        overlay.style.alignItems = "center";
        overlay.style.zIndex = "9999";

        var image = document.createElement("img");
        image.src = "../../Image/" + imageUrl;
        image.style.maxHeight = "100%";
        image.style.maxWidth = "100%";

        overlay.appendChild(image);
        document.body.appendChild(overlay);

        overlay.addEventListener("click", function() {
            document.body.removeChild(overlay);
        });
    }
    </script>




</body>

</html>