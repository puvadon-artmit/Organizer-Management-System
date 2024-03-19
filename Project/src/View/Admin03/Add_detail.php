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
    <title>Add Event Detail</title>
   
</head>
<body>
<?php include '../../Templates/Dashboard/Menu.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="alert alert-primary h4 text-center mb-6 mt-4" role="alert">
                    เพิ่มรายละเอียดงานอีเว้นท์
                </div>
                <form name="form1" method="post" action="../../Controller/Admin/Add_detail_db.php?event_id=<?php echo $event_id; ?>" enctype="multipart/form-data">
                <input type="text" name="event_id" class="form-control" readonly value="<?php echo $event_id; ?>"><br>
                    <label for="">ราคา</label>
                    <input type="number" name="price" class="form-control" placeholder="ราคา.." required><br>
                    <label for="">จำนวน</label>
                    <input type="number" name="dt_amount" class="form-control" placeholder="จำนวน.." required><br>
                    <label for="">รูปภาพ</label><br><br>
                    <input type="file" name="image" required><br><br>
                    <label for="">รายละเอียด</label><br>
                    <textarea name="detail" class="form-control" placeholder="รายละเอียด.." required></textarea><br>
                    <label for="">ชื่อรายละเอียด</label>
                    <input type="text" name="name_dt" class="form-control" placeholder="ชื่อรายละเอียด.." required><br>

                    <button type="submit" class="btn btn-pastel" style="background-color: #CCFFCC; border-color: #99FF00; ">Submit</button>
                    <a class="btn btn-danger" type="reset" href="show_event.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
