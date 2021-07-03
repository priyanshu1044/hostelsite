<?php

require_once "config.php";
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['userid']))
{
    header("Location: usersDash.php");
}
$username = $password = $userid = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['userid']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login']))
    {
        if(!empty($_POST['userid']) && !empty($_POST['username']) && !empty($_POST['password']))
        {
            $userid = $_POST['userid'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "Select * from `users` WHERE user_id = '$userid' AND firstname='$username' AND password='$password'";
            $result = $link -> query($sql);
            $num =  $result->num_rows;
            
            if($num < 1)
            {
                ?>
                <script>
                alert('ID, Username Or Password do not Match !');
                </script>
                <?php
            }

            else
            {
                $row = $result->fetch_assoc();
                $_SESSION['userid'] = $row['user_id']; 
                $_SESSION['username'] = $row['firstname'];
                header("Location:usersDash.php");
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body>

<div class="index">
    <br>
    <h1 class="index_element">Student Login</h1>
    <form class="index_element" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        
        <label class="index_element md-heading" for="userid">User Id :</label>
        <input class="text_area" type="text" name="userid" id="userid" value="<?php echo $userid ?>" required><br><br>
        <label class="index_element md-heading" for="username">Username :</label>
        <input class="text_area" type="text" name="username" id="username" value="<?php echo $username ?>" required><br><br>
        <label class="index_element md-heading" for="password">Password :</label>
        <input class="text_area" type="password" name="password" id="password" value="<?php echo $password ?>" required><br><br>
        <input class="btn no_border" type="submit" name="login" value="Login"><br><br>
        <a class="btn-secondary btn" href="forgotPassword.php">Forget Password</a><br>
    </form>
    <div class="index_element">
        <a class="btn-secondary btn" href="regestration.php">Don't have account, register to our Hostel</a><br>
    </div>
    <div class="index_element">
        <a class="btn-secondary btn" href="adminlogin.php">Admin Login</a>
    </div>
    <div class="index_element">
        <a class="btn-secondary btn" href="index.html">HOME</a>
    </div>
</div>
   

</body>
</html>