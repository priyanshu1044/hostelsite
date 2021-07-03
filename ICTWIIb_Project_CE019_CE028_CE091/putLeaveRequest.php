<?php

require_once "config.php";
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']))
{
    header("Location: login.php");
}
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

$sql = "SELECT * FROM `users` WHERE `firstname`='$username' AND `user_id`='$userid'";
$result = $link->query($sql);
$nums = $result->num_rows;
$row = $result->fetch_assoc();
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$subject = $note = $fromdate = $todate ="";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['putleaverequest']))
{
    if(isset($_POST['subject']) && isset($_POST['note']) && isset($_POST['fromdate']) && isset($_POST['todate']))
    {
        echo "Hii";
        $subject = $_POST['subject'];
        $note = $_POST['note'];
        $fromdate = $_POST['fromdate'];
        $name = $firstname." " .$lastname;
        $todate = $_POST['todate'];
        $flag = true;

        if($todate < $fromdate)
        {
            $flag = false;
            ?>
            <script>
                alert("Please select valid Dates !!"); 
            </script>
            <?php
        }

        if($flag)
        {
            $sql1 = "INSERT INTO `leave_request`(`user_id`, `username`, `email`, `subject`, `note`, `fromdate`, `todate`) VALUES ('$userid','$name','$email','$subject',
            '$note','$fromdate','$todate')";

            $result1 = $link->query($sql1);
            if($result)
            {
                ?>
                <script>
                alert("Leave request added sucessfully");
                open("usersDash.php", "_self");
                </script>
                <?php
            }
        }

        else
        {
            ?>
            <script>
            alert("Leave request not added sucessfully");
            open("usersDash.php", "_self");
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
    <link rel="stylesheet" href="css/putleavereq_style.css">
    <title>Leave Request</title>
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
    <div class="plr">
        <h1>Leave Request</h1><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        <table class="table">
            <tr>
            <td><label for="subject">Subject : </label></td>
            <td><input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" required></td>
            </tr>
            
            <tr>
            <td><label for="note">Note : </label></td>
            <td>
            <textarea name="note" id="note" cols="40" rows="8" required>
            <?php echo $note; ?>
            </textarea>
            </td>
            </tr>
    
            <tr>
            <td><label for="fromdate">From</label></td>
            <td><input type="date" name="fromdate" id="fromdate" value="<?php echo $fromdate; ?>" required></td>
            </tr>
    
            <tr>
            <td><label for="todate">To</label></td>
            <td><input type="date" name="todate" id="todate" value="<?php echo $todate; ?>" required></td>
            </tr>
    
            <tr>
            <th colspan="2"><input class="btn btn-secondary" type="submit" name="putleaverequest" value="Put Leave Request"></th>
            </tr>
    
            </table><br><br>
        </form>
        <a class="btn btn-secondary" href="usersDash.php">Back to Dash</a>
        <br>
        <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a>
    </div>
</body>
</html>