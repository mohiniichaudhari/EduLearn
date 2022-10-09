<?php
ob_start();
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
        $str = "select * from tblregister where status=0";
        $rs = mysqli_query($Cnn, $str);
        $records = mysqli_num_rows($rs);
        if (isset($_REQUEST["add"])) {
            $strUp = "update tblregister set status=1 where user_id={$_REQUEST['id']}";
            // echo $strUp;
            if ($_REQUEST["id"] < 1) {
                $msg = urlencode('Something went wrong!');
                header("Location:addUsers.php?msg=" . $msg);
            } else {
                mysqli_query($Cnn, $strUp);
                // header("location:addUsers.php") or die("Something went wrong!");
                $msg = urlencode('User Added Successfully!');
                header("Location:addUsers.php?msg=" . $msg);
            }
        }
        if (isset($_REQUEST["delete"])) {
            $strUp = "update tblregister set status=-1 where user_id={$_REQUEST['id']}";
            // echo $strUp;
            if ($_REQUEST["id"] < 1) {
                $msg = urlencode('Something went wrong!');
            } else {
                mysqli_query($Cnn, $strUp);
                // header("location:addUsers.php") or die("Something went wrong!");
                $msg = urlencode('User Blocked!');
            }
            header("Location:newRequests.php?msg=" . $msg);
        }
        ?>
        <div class="col-sm-9 px-0">
            <?php include_once "_nav.php"; ?>
            <div class="container-fluid pe-5" id="newRequests">
                <?php

                if (isset($_GET["msg"])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET["msg"] . "</div>";
                }
                if ($records == 0) {
                ?>
                <h1 class="text-center p-5 "> NO NEW REQUESTS AVAILABLE....</h1>
                <?php
                } else {

                ?>
                    <h1 class="text-center p-4 ">NEW REQUESTS</h1>
                    <table class="table table-hover table-responsive ">
                        <thead class="table-dark">
                            <tr>
                                <td scope="col">Full Name</td>
                                <td scope="col">Email Id</td>
                                <td scope="col">Contact No.</td>
                                <td scope="col">Registration Date</td>
                                <td scope="col">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($records = mysqli_fetch_array($rs)) {
                            ?>
                                <tr>
                                    <td><?php echo $records["first_name"]." ".$records["last_name"]; ?></td>
                                    <td><?php echo $records["email_id"]; ?></td>
                                    <td><?php echo $records["contact_no"]; ?></td>
                                    <td><?php echo $records["registration_date"]; ?></td>
                                    <td>
                                        <!-- ADD Button -->
                                        <form action="" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $records["user_id"]; ?>">
                                            <button type="submit" class="btn btn-success mr-3" name="add" value="add">
                                                <i class="bi bi-plus-square-fill"></i>
                                            </button>
                                        </form>
                                        <!-- BLOCK Button -->
                                        <form action="" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $records["user_id"]; ?>">
                                            <button type="submit" class="btn btn-danger" name="delete" value="delete">
                                                <i class="bi bi-dash-square-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../JS/script.js"></script>
<script src="../JS/jquery-3.1.1.min.js"></script>

</html>