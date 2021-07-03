<?php
require_once "config.php";
session_start();

if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']))
{
    header('location:adminlogin.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `regestration` WHERE `id`= '$id'";
    $result = $link->query($sql);

    if($result)
    {
        ?>
        <script>
            alert('Record Deleted Sucessfully');
            open('regestrationDetails.php', '_self');
        </script>

    <?php
    }
    
    else
    {
        ?>
        <script>
            alert('Deleting List is failed !');
            open('regestrationDeatails.php', '_self');
            </script>

<?php
    }
}

else
{
    ?>
    <script>
        open('regestrationDeatails.php', '_self');
    </script>
    <?php
}
?>