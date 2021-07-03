<?php

require_once "config.php";
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']))
{
    header("Location: login.php");
}

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$new_password = "";
$confirm_password = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changepassword']))
{
    if(isset($_POST['username']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword']))
    {
        $new_password = $_POST['newpassword'];
        $confirm_password = $_POST['confirmpassword'];
        if($new_password == $confirm_password)
        {
            $sql = "UPDATE `users` SET `password`='$new_password' WHERE `firstname`='$username'
            AND `user_id`='$userid'";
            $result = $link->query($sql);
            if($result)
            {
                ?>
                <script>
                alert("Password Updated Sucessfully");
                open("usersDash.php", "_self");
                </script>
                <?php   
            }
        }

        else
        {
            ?>
            <script>
                alert("Password do not Match !\nPlease try again");
            </script>
            <?php
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userchangepass_style.css">
    <title>Change Password</title>
</head>
<body>
    <div class="userchange">
        <br>
        <h1>Change Password</h1>
        <br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
            <label for="username"> User Name :</label> 
            <input class="input" type="text" name="username" id="username" value="<?php echo $username; ?>" required readonly><br><br>
            <label for="newpassword">New Password :</label>
            <input class="input" type="password" name="newpassword" id="newpassword" value="<?php echo $new_password; ?>" value="<?php echo $confirm_password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br><br> 
            <label for="confirmpassword">Confirm Password :</label>
            <input class="input" type="password" name="confirmpassword" id="confirmpassword"
            value="<?php echo $confirm_password; ?>" value="<?php echo $confirm_password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br><br> 
            <input class="btn btn-secondary" type="submit" name="changepassword" value="Change Password">
            <p class="text-red"><b>Note: Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</b></p>
        </form>
        <a class="btn btn-secondary" href="usersDash.php">Back to Dash</a>
        <br>
        <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a>
    </div>
        
            

</body>
</html>
