<?php

require_once "config.php";
session_start();
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('location:adminlogin.php');

}

$adminname = $_SESSION['adminname'];
$id = $_SESSION['adminid'];
$new_password = $confirm_password = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changepassword']))
{
    if(isset($_POST['adminname']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword']))
    {
        $new_password = $_POST['newpassword'];
        $confirm_password = $_POST['confirmpassword'];

        if($new_password == $confirm_password)
        {
            $sql = "UPDATE `admin` SET `password`='$new_password' WHERE `id` = '$id' AND `adminname` = '$adminname'";
            $result = $link->query($sql);
            if($result)
            {
                ?>
                <script>
                    alert("Updating Password Sucessfully .");
                    open('adminDash.php', '_self');
                </script>
                <?php
            }
        }

        else
        {
            ?>
            <script>
                alert("Password do not Match !\nPlease try again !");
            </script>
            <?php
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
    <title>Change Password</title>
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body>
    <div class="acp">
    <br>
    <h1 class="large-heading">Change Password</h1>
    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        <tr>
            <td><label class="md-heading" for="adminname"> Admin Name :</label></td>
            <td><input style="font-size:x-large" class="text_area" type="text" name="adminname" id="adminname" value="<?php echo $adminname; ?>" required readonly></td>
        </tr><br><br>
        
        <tr>
            <td><label class="md-heading" for="newpassword">New Password :</label></td>
            <td><input class="text_area" type="password" name="newpassword" id="newpassword" value="<?php echo $new_password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></td>
        </tr><br><br>
        
        <tr>
            <td><label class="md-heading" for="confirmpassword">Confirm Password :</label></td>
            <td><input class="text_area" type="password" name="confirmpassword" id="confirmpassword"
            value="<?php echo $confirm_password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></td>
        </tr><br><br>
        
        <tr>
            <th colspan="2"><input class="btn btn-secondary" type="submit" name="changepassword" value="Change Password"></th>
        </tr>
        <p class="text-red md-heading" style="colour:red">Note: Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
    </form>
    <a class="btn btn-secondary" href="adminDash.php">Back to Admin Dash</a>
    <br>
    <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a>
</div>
</body>
</html>