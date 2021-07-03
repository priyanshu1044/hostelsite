<?php

require_once "config.php";
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']))
{
    header("Location: login.php");
}

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
 
$sql = "Select * from users where user_id = '$userid' and firstname='$username'";
$result = $link->query($sql);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userdash_style.css">
    <title>Document</title>
    <style>
        table, th, td {
            border: 2px solid black;
        }

        table{
            border-collapse:collapse;
        }
    </style>
</head>
<body>
    <div class="up">
        <br>
        <h1><?php echo $username; ?>'s Profile</h1>
        <br>
        
        <table class="table">
            <tr>
                <td>User Id :</td>
                <td><?php echo $row['user_id']; ?></td>
            </tr>
            
            <tr>
                <td>Image :</td>
                <td><img src="uplodedimage/<?php echo $row['image'];?>" width="220px" height="180px" alt="User Image"></td>
            </tr>
            
            <tr>
                <td>First Name :</td>
                <td><?php echo $row['firstname']; ?></td>
            </tr>
            
            <tr>
                <td>Middle Nmae :</td>
                <td><?php echo $row['middlename']; ?></td>
            </tr>
            
            <tr>
                <td>Last Name :</td>
                <td><?php echo $row['lastname']; ?></td>
            </tr>
            
            <tr>
                <td>Gender :</td>
                <td><?php echo $row['gender']; ?></td>
            </tr>
            
            <tr>
                <td>Cource :</td>
                <td><?php echo $row['course']; ?></td>
            </tr>
            
            <tr>
                <td>Email :</td>
                <td><?php echo $row['email'];; ?></td>
            </tr>
            
            <tr>
                <td>Contact No. :</td>
                <td><?php echo $row['contact_no']; ?></td>
            </tr>
            
            <tr>
                <td>Address</td>
                <td><?php echo $row['address']; ?></td>
            </tr>
            
            <tr>
                <td>Room No. :</td>
                <td><?php echo $row['room_no']; ?></td>
            </tr>
            
            <tr>
                <td>Addmission Date :</td>
                <td><?php echo date('d-m-Y', strtotime($row['addmission_date'])); ?></td>
            </tr>
            
            <tr>
                <td>Duration :</td>
                <td><?php echo $row['duration']; ?></td>
            </tr>
            
            <tr>
                <td>Paid Fees :</td>
                <td><?php echo $row['paid_fees']; ?></td>
            </tr>
            
            <tr>
                <td>Total Fees :</td>
                <td><?php echo $row['total_fees']; ?></td>
            </tr>
        </table>
        <br>
            <a class="btn btn-secondary" href="usersDash.php">Go Back to User Dash</a>
            <br>
            <a class="btn btn-secondary" href="logout.php">Logout</a><br><br>
        </div>
    </body>
</html>