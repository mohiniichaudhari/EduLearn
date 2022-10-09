<?php ob_start();
include_once "connection.php";
if(!isset($_SESSION['admin_id']))
{
  header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 px-0">
            <?php include_once "nav.php"; ?>
        </div>
        <?php
        $str = "select * from tblregister where status=1";
        $rs = mysqli_query($Cnn, $str);
        if (isset($_REQUEST["DelID"])) {
            $strDel = "delete from tblregister where user_id={$_REQUEST["DelID"]}";
            $dres = mysqli_query($Cnn, $strDel) or die(mysqli_error($Cnn));
            if (mysqli_num_rows($dres) != 0) {
                $msg = urlencode('This user has given feedback. Please delete their feedback before deleting them.');
                header("Location:viewUsers.php?msg=" . $msg);
            } else {
                $msg = urlencode('User Deleted Successfully!');
                header("Location:viewUsers.php?msg=" . $msg);
            }
            
        }
        if (isset($_REQUEST["UserID"])) {
            $_SESSION["UserID"] = $_REQUEST["UserID"];
            header("location:addUsers.php");
        }
        ?>
        <div class="col-sm-9 px-0">
            <?php include_once "_nav.php"; ?>
            <div class="container-fluid pe-5">
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
                }
                ?>
                <h1 class="text-center p-4">View Users</h1>
                <table class="table table-hover table-responsive ">
                    <thead class="table-dark">
                        <tr>
                            <td scope="col">User Name</td>
                            <td scope="col">Email</td>
                            <td scope="col">Password</td>
                            <td scope="col">Contact</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($rec = mysqli_fetch_array($rs)) {
                        ?>
                            <tr>
                                <td><?php echo $rec["first_name"]; ?></td>
                                <td><?php echo $rec["email_id"]; ?></td>
                                <td><?php echo $rec["password"]; ?></td>
                                <td><?php echo $rec["contact_no"]; ?></td>
                                <td>
                                    <!-- update Button -->
                                    <a href="?UserID=<?php echo $rec["user_id"]; ?>" class="btn btn-success mr-3" name="view" value="view">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>


                                    <!-- Delete Button -->
                                    <a href="?DelID=<?php echo $rec["user_id"]; ?>" class="btn btn-danger mr-3" name="delete" value="delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</body>

</html>