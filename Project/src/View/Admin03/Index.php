<?php

include '../../Config/Database.php';
include '../../Router/Admin/admin_login.php';


include '../Chart/chart.php';


?>

<!DOCTYPE html>
<html >
    <head>
    <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Dashboard Admin</title>
        <link rel="icon" href="../../Image/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../CSS/dashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      
    <?php include '../../Templates/Dashboard/Menu.php' ?>
            
    <div id="layoutSidenav_content">
           
           <main>
               <div class="container-fluid px-4">
                   <!-- <h1 class="mt-4">Dashboard</h1>
                   <ol class="breadcrumb mb-4">
                       <li class="breadcrumb-item active">Dashboard</li>
                       
                   </ol> -->
                   <!-- <div class="row">
                       <div class="col-xl-3 col-md-6">
                           <div class="card bg-primary text-white mb-4">
                               <div class="card-body">รายการสั่งซื้อ(ทั้งหมด)<h4 class="text-center mt-4"></h4></div>
                               <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="report_order.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                               </div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-md-6">
                           <div class="card bg-warning text-white mb-4">
                               <div class="card-body">รายการสั่งซื้อ(ยังไม่ได้ชำระเงิน)<h4 class="text-center mt-4"></h4></div>
                               <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="unpaid_product.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                               </div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-md-6">
                           <div class="card bg-success text-white mb-4">
                               <div class="card-body">รายการสั่งซื้อ(ชำระเงินเงินแล้ว)<h4 class="text-center mt-4"></h4></div>
                               <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="sc_product.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                               </div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-md-6">
                           <div class="card bg-danger text-white mb-4">
                               <div class="card-body">รายการสั่งซื้อ(ที่ยกเลิก)<h4 class="text-center mt-4"></h4></div>
                               <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="cc_product.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                               </div>
                           </div>
                       </div>
                   </div> -->

                   <div class="row mt-4">
                       <div class="col-xl-6">
                           <div class="card mb-4">
                               <div class="card-header">
                                   <i class="fas fa-chart-area me-1"></i>
                                   Area Chart Example
                               </div>
                               <div class="card-body"><canvas id="graphCanvas" width="100%" height="40"></canvas></div>
                           </div>
                       </div>

                       <div class="col-xl-6">
                           <div class="card mb-4">
                               <div class="card-header">
                                   <i class="fas fa-chart-bar me-1"></i>
                                   Bar Chart Example
                               </div>
                               <div class="card-body"><canvas id="graphCanvas1" width="100%" height="40"></canvas></div>
                           </div>
                       </div>
                   </div>
                   
                   <div class="row">
                       <div class="col-xl-3 col-md-6">
                           <div class="card  text-black mb-4" style="background-color: #CCCCFF;">
                               <div class="card-body">เพิ่มงานอีเว้นท์<h4 class="text-center mt-4"></h4></div>
                               <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-black stretched-link" href="Add_event.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                               </div>
                           </div>
                       </div>
                   </div>  


                   <div class="card mb-4">
                       <div class="card-header">
                           <i class="fas fa-table me-1"></i>
                           DataTable Example
                       </div>
                       <div class="card-body">
                           <table id="datatablesSimple">
                               <thead>
                                   <tr>
                                       <th>รูปภาพ</th>
                                       <th>ไอดี</th>
                                       <th>ชื่ออีเว้นท์</th>
                                       <th>ประเภท</th>
                                       
                                      
                                       <th>แก้ไขอีเว้นท์</th>
                                       <th>เพิ่มรายละเอียดอีเว้นท์</th>
                                       <th>เพิ่มสถานที่จัดงาน</th>
                                       <th>อัพเดทตารางเวลาสถานที่</th>
                                       <th>ดูอีเว้นท์</th>
                                       
                                       
                                   </tr>
                               </thead>
                               
                               <tbody>
                               <?php

           $sql="SELECT * FROM event,type_event WHERE event.type_id = type_event.type_id ";
           $stmt = $conn->query($sql);
           while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           ?>
            <tr>
               <td><img src="../../Image/<?php echo $row['image']; ?>" width="150px" hieght="100px"></td>
               <td><?php echo $row['event_id']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo $row['type_name']; ?></td>
                <!-- <td><?php echo $row['detail']; ?></td> -->
               
                <!-- <td><?php echo $row['amount']; ?> ชิ้น</td> -->
                <!-- border-radius: 40%; -->
                 <td> <a class="btn btn-pastel" href="Edit_event.php?id=<?php echo $row['event_id']; ?>" role="button" style="background-color: #FFFF99; border-color: #FFCC00;">แก้ไขอีเว้นท์</a></td>
                 <td> <a class="btn btn-pastel" href="Add_detail.php?id=<?php echo $row['event_id']; ?>" role="button" style="background-color: #CCFFCC; border-color: #99FF00; ">เพิ่มรายละเอียด</a></td>
                 <td> <a class="btn btn-pastel" href="Add_venue.php?id=<?php echo $row['event_id']; ?>" role="button" style="background-color: #CC99FF; border-color: #CC00FF; ">เพิ่มสถานที่</a></td>
                 <td> <a class="btn btn-pastel" href="Work_schedule.php?id=<?php echo $row['event_id']; ?>" role="button" style="background-color: #FFFF99; border-color: #FFCC00;">ตารางสถานที่</a></td>
                 <td> <a class="btn btn-pastel" href="Detail_event.php?id=<?php echo $row['event_id']; ?>" role="button" style="background-color: #66CCFF; border-color: #3300FF; ">ดูรายละเอียด</a></td>                                                                                                                                             
                </tr>
               <?php 
                   }

                   ?>         
                      </tbody>
                    </table>
                  </div>
                </div>
           </div>
       </main>

        <?php include '../../Templates/Dashboard/Footer.php' ?>
         

       </div>
   </div>
        
        
 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="../../Javascript/scripts.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../Javascript/assets/demo/chart-area-demo.js"></script>

        
        
        <script src="../../Javascript/assets/demo/chart-bar-demo.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        
        
        <script src="../../Javascript/datatables-simple-demo.js"></script>
    </body>
</html>
