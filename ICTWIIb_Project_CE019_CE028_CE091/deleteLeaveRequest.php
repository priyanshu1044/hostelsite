<?php
require_once "config.php";
session_start();

if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']))
{
    header('location:adminlogin.php');
}

if (isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM `leave_request` WHERE `id` = '$id'";
    $result = $link->query($sql);

    if($result)
    {
        ?>
        <script>
            alert('Leave Request Deleted Sucessfully');
            open("showLeaveRequest.php", "_self");
        </script>
        <?php
    }

    else
    {
        ?>
        <script>
            alert('Deleting Leave request is failed !');
            </script>
        <?php
    }

}

else
{
    ?>
    <script>
        open('showLeaveRequest.php', '_self');
    </script>
    <?php
}



?>