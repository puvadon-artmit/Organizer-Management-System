<?php
include '../../Config/Database.php';
include '../../Router/Admin/admin_login.php';

$idpro = $_GET['id'];
$sql1 = "SELECT * FROM venue WHERE venue_id='$idpro'";
$result = $conn->query($sql1);
$rs = $result->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../Templates/Dashboard/Linkadmin.php' ?>
    <title>Add Event</title>

</head>

<body>
    <?php include '../../Templates/Dashboard/Menu.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="alert alert-primary h4 text-center mb-6 mt-4" role="alert">
                    แก้ไขงานอีเว้นท์
                </div>
                <form name="form1" method="post" action="../../Controller/Admin/Update_venue_db.php"
                    enctype="multipart/form-data">
                    <label for="venue_id">รหัสสถานที่จัดงาน</label>
                    <input type="text" name="venue_id" class="form-control" readonly
                        value="<?php echo $rs['venue_id']; ?>"><br>

                    <label for="update_time">วันเวลาอัปเดต</label>
                    <!-- <input type="text" name="update_time" class="form-control"
                        value="<?php echo $rs['update_time']; ?>"><br> -->

                        <textarea type="text" name="update_time" class="form-control" value="<?php echo $rs['update_time']; ?>" required></textarea><br>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn btn-danger" type="reset" href="show_venue.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>