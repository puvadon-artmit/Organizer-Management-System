        <?php 

        include '../../Config/Database.php';
        include '../../Router/User/User_login.php';
       
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../Image/logo.png">
        
    

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>BTALL ORGANIZER</title>
</head>

<body>
        <?php 
        
        include '../../Templates/Mainpage/Tabbar.php';
        include '../../Templates/Mainpage/Picturescroll.php';
        include '../../Templates/Mainpage/Link.php';
        ?>
        <section class="section rent">
    <div class="title">
        <h1>จ้างจัดงานในฝันง่าย  </h1>
        <p>ค้นหางานในฝันของคุณ มากกว่า10งานและออกแบบได้ไม่จำกัด </p>
    </div>

    <div class="rent-center container">
        <?php
        try {
            

            $sql = "SELECT * FROM event ORDER BY event_id DESC";
            $stmt = $conn->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $event_name = $row['event_name'];
                $price = $row['deposit'];
                $image = $row['image'];

                echo "<div class='box'>";
                echo "<div class='top'>";
                echo "<div class='overlay'>";
                echo "<img src='../../Image/" . $row['image'] . "' class='card-img-top' alt='...'>";
                echo "</div>";
                echo "<div class='pos'>";
                echo "<span>ดูรีวิวจัดงาน</span>";
                echo "<span>จ้างจัดงาน</span>";
                echo "</div>";
                echo "</div>";
                echo "<div class='bottom'>";
                echo "<p>$event_name</p>";
                echo "<div>";
                echo "<span>$price</span>";
                echo "<span><a href='../../View/User/Event_detail.php?id=" . $row['event_id'] . "' class='text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2'>ดูรายละเอียด</a></span>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
                
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>
</section>

<?php include '../../Templates/Mainpage/experience.php'; ?>
<section class="section grid-layout">
        <div class="title">
            <h1>Event experience</h1>
        </div>

        <div class="wrapper container">
            <div class="box box1">
                <img src="../../Image/C1.jpg" alt="" />
            </div>
            <div class="box box2">
                <img src="../../Image/C2.jpg" alt="" />
            </div>
            <div class="box box3">
                <img src="../../Image/A1.jpg" alt="" />
            </div>
            <div class="box box4">
                <img src="../../Image/A4.jpg" alt="" />
            </div>
        </div>
    </section>
    <!-- Contact -->
    <section class="section2 contact left-auto">
        <div class="row">
            <div class="col">
                <h2>โพสต์กระทู้สอบถาม</h2>
                <p class="m">
                เราจะเห็นกระทู้คำถามของคุณคนเดียวเท่านั้นเพื่อความเป็นส่วนตัวของคุณ.
                </p>
                <br>
                <a href="เชื่อมโยงของคุณ" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">สอบถาม</a>

                
            </div>

        </div>
    </section>

    <?php include '../../Templates/Mainpage/eventprepared.php'; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="row">
            <div class="col d-flex">
                <h4>INFORMATION</h4>
                <a href="">เกี่ยวกับเรา</a>
               
                <a href="">ข้อกำหนด</a>
                <a href="">คู่มือการจ้างจัดงานอีเว้นท์</a>
            </div>
            <div class="col d-flex">
                <h4> Email Address & Call</h4>
                <a href="">Puvadon : 63011211038@msu.ac.th</a>
                <a href="">Jiranan : 63011211096@msu.ac.th</a>
                <a href="">Puvadon : 095-434-8017</a>
                <a href="">Jiranan : 088-039-5069</a>
            </div>
            <div class="col d-flex">
            
                <span><i class="bx bxl-facebook-square"></i></span>
                <span><i class="bx bxl-instagram-alt"></i></span>
                <span><i class="bx bxl-github"></i></span>
                <span><i class="bx bxl-twitter"></i></span>
                <span><i class="bx bxl-pinterest"></i></span>
            </div>
        </div>
    </footer>
</body>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="../../Javascript/Dashboard/scriptboard.js"></script>


</html>