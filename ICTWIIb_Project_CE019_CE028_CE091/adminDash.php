<?php
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
    <link rel="stylesheet" href="css/admin_dash_style.css">
    <title>Admin Dashboard</title>
    <!-- <style>
        table,
        th,
        td {
            border: 2px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style> -->

</head>

<body>
<div class="class1">
    <h1 class="large-heading">Admin Dashboard</h1>
    <br>

                <h2 class="md-heading">Welcome <ins style="color:red"><?php echo $_SESSION['adminname']; ?></ins></h2><br>
        

          
                <h2 class="md-heading">My Profile</h2>
            <a class="btn btn-secondary" href="adminChangePassword.php">Change Password</a><br>
   
    <br>
   

 
            <h3 class="md-heading">Student Details : </h3>
            <a class="btn btn-secondary" href="regestrationDetails.php">View Regestration Details</a><br>
    
            <td><a class="btn btn-secondary" href="usersDetails.php">Users Details</a><br></td>
   

    <br>
 
        
            <h3 class="md-heading">Others : </h3>
            <a class="btn btn-secondary" href="showLeaveRequest.php">Show Leave request</a>
      
            <a class="btn btn-secondary" href="roomDetails.php">Room Details</a>
     
 

    <br>
    <br>
    <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to logout ?')">Logout</a>
    </div>
</body>

</html>