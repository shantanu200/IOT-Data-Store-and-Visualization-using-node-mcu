<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Sensor data</title>
</head>

<body>
    <div class="heading">
        <h1>ULTRASONIC SENSOR</h1>
        <button class="btn btn-success" onclick="search_dis()"><i class="fas fa-search"></i> SEARCH</button>
        <button class="btn btn-warning" onclick="graph_ultra()"><i class="fas fa-chart-line"></i> GRAPH</button>
    </div>

    <div class="tab">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <td>DATE</td>
                    <td>TIME</td>
                    <td>SENSOR</td>
                    <td>LOCATION</td>
                    <td>DISTANCE(cm)</td>
                    <td>DISTANCE(inch)</td>
                </tr>
            </thead>

            <?php
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "nodemcu";


            $conn = new mysqli($host, $user, $password, $dbname);

            if ($conn->connect_error) {
                die("Error " . $conn->connect_error);
            }

            $sql = "SELECT id, sensor, location, value1, value2,date,time FROM ultrasonic ORDER BY id DESC";
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tbody>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><?php echo $row['sensor']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['value1']; ?></td>
                        <td><?php echo $row['value2']; ?></td>
                    </tbody>
            <?php
                }
                $result->free();
            }
            $conn->close();
            ?>
        </table>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>