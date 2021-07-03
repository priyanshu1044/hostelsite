<?php
require_once "config.php";
session_start();
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('location:adminlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave requests</title>
    <link rel="stylesheet" href="css/addstudent_style.css">
    <style>
        table,
        th,
        td {
            border: 2px solid black;
            padding:10px;
        }


        td,
        th {
            width: 180px;
        }

        table {
            border-collapse: collapse;
            width:100%;
        }
    </style>
</head>
<body>
    <div class="slr">
        <br>
        <h1>Leave requests</h1>
        <table>
            <tr>
                <th>Sr. no</th>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Note</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Action</th>
            </tr>
    
        <?php
        $sql1 = "SELECT * FROM `leave_request` WHERE 1";
        $result1 = $link->query($sql1);
        $nums = $result1->num_rows;
        $count = 1; 
    
        if($nums > 0)
        {
            while($row = $result1->fetch_assoc())
            {
                ?>
                <td><?php echo $count++ ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['note']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['fromdate'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['todate'])); ?></td>
                <td><a class="btn btn-secondary" href="deleteLeaveRequest.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure want to Delete this Leave Request ?')" >Delete</a></td>
                <?php
            }
        }
    
        else
        {
            ?>
            <tr>
            <th colspan="9">No records Found</th>
            </tr>
            <?php
        }
        ?>
    
        
    
        </table>
        <div class="center">
            <a class="btn btn-secondary" style="font-size:25px" href="adminDash.php">Back to Admin Dash</a><br>
            <a class="btn btn-secondary" style="font-size:25px" href="logout.php" onclick="return confirm('Are you sure want to Logout ?')">Logout</a>
        </div>
    </div>
</body>
</html>