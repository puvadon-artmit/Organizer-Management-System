<!DOCTYPE html>
<html>

<head>
    <title></title>

    <script type="text/javascript" src="../../Javascript/chart/jquery.min.js"></script>
    <script type="text/javascript" src="../../Javascript/chart/Chart.min.js"></script>


</head>

<body>


    <script>
    $(document).ready(function() {
        showGraph();
    });

    function showGraph() {
        $.post("../Chart/data.php", function(data) {
            var name = [];
            var marks = [];

            for (var i in data) {
                name.push(data[i].event_name);
                marks.push(data[i].amount);
            }

            var chartdata = {
                labels: name,
                datasets: [{
                    label: 'จำนวนงานอีเว้นท์',
                    backgroundColor: '#99CCFF',
                    borderColor: '#3300CC',
                    hoverBackgroundColor: '#3399FF',
                    hoverBorderColor: '#3300CC',
                    data: marks
                }]
            };

            var graphTarget = $("#graphCanvas");
            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        });
    }
    </script>

    <script>
    $(document).ready(function() {
        showGraph1();
    });


    function showGraph1() {
        {
            $.post("../Chart/data2.php",
                function(data) {
                    console.log(data);
                    var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].dateMonth);
                        marks.push(data[i].sumTotal);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'ยอดขายต่อเดือน',
                            backgroundColor: '#99CCFF',
                            borderColor: '#CC33FF',
                            hoverBackgroundColor: '#CC33FF',
                            hoverBorderColor: '#CC33FF',
                            data: marks
                        }]
                    };

                    var graphTarget = $("#graphCanvas1");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
        }
    }
    </script>

</body>

</html>