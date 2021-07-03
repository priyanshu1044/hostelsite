<?php

require_once "config.php";

$user_id = $firstname = $email = "";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['getmail']))
{
    if(isset($_POST['user_id']) && isset($_POST['firstname']) && isset($_POST['email']))
    {
        $user_id=$_POST['user_id'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $flag = true;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $flag = false;
            ?>
            <script>
                alert('Invalid email format !');
            </script>
            <?php
        }

        if($flag)
        {
            $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id' AND `firstname`='$firstname' AND `email`= '$email'";
            $result = $link->query($sql);
            $num = $result->num_rows;
            $row = $result->fetch_assoc();

            if($num > 0)
            {
                $to = $email;
                $password = $row['password'];
                $lastname = $row['lastname'];
                $txt = "Hii $firstname $lastname, your password is : ' $password '. Please login and change your password if you do not remember it.";
                $headers = "From: parasbhardava26@gmail\r\n";
                $subject = "Forgot Password";
                $msg=mail($to,$subject,$txt,$headers);

                if($msg)
                {
                    ?>
                    <script>
                        alert("Mail was sent.");
                        open("login.php", "_self");
                    </script>
                    <?php
                }

                else
                {
                    ?>
                    <script>
                        alert("Mail was not sent.");
                    </script>
                    <?php
                }
            }

            else
            {
                ?>
                <script>
                    alert("User Id, Firstname or Email do not found !");
                </script>
                <?php
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
    <link rel="stylesheet" href="css/forgetpass_style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="fp">
        <br>
        <h1>Forgot Password</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
            <label for="user_id">User Id : </label>
            <input class="input" type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>" required><br><br>
            <label for="firstname">Firstname : </label>
            <input class="input" type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required><br><br>
            <label for="email">Email : </label>
            <input class="input" type="text" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
            <input class="btn btn-secondary" type="submit" name="getmail" value="Get Mail"><br><br>
            </form>
    </div>
</body>
</html>