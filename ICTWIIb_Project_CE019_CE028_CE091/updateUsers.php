<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']))
{
    header('location:adminlogin.php');
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE `id`= '$id'";
    $result = $link->query($sql);

    if($result)
    {
        $row = $result->fetch_assoc();
        $o_user_id = $row['user_id']; 
        $o_firstname = $row['firstname'];
        $o_middlename = $row['middlename'];
        $o_lastname = $row['lastname'];
        $o_gender = $row['gender']; 
        $o_course = $row['course']; 
        $o_email = $row['email']; 
        $o_contact_no = $row['contact_no']; 
        $o_address = $row['address'];
        $o_room_no = $row['room_no'];
        $o_duration = $row['duration'];
        $o_addmission_date = $row['addmission_date'];
        $o_paid_fees = $row['paid_fees'];
        $o_total_fees = $row['total_fees'];
        $o_image = $row['image'];
    }

    else
    {
        header("Location: addStudent.php");
    }
}

else
{
    header("Location: addStudent.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user Details</title>
    <link rel="stylesheet" href="css/updateuser_style.css">
</head>

<body>
    <div class="uu">
        <br>
        <h1>Update Users</h1>
        <br>
        <form action="updateUsers.php?id=<?php echo $id; ?>" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            
            
            <label for="user_id">User Id :</label>
            <input type="number" id="user_id" name="user_id" value="<?php echo $o_user_id; ?>" readonly required>
            <br><br>
            
            
            <label for="image">Image :</label>
            <input type="file" name="image" id="image">
            <br><br>
            
            
            <label for="firstname">First Name :</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $o_firstname; ?>" required>
            <br><br>
            
            
            <label for="middlename">Middle Name :</label>
            <input type="text" name="middlename" id="middlename" value="<?php echo $o_middlename; ?>" required>
            <br><br>

            
            <label for="lastname">Last Name :</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $o_lastname; ?>" required>
            <br><br>
            
            
            <label for="gender">Gender :</label>
            <input type="text" name="gender" id="gender" value="<?php echo $o_gender; ?>" required>
            <br><br>
            
            
            <label for="course">Course :</label>
            <input type="text" name="course" id="course" value="<?php echo $o_course; ?>" required>
            <br><br>
            
            
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" value="<?php echo $o_email; ?>" required>
            <br><br>
            
            
            <label for="contact_no">Contact No. :</label>
            <input type="text" name="contact_no" id="contact_no" value="<?php echo $o_contact_no; ?>" required>
            <br><br>
            
            
            <label for="address">Address :</label>
            
            <textarea name="address" id="address" cols="22" rows="5" required>
                <?php echo $o_address; ?>
            </textarea>
            
            <br><br>
            
            
            <label for="room_no">Room No. :</label>
            <input type="text" name="room_no" id="room_no" value="<?php echo $o_room_no; ?>" readonly required>
            <br><br>
            
            
            <label for="addmission_date">Addmission Date :</label>
            <input type="date" name="addmission_date" id="addmission_date" value=<?php echo $o_addmission_date?>
            required>
            <br><br>
            
            
            <label for="duration">Duration :</label>
            <input type="text" name="duration" id="duration" value="<?php echo $o_duration; ?>" required>
            <br><br>
            
            
            <label for="paid_fees">Paid Fess :</label>
            <input type="text" name="paid_fees" id="paid_fees" value="<?php echo $o_paid_fees;?>" required>
            <br><br>
            
            
            <label for="total_fees">Total Fees :</label>
            <input type="text" name="total_fees" id="total_fees" value="<?php echo $o_total_fees; ?>" required>
            <br><br>
            
            
            
            <th colspan="2"><input class="btn btn-secondary" type="submit" name="update" value="Update">
            <br><br>
            
            
            <a class="btn btn-secondary" href="usersDetails.php">Go Back</a>
        </form>
    </div>
</body>

</html>

<?php

$image = $o_image;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']))
{
    if(isset($_POST['user_id']) && isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['course']) && isset($_POST['email']) && isset($_POST['contact_no']) && isset($_POST['address']) &&isset($_POST["room_no"]) && isset($_POST["addmission_date"]) && isset($_POST["duration"]) && isset($_POST["paid_fees"]) && isset($_POST["total_fees"]))
    {
        if(isset($_POST['image']))
        {
            $image = $_POST['image'];
        }


        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];
        $room_no = $_POST["room_no"];
        $addmission_date = $_POST["addmission_date"];
        $duration = $_POST["duration"];
        $paid_fees = $_POST["paid_fees"];
        $total_fees = $_POST["total_fees"];
 
        $sql = "UPDATE `users` SET `user_id`='$user_id',`firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`gender`='$gender',`course`='$course',`email`='$email',`contact_no`='$contact_no',`address`='$address', `room_no`='$room_no',`addmission_date`='$addmission_date',`duration`='$duration',`paid_fees`='$paid_fees',`total_fees`='$total_fees',`image`='$image' WHERE `id`= '$id'";
        
        $result = $link->query($sql);

        var_dump($result);
        if($result)
        {
            ?>
<script>
    alert('Record Updated sucessfully');
    window.open('usersDetails.php', '_self');
</script>
<?php
        }
    }    
    
    else
    {
        ?>
<script>
    alert('Record was not updated sucessfully \nPlease try again');
    open("updateUsers.php?id=<?php echo $id ;?>");
</script>
<?php
    }
}
?>