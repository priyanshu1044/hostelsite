
<?php

require_once "config.php";
$firstname = $middlename = $lastname = $usergender = $usercourse = $useremail = $usercontact = $useraddress = $userusercontact = $userpassword = $userconfirmpassword = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_FILES['userimage']['name'];
    $size = $_FILES['userimage']['size'];
    $type = $_FILES['userimage']['type'];
    $temp = $_FILES['userimage']['tmp_name'];

    if(isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) 
    && isset($_POST['usergender']) && isset($_POST['usercourse']) && isset($_POST['useremail']) 
    && isset($_POST['usercontact']) && isset($_POST['useraddress']) && isset($_POST['userpassword']) && isset($_POST['userconfirm']) && isset($name))
    {
        $firstname = $_POST['firstname'];
        $middlename =  $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $usergender = $_POST['usergender'];
        $usercourse = $_POST['usercourse'];
        $useremail = $_POST['useremail'];
        $usercontact = $_POST['usercontact'];
        $useraddress = $_POST['useraddress'];
        $userusercontact = $_POST['useraddress'];
        $userpassword = $_POST['userpassword'];
        $userconfirmpassword = $_POST['userconfirm'];
        $flag = true;

        if($userpassword != $userconfirmpassword)
        {
            $flag = false;
            ?>
            <script>
                alert('Password Do Not match !');
            </script>
            <?php
        }

        else if(!filter_var($useremail, FILTER_VALIDATE_EMAIL))
        {
            $flag = false;
            ?>
            <script>
                alert('Invalid email format !');
            </script>
            <?php
        }

        else if(($type != "image/jpeg" && $type != "image/jpg" && $type != "image/png") || 
        $size > 900000)
        {
            $flag = false;
            ?>
                <script>
                    alert('Please select a jpg, jpeg or PNG file which size is less than 900KB !');
                </script>
            <?php
        }

        else
        {
            $sql1 = "SELECT * FROM `users` WHERE 1";
            $result1 = $link->query($sql1);
            while($row = $result1->fetch_assoc())
            {
                if($row['email'] == $useremail)
                {
                    $flag = false;
                    ?>
                    <script>
                        alert('Email is already exists.\nPlease select another email !');
                    </script>
                    <?php
                }
            
                else if($row['contact_no'] == $usercontact)
                {
                    $flag = false;
                    ?>
                    <script>
                        alert('Contact number is already exists.\nPlease select another contact number !');
                    </script>
                    <?php
                }
            }
        }
        
        if($flag)
        {
            
            $sql = "INSERT INTO `regestration`(`firstname`, `middlename`, `lastname`, `gender`, `course`, `email`, `contact_no`, `address`, `password`, `image`) VALUES ('$firstname', '$middlename','$lastname','$usergender', '$usercourse', '$useremail', '$usercontact', '$useraddress', '$userpassword', '$name')";
            
            $result = $link->query($sql);
            
            if($result)
            {
                move_uploaded_file($temp, "uplodedimage/$name");

                ?>
                <script>
                    alert('Register Sucessfully.');
                    window.open('login.php', '_self');
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
    <title>Registration</title>
    <link rel="stylesheet" href="css/registration_style.css">
</head>
<body>
    <div class="registration">
        <div class="class1">
            <h1>Register To Our Hostel</h1>
            <p style="color: red;">*Required Fields<p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            enctype="multipart/form-data" autocomplete="off" >
            <label for="firstname">*Firstname :</label>
            <input type="text" name="firstname" id="firstname" required value="<?php echo $firstname; ?>" ><br>
            <br>
            <label for="midddlename">*Middlename :</label>
            <input type="text" name="middlename" id="middlename" value="<?php echo $middlename; ?>" required><br>
            <br>
            <label for="lastname">*Lastname :</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; 
            ?>" required><br>
            <br>
            <label for="gender">*Gender :</label>
            <input type="radio" name="usergender" id="gender" value="Male" <?php if (isset($usergender) && $usergender=="Male") echo "checked";?> required>Male
            <input type="radio" name="usergender" id="gender" value="Female" <?php if (isset($usergender) && $usergender=="Female") echo "checked";?> >Female
            <input type="radio" name="usergender" id="gender" value="Other" <?php if (isset($usergender) && $usergender=="Other") echo "checked";?> >Other<br>
            <br>
            <label for="usercourse">*Select Course:</label>
            <select id="usercorse" name="usercourse" required>
                <option value="B.E/B.Tech" <?php if (isset($usercourse) && $usercourse=="B.E/B.Tech") echo "selected";?> >B.E/B.Tech</option>
                <option value="B.Sc" <?php if (isset($usercourse) && $usercourse=="B.Sc") echo "selected";?> >B.Sc</option>
                <option value="B.Com" <?php if (isset($usercourse) && $usercourse=="B.Com") echo "selected";?>>B.Com</option>
                <option value="M.B.A" <?php if (isset($usercourse) && $usercourse=="M.B.A") echo "selected";?>>M.B.A</option>
                <option value="M.B.B.S" <?php if (isset($usercourse) && $usercourse=="M.B.B.S") echo "selected";?>>M.B.B.S</option>
            </select><br><br>
            
            <label for="useremail">*E-mail :</label>
            <input type="email" name="useremail" id="useremail" value="<?php echo $useremail; 
        ?>" required><br>
        <br>
        <label for="usercontact">*Contact No. :</label>
        <input type="tel" name="usercontact" id="usercontact" value="<?php echo $usercontact; 
        ?>" placeholder="9236-345-345" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" required><br>
        <br>
        <label for="useraddress">*Address :</label>
        <textarea class="text-area" name="useraddress" id="useraddress" cols="25" rows="5" value="<?php echo $useraddress; ?>" required >
            <?php echo $useraddress;?>
        </textarea>
        
        <p class="text-red"><b>Note: Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</b></p>
        <label for="userpassword">*Password :</label>
        <input type="password" name="userpassword" id="userpassword" value="<?php echo $userpassword; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        
        <label for="userconfirm">*Confirm Password :</label>
        <input type="password" name="userconfirm" id="userconfirm" value="<?php echo $userconfirmpassword; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
        
        <p class="text-red"><b>Note: Image type is jpg or png which size is less than 900kb.</b></p>
        <label for="userimage">*Choose Image :</label>
        <input type="file" name="userimage" id="userimage" required><br><br>
        
        <input class="btn btn-secondary md-heading" type="submit" name="register" value="Register"><br>
        <a class="btn btn-secondary md-heading" href="login.php">Back</a>
    </form>
</div>
</div>
</body>
</html>