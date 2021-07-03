<?php
require_once "config.php";
session_start();
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('location:adminlogin.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_room']))
{
    if(isset($_POST['room_no']) && isset($_POST['capacity']) && isset($_POST['room_fees']))
    {
        $room_no = $_POST['room_no'];
        $capacity = $_POST['capacity'];
        $current_living = 0;
        $room_fees = $_POST['room_fees'];
        
        $sql = "INSERT INTO `rooms`(`room_no`, `capacity`, `current_living`, `room_fees`) VALUES ('$room_no','$capacity','$current_living','$room_fees')";
        $result = $link->query($sql);

        if($result)
        {
            ?>
            <script>
            alert("Room added sucessfully");
            open("roomDetails.php", "_self");
            </script>
            <?php
        }

        else
        {
            ?>
            <script>
            alert("Room was not added sucessfully !\nPlease try again");
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
    <link rel="stylesheet" href="css/addstudent_style.css">
    <title>Add Rooms</title>
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
    <div class="ar">
        <h1>Add Room</h1>
            
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        
            
            <label>Room No. : </label> 
            <input class="input" type="text" name="room_no" id="room_no" required> <br><br>
            
            
            
            <label for="capacity">Capacity : </label> 
            <input class="input" type="text" name="capacity" id="capacity" required> <br><br>
            
            
            
            <label for="room_fees">Room Fees : </label> 
            <input class="input" type="text" name="room_fees" id="room_fees" required> <br><br>
            
            
            
            <input class="btn btn-secondary input_button" type="submit" name="add_room" value="Add Room"><br><br>
            
            <a class="btn btn-secondary" href="adminDash.php">Back to Admin Dash</a><br><br>
            <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout
            </a><br><br>
        
        </form>
    </div>

</body>
</html>