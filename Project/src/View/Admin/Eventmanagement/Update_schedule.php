<?php
include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';


$detail_id = $_GET['detail_id'];

// Insert Event Data
if (isset($_POST["purport"], $_POST["start"], $_POST["end"]) && !empty($_POST["purport"])) {
    $query = "
    INSERT INTO venue_schedule 
    (purport, start_event, end_event, detail_id) 
    VALUES (:purport, :start_event, :end_event, :detail_id)
    ";
    $statement = $conn->prepare($query);
    $start_event = $_POST['start'] . " " . $_POST['start_time']; // Assuming you have a separate input for start time
    $end_event = $_POST['end'] . " " . $_POST['end_time']; // Assuming you have a separate input for end time
    if ($statement->execute(
        array(
            ':purport' => $_POST['purport'],
            ':start_event' => $start_event,
            ':end_event' => $end_event,
            ':detail_id' => $detail_id
        )
    )) {
        echo "Data added successfully.";
    } else {
        echo "Error adding data: " . print_r($statement->errorInfo(), true);
    }
}
$data = array();
// Fetch Event Data
$query = "SELECT * FROM venue_schedule WHERE detail_id = :detail_id ORDER BY start_event";
$statement = $conn->prepare($query);
$statement->bindParam(':detail_id', $detail_id, PDO::PARAM_STR); // Assuming detail_id is a string
$statement->execute();
$result = $statement->fetchAll();


$data = array();
foreach ($result as $row) {
    $data[] = array(
        'id' => $row["Venue_id"],
        'title' => $row["purport"],
        'start' => $row["start_event"],
        'end' => $row["end_event"]
    );
}
echo json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../CSS/dashboard.css">
    <link rel="icon" href="../../../Image/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>

<body>
    <?php
    // include '../../../Templates/Dashboard/Sidebar.php';
    include '../../../Templates/Dashboard/Navbarprofile2.php';
    ?>
    <section id="content">
        <main>
            <!-- แสดงเนื้อหาหน้าเว็บไซต์ -->
            <h1>Event Details</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="container">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <script>
        $(document).ready(function () {
            var detail_id = <?php echo json_encode($detail_id); ?>;
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: {
                    url: './Update_schedule.php',
                    type: 'POST',
                    data: { detail_id: detail_id }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var purport = prompt("Enter Event purport");
                    if (purport) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: "./Update_schedule.php?detail_id=<?php echo $detail_id; ?>", 
                            type: "POST",
                            data: { purport: purport, start: start, end: end, detail_id: detail_id }, 
                            success: function () {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        });
                    }
                },
            });
        });
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
    <script src="../../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>
