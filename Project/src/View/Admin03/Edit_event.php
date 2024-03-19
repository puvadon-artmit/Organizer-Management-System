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
                <form name="form1" method="post" action="../../Controller/Admin/Edit_event_db.php" enctype="multipart/form-data">
                    <label for="">รหัสงานอีเว้นท์</label>
                    <input type="text" name="event_id" class="form-control" readonly value="<?php echo $rs['event_id']; ?>"><br>

                    <label for="">ชื่องานอีเว้นท์</label>
                    <input type="text" name="event_name" class="form-control" value="<?php echo $rs['event_name']; ?>"><br>

                    <label for="">รหัสประเภทงานอีเว้นท์</label>
                    <input type="text" name="type_id" class="form-control" value="<?php echo $rs['type_id']; ?>"><br>


                    <label for="">จำนวน</label>
                    <input type="number" name="amount" class="form-control" value="<?php echo $rs['amount']; ?>"><br>

                    <label for="">รูป</label>
                    <br><br>
                    <img src="../../Image/<?php echo $rs['image']; ?>" width="120px"><br><br>
                    <input type="file" name="file1"><br>
                    <br>
                    <input type="hidden" name="textimg" class="form-control" value="<?php echo $rs['image']; ?>"><br>
                   
                    <label for="">รายละเอียด</label>
                    <textarea name="detail" class="form-control"><?php echo $rs['detail']; ?></textarea><br>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn btn-danger" type="reset" href="show_event.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>