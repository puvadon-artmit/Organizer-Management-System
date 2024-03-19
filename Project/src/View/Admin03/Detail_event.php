<?php
include '../../Config/Database.php';
include '../../Router/Admin/admin_login.php';

//ตรวจสอบว่ามีการส่งค่า event_id ผ่านพารามิเตอร์ id
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
} else {
    // หากไม่ได้รับค่า event_id ให้กลับไปหน้าที่ต้องการ
    header('Location: ../../View/Add_event.php');
    exit();
}

// ดึงข้อมูลรายละเอียดงานอีเว้นท์จากฐานข้อมูล
$sql = "SELECT event.event_id, event.event_name, event_detail.* FROM event
        INNER JOIN event_detail ON event.event_id = event_detail.event_id
        WHERE event.event_id = :event_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id);
$stmt->execute();
$event_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลสถานที่จัดงาน (venue)
$venue_sql = "SELECT * FROM venue WHERE event_id = :event_id";
$venue_stmt = $conn->prepare($venue_sql);
$venue_stmt->bindParam(':event_id', $event_id);
$venue_stmt->execute();
$venues = $venue_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../Templates/Dashboard/Linkadmin.php' ?>
    <title>Event Details</title>
</head>
<body>
    <?php include '../../Templates/Dashboard/Menu.php' ?>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-sm-10">
            <div class="alert  h4 text-center mb-6 mt-4" role="alert" style="background-color: #CCCCFF;">
                    รายละเอียดงานอีเว้นท์
                    <h5 class="mt-4">รหัสงานอีเว้นท์: <?php echo $event_details[0]['event_id']; ?></h5>
                    <h5>ชื่องานอีเว้นท์: <?php echo $event_details[0]['event_name']; ?></h5>
                </div>
                
                <?php foreach ($event_details as $event_detail): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $event_detail['name_dt']; ?></h5>
                            <p class="card-text"><?php echo $event_detail['detail']; ?></p>
                            <p class="card-text">ราคา: <?php echo $event_detail['price']; ?> บาท</p>
                            <p class="card-text">จำนวน: <?php echo $event_detail['dt_amount']; ?></p>
                            <img src="../../Image/<?php echo $event_detail['detail_img']; ?>" class="img-fluid" alt="Event Image">
                            
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($venues as $venue): ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo $venue['venue_id']; ?></h5>
            <p class="card-text"><?php echo $venue['venue_name']; ?></p>
           
            <img src="../../Image/<?php echo $venue['venue_img']; ?>" class="img-fluid" alt="Venue Image">
            <p class="card-text">ราคา: <?php echo $venue['venue_price']; ?> บาท</p>
            <p class="card-text">รายละเอียด: <?php echo $venue['venue_detail']; ?></p>
            <p class="card-text">ตารางเวลาสถานที่ : <?php echo $venue['update_time']; ?></p>
        
        </div>
        
    </div>
    
<?php endforeach; ?>

               

                <br>
                <a class="btn btn-pastel d-inline-flex justify-content-center" href="../Admin/Index.php" role="button" style="background-color: #FF3300; border-color: #FF0000;">กลับ</a>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
