<?php

require_once "config.php";
session_start();
if(!isset($_SESSION['adminid']) || !isset($_SESSION['adminname']) )
{
    header('location:adminlogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regestraion Details</title>
    <link rel="stylesheet" href="css/index_style.css">
    <style>
        table, th, td{
            border: 2px solid black;
        }

        td, th{
            width: 180px;
        }

        table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<div style="font-size:20px" class="rd">
        <br>
    <h1>Regestration Details</h1>
    <br>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" 
        autocomplete="off">
        <label for="name"></label>
        <input style="font-size:25px" type="text" name="name" id="name" placeholder="Search name here">
        <input style="font-size:25px" type="submit" name="search" value="Search"><Br><br>
    </form>
    
    <table>
        <tr>
            <th>Sr no.</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Course</th>
            <th>Email</th>
            <th>Conatact No.</th>
            <th>address</th>
            <th>Actions</th>
        </tr>
        
        <?php 
    
    if(isset($_POST['search']))
    {
        $name = $_POST['name'];
        $sql = "SELECT * FROM `regestration` WHERE `firstname` LIKE '%$name%'";
        $result = $link->query($sql);
        $nums = $result->num_rows;
        $count = 1;
        
        if ($nums > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <img src="uplodedimage/<?php echo $row['image']; ?>" alt="User image" style="width:200px; height: 150px;">
                            </td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['middlename']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                                <a class="btn btn-secondary" href="addStudent.php?id=<?php echo $id; ?>" >Confirm Addmission</a><br><br>
                                <a class="btn btn-secondary" href="deleteregistration.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure want to Delete this record ?')">Delete</a>
                            </td>
                        </tr>
                        
                        <?php
                    }
                }
                else
                {
                    ?>
                    <th colspan="16">No records found.</th>
                    <?php
                }
            }
            
            else
            {
                $sql = "SELECT * FROM `regestration`";
                $result = $link->query($sql);
                
                $nums = $result->num_rows;
                $count = 1;
                
                if ($nums > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id = $row['id'];
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <img src="uplodedimage/<?php echo $row['image']; ?>" alt="User image" style="width:200px; height: 150px;">
                            </td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['middlename']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                                <a class="btn btn-secondary" href="addStudent.php?id=<?php echo $id; ?>" >Confirm Addmission</a>
                                <a class="btn btn-secondary" href="deleteregistration.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure want to Delete this record ?')">Delete</a>
                            </td>
                        </tr>
                        
                        <?php
                        }
                    }
                    
                    else
                    {
                        ?>
            <th colspan="11">No records found.</th>
            <?php
        }
        
    }
    
    ?>
    
</table><br>
<a class="btn btn-secondary" style="font-size:25px"  href="adminDash.php">Back to Admin Dash</a>
<br><br>
<a class="btn btn-secondary" style="font-size:25px"  href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a>
<br><br>
</div>
</body>
</html>