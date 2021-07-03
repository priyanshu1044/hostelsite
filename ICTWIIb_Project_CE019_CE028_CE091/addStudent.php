<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']))
{
    header('location:adminlogin.php');
}

if(isset($_GET['id']))
{
    $r_id = $_GET['id'];
    $sql = "SELECT * FROM `regestration` WHERE `id`= '$r_id'";
    $result = $link->query($sql);

    if($result)
    {
        $row = $result->fetch_assoc();
        $r_firstname = $row['firstname'];
        $r_middlename = $row['middlename'];
        $r_lastname = $row['lastname'];
        $r_gender = $row['gender']; 
        $r_course = $row['course']; 
        $r_email = $row['email']; 
        $r_contact_no = $row['contact_no']; 
        $r_address = $row['address'];
        $r_password = $row['password'];
        $r_image = $row['image'];

    }

    else
    {
        header("Location: regestrationDetails.php");
    }
}

else
{
    header("Location: regestrationDetails.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addstudent_style.css">
    <title>Document</title>

    <!-- <style>
    table, th, td{
        border: 1px solid black;
    }

    table{
        border-collapse: collapse;
    }
    </style> -->
</head>

<body>
    <div class="uu">
        <br>
        <h1>Add Students</h1>
        <br>
        <form action="addStudent.php?id=<?php echo $r_id; ?>" method="POST" autocomplete="off"
            enctype="multipart/form-data">


            <td rowspan="2"><label for="user_id">User Id :</label>
                <input type="number" id="user_id" name="user_id" placeholder="Enter User Id" required>
                <br><br>



                <?php
            $sql1 = "SELECT * FROM `users` WHERE 1";
            $result1 = $link->query($sql1);
            
            while($row = $result1->fetch_assoc())
            {
                echo $row['user_id'] .  " ";
            }
            
            echo  "User Id are not available."
            ?>

                <br><br>


                <label for="image">Image :</label>
                <img src="uplodedimage/<?php echo $r_image; ?>" width="140px" height="75px" ; alt="img">
                <br><br>


                <label for="firstname">First Name :</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $r_firstname; ?>" required>
                <br><br>


                <label for="middlename">Middle Name :</label>
                <input type="text" name="middlename" id="middlename" value="<?php echo $r_middlename; ?>" required>
                <br><br>


                <label for="lastname">Last Name :</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $r_lastname; ?>" required>
                <br><br>


                <label for="gender">Gender :</label>
                <input type="text" name="gender" id="gender" value="<?php echo $r_gender; ?>" required>
                <br><br>


                <label for="course">Course :</label>
                <input type="text" name="course" id="course" value="<?php echo $r_course; ?>" required>
                <br><br>


                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?php echo $r_email; ?>" required>
                <br><br>


                <label for="contact_no">Contact No. :</label>
                <input type="text" name="contact_no" id="contact_no" value="<?php echo $r_contact_no; ?>" required>
                <br><br>


                <label for="address">Address :</label>

                <textarea name="address" id="address" cols="22" rows="5" required>
                    <?php echo $r_address; ?>
                </textarea>

                <br><br>


                <label for="room_no">Room No. :</label>

                <select id="room_no" name="room_no" required>
                    <?php
                    $sql1 = "SELECT * FROM `rooms` WHERE 1";
                    $result1 = $link->query($sql1);
                    while($row = $result1->fetch_assoc())
                    {
                        if($row['current_living'] != $row['capacity'])
                        {
                            $flag = true;
                            ?>
                    <option value="<?php echo $row['room_no']?>">
                        <?php echo "Room No. " .  $row['room_no'] . "\t"."--->"."\t" . ($row['capacity']-$row['current_living']) . " available"; ?>
                    </option>
                    <?php
                        }
                    }
                    if(!$flag)
                    {
                        ?>
                    <option disabled>No room are avilable !</option>;
                    <?php          
                    }
                    ?>


                </select><br><br>


                <label for="addmission_date">Addmission Date :</label>
                <input type="date" name="addmission_date" id="addmission_date" placeholder="Enter Addmission Date"
                    required>
                <br><br>


                <label for="duration">Duration :</label>
                <input type="text" name="duration" id="duration" placeholder="Enter Duration in Month">
                <br><br>


                <label for="paid_fees">Paid Fess :</label>
                <input type="text" name="paid_fees" id="paid_fees" placeholder="Enter Paid Fees" required>
                <br><br>


                <label for="total_fees">Total Fees :</label>
                <input type="text" name="total_fees" id="total_fees" placeholder="Enter Total Fees" required>
                <br><br>



            <th colspan="2"><input class="btn btn-secondary" type="submit" name="confirm_addmission"
                    value="Confirm Addmission"></th>
            <br>

            <a class="btn btn-secondary" href="addStudent.php">Go Back</a>

        </form>
    </div>
</body>

</html>

<?php

$id = $r_id;
$password = $r_password;
$image = $r_image;
if(isset($_POST['confirm_addmission']))
{
    if(isset($_POST['user_id']) && isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['course']) && isset($_POST['email']) && isset($_POST['contact_no']) && isset($_POST['address']) && isset($password) && isset($_POST['room_no']) && isset($_POST['addmission_date']) && isset($_POST['duration']) && isset($_POST['paid_fees']) && isset($_POST['total_fees']) && isset($image))
    {   
        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];
        $room_no = $_POST['room_no'];
        $addmission_date = $_POST['addmission_date'];
        $duration = $_POST['duration'];
        $paid_fees = $_POST['paid_fees'];
        $total_fees = $_POST['total_fees'];
       
        $sql = "INSERT INTO `users`(`user_id`, `firstname`, `middlename`, `lastname`, `gender`, `course`, `email`, `contact_no`, `address`, `password`, `room_no`, `addmission_date`, `duration`, `paid_fees`, `total_fees`, `image`) VALUES ('$user_id','$firstname','$middlename','$lastname', '$gender','$course','$email','$contact_no','$address','$password','$room_no','$addmission_date','$duration','$paid_fees','$total_fees','$image')";
        $result = 1;
        $result = $link->query($sql);

        if($result)
        {
            $sql1 =  "DELETE FROM `regestration` WHERE `regestration`.`id` = '$id'";
            $result1 = $link->query($sql1);

            $sql2 = "SELECT * FROM `rooms` WHERE `room_no` = '$room_no'";
            $result2 = $link->query($sql2);
            $row2 = $result2->fetch_assoc();
            $current_living = $row2['current_living']+1;
            
            $sql2 = "UPDATE `rooms` SET `current_living`='$current_living' WHERE `room_no` = '$room_no'";
            $result2 = $link->query($sql2);

            if($result1 && $result2)
            {
                  ?>
<script>
    alert('Confirm Addmission sucessfully');
    window.open('usersDetails.php', '_self');
</script>
<?php
            }
        }
    }

    else
    {
        ?>
<script>
    alert("OOPs somthing went wrong !\nPlease Try again !");
</script>
<?php
    }
}
?>