<?php

include 'db.php';

$cnt = 0;
$fetch = mysqli_query($conn, "SELECT * FROM ultrasonic ORDER BY date");
$row = mysqli_num_rows($fetch);

while ($row = mysqli_fetch_array($fetch)) {
    if ($row['value1'] != "nan") {
        $cnt++;
        $dis[] = (float)$row['value1'];
        $date[] = $row['date'] . "(" . $row['time'] . ")";
    }
    if ($cnt == 10) {
        break;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/graph.css">
    <title>LINE CHART</title>
</head>

<body>
    <h1>LINE CHART</h1>
    <div class="chart">
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        const labels = "Temperature";
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            scaleFontColor: "white",
            type: 'line',
            data: {
                labels: <?php echo json_encode($date) ?>,
                datasets: [{
                    label: 'Distance(cm)',
                    data: <?php echo json_encode($dis) ?>,
                    fill: false,
                    borderColor: 'rgb(255,0,0)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: "white",
                        }
                    },
                    y: {
                        ticks: {
                            color: "white"
                        }
                    }

                }
            }
        });
    </script>
</body>

</html>