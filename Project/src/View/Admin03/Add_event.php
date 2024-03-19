<?php
include '../../Config/Database.php';
include '../../Router/Admin/admin_login.php';

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
                    เพิ่มงานอีเว้นท์
                </div>
                <form name="form1" method="post" action="../../Controller/Admin/Add_event_db.php" enctype="multipart/form-data">
                    <label for="">ชื่องานอีเว้นท์</label>
                    <input type="text" name="event_name" class="form-control" placeholder="ชื่องานอีเว้นท์.." required><br>
                    <label for="">ประเภทงานอีเว้นท์</label>
                    <select class="form-select" name="type_id" required>
                        <?php
                        $sql = "SELECT * FROM type_event ORDER BY type_name";
                        $stmt = $conn->query($sql);
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                    <label for="">เงินมัดจำ</label>
                    <input type="number" name="deposit" class="form-control" placeholder="เงินมัดจำ.." required><br>
                    <label for="">จำนวน</label>
                    <input type="number" name="amount" class="form-control" placeholder="จำนวน.." required><br>
                    <label for="">รูปภาพ</label><br><br>
                    <input type="file" name="image" required><br><br>

                    <label for="">รายละเอียด</label><br>
                    <textarea name="detail" class="form-control" placeholder="รายละเอียด.." required></textarea><br>

                    <button type="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-danger" type="reset" href="show_event.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
