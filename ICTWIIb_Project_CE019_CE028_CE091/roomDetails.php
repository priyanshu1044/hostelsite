<?php

require_once "config.php";
session_start();
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('location:adminlogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addstudent_style.css">
    <title>Document</title>
    <style>
    table,
        th,
        td {
            border: 2px solid black;
        }

        td,
        th {
            width: 180px;
        }
        
        table {
            border-collapse: collapse;
        }
        </style>
</head>
<body>
    <div class="rd">
        <br>
        <h1>Room Details</h1>
        <table>
            <tr>
        <th>Sr. no</th>
        <th>Room no</th>
        <th>Capacity</th>
        <th>Current living</th>
        <th>Fees</th>
    </tr>
    
    <?php
    
    $sql = "SELECT * FROM `rooms` WHERE 1";
    $result = $link->query($sql);
    $nums = $result->num_rows;
    $count = 1;
    
    if($nums > 1)
    {
        while($row = $result->fetch_assoc())
        {
            ?>
            <tr>
                <td><?php echo $count++ ?></td>
                <td><?php echo $row['room_no'] ;?></td>
                <td><?php echo $row['capacity'] ;?></td>
                <td><?php echo $row['current_living'] ;?></td>
                <td><?php echo $row['room_fees']." Rs.";?></td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
    <a class="btn btn-secondary" href="adminDash.php">Back to Admin Dash</a><br>
    <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a><br>
    <a class="btn btn-secondary" href="addRoom.php">Add Room</a>
    <br><br>
</div>
</body>
</html>