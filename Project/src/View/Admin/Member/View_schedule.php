<?php
include '../../../Config/Database.php';
include '../../../Router/Admin/admin_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"
        integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../../../CSS/dashboard.css">
    <link rel="icon" href="../../../Image/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <title>Admin</title>
</head>

<body>

    <?php
   include '../../../Templates/Dashboard/Sidebar.php';
   include '../../../Templates/Dashboard/Navbarprofile2.php';
   ?>

<section id="content">
        <main>
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
                        <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2">
                            ผู้รับจัดงานในระบบ</h1>
                        <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-6"></p>

                        <div class="container">
                            <div id="calendar"></div>
                        </div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                var organizer_id = <?php echo $_GET['organizer_id']; ?>;
                                var calendar = $('#calendar').fullCalendar({
                                    editable: true,
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    events: './Load.php?organizer_id=' + organizer_id,
                                    selectable: true,
                                    selectHelper: true,
                                    select: function(start, end, allDay) {
                                        var title = prompt("Enter Event Title");
                                        if (title) {
                                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                                            $.ajax({
                                                url: "./Insert_sc.php",
                                                type: "POST",
                                                data: {
                                                    title: title,
                                                    start: start,
                                                    end: end
                                                },
                                                success: function() {
                                                    calendar.fullCalendar('refetchEvents');
                                                    alert("Added Successfully");
                                                }
                                            });
                                        }
                                    },
                                    editable: true,
                                    eventResize: function(event) {
                                        // โค้ดการปรับปรุงเหตุการณ์ที่ถูกย่อ/ขยาย
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </section>
        </main>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../Javascript/Dashboard/scriptboard.js"></script>
</body>

</html>