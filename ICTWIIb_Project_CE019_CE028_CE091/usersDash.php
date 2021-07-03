<?php

require_once "config.php";
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']))
{
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userdash_style.css">
    <title>User Dashboard</title>
</head>

<body>
    <div class=ud>
        <br>
        <h1><b>User Dashboard</b></h1>
        <br>
        
        <h1>Welcome <ins style="color:red">
            <?php echo $_SESSION['username'] ;?>
        </ins></h1><br>
        <h2>My Profile</h2>
        <a class="btn btn-secondary" href="userProfile.php">View Profile</a><br>
        <a class="btn btn-secondary" href="userChangePassword.php">Change Password</a><br><br>
        
        <h3>Other :</h3>
        <a class="btn btn-secondary" href="putLeaveRequest.php">Leave Reaquest</a><br>
        
        
        <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to logout ?')">Logout</a><br><br>


    </div>

</body>

</html>