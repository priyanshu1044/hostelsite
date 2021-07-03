<?php
require_once "config.php";
session_start();

if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']))
{
    header('location:adminlogin.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql1 = "SELECT * FROM `users` WHERE `id`= '$id'";
    $result1 = $link->query($sql1);
    $row1 = $result1->fetch_assoc();
    $room_no = $row1['room_no'];
    echo $room_no;
    
    $sql2 = "SELECT * FROM `rooms` WHERE `room_no` = '$room_no'";
    $result2 = $link->query($sql2);
    $row2 = $result2->fetch_assoc();
    $current_living = $row2['current_living'] - 1; 
    echo $current_living;

    $sql = "DELETE FROM `users` WHERE `id`= '$id'";
    $result = $link->query($sql);

    if($result)
    {
        $sql3 = "UPDATE `rooms` SET `current_living`='$current_living'  WHERE `room_no` = '$room_no'";
        $result3 = $link->query($sql3);

        if($result3)
        ?>
        <script>
            alert('Record Deleted Sucessfully');
            open('usersDetails.php', '_self');
        </script>

    <?php
    }
    
    else
    {
        ?>
        <script>
            alert('Deleting List is failed !');
            open('usersDeatails.php', '_self');
            </script>

<?php
    }
}

else
{
    ?>
    <script>
        open('userDeatails.php', '_self');
    </script>
    <?php
}
?>