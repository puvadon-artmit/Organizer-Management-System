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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../Templates/Dashboard/Linkadmin.php' ?>
    <title>Add Venue</title>
   
</head>
<body>
<?php include '../../Templates/Dashboard/Menu.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="alert alert-primary h4 text-center mb-6 mt-4" role="alert">
                    เพิ่มสถานที่จัดงานอีเว้นท์
                </div>
                <form name="form1" method="post" action="../../Controller/Admin/Add_venue_db.php?event_id=<?php echo $event_id; ?>" enctype="multipart/form-data">
                <input type="text" name="event_id" class="form-control" readonly value="<?php echo $event_id; ?>"><br>
                    <label for="">ชื่อสถานที่</label>
                    <input type="text" name="venue_name" class="form-control" placeholder="ชื่อ..." required><br>
                    <label for="">รายละเอียด</label>
                    <textarea type="text" name="venue_detail" class="form-control" placeholder="ชื่อรายละเอียด..." required></textarea><br>
                    <label for="">รูปภาพ</label><br><br>
                    <input type="file" name="image" required><br><br>
                    <label  for="">ราคาสถานที่</label><br>
                    <input type="number" name="venue_price" class="form-control" placeholder="ราคา" required><br>
                    

                    <button type="submit" class="btn btn-pastel" style="background-color: #CCFFCC; border-color: #99FF00; ">Submit</button>
                     <a class="btn btn-pastel" href="Update_venue.php?id=<?php echo $row['venue_id']; ?>" role="button" style="background-color: #FFFF99; border-color: #FFCC00;">อัพเดท</a>
                    <a class="btn btn-danger" type="reset" href="show_event.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
