<?php

session_start();
require_once "config.php";

if(isset($_SESSION['adminname']))
{
    header("Location: adminDash.php");
}
$password = $adminname = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['adminname']) && isset($_POST['password']) && isset($_POST['login']))
    {
        if(!empty($_POST['adminname']) && !empty($_POST['password']))
        {
            $adminname = $link -> real_escape_string($_POST['adminname']);
            $password = $link -> real_escape_string($_POST['password']);
            $sql = "Select * from admin where adminname='$adminname' and password='$password'";
            $result = $link -> query($sql);
            $num =  $result->num_rows;

            if($num < 1)
            {
                ?>
                <script>
                alert('Username Or Password do not Match !');
                </script>
                <?php
            }

            else
            {
                $row = $result->fetch_assoc();
                $_SESSION['adminid'] = $row['id']; 
                $_SESSION['adminname'] = $row['adminname'];
                header("Location:adminDash.php");
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin_login.css">
</head>
<body>
    <div class="admin md-heading">
        <h1>Admin Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        <label for="adminname">Admin Name :</label>
        <input class="text_area" type="text" name="adminname" id="adminname" value="<?php echo $adminname; ?>" required><br><br>
        <label for="password">Password :</label>
        <input class="text_area" type="password" name="password" id="password" value="<?php echo $password; ?>" required><br><br>
        <input class="btn btn-secondary" type="submit" value="Login" name="login">
        </form>
    </div>

</body>
</html>