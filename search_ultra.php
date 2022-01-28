<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Search value</title>
</head>

<body>
  <div class="form">
    <form method="POST">
      <input type="text" name="dis" placeholder="Enter Distance" required>
      <button class="btn btn-success" type="submit" name="search"><i class="fas fa-search"></i> Search</button>
    </form>
  </div>

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
    $username = "root";
    $password = "";
    $dbname = "nodemcu";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("ERROR: " . $conn->connect_error);
    }

    $found = false;

    $ret = mysqli_query($conn, "SELECT * FROM ultrasonic");
    $row = mysqli_num_rows($ret);
    if (isset($_POST['search'])) {
      $dis = $_POST['dis'];
      while ($row = mysqli_fetch_array($ret)) {
        if ($dis == $row['value1']) {
          $found = true;
    ?>
          <tbody>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['date']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td><?php echo $row['sensor']; ?></td>
              <td><?php echo $row['location']; ?></td>
              <td><?php echo $row['value1']; ?></td>
              <td><?php echo $row['value2']; ?></td>

            <?php
          }
        }
        if (!$found) { ?>
            <th style="text-align:center; color:red;" colspan="7">No Record Found</th>
        <?php }
      }
        ?>
            </tr>
          </tbody>
  </table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>