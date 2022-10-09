<?php ob_start();
include_once "connection.php";
if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="../JS/jquery-3.1.1.min.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 px-0">
            <?php include_once "nav.php"; ?>
        </div>
        <?php
        if (isset($_SESSION["admin_id"])) {
            $strUp = "select * from tbladmin where admin_id={$_SESSION["admin_id"]}";
            $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
            $records = mysqli_fetch_array($rs);
            // print_r($records);
        }
        if (isset($_REQUEST["btnsave"])) {
            $admin_name = $_REQUEST["admin_name"];
            $admin_email = $_REQUEST["admin_email"];
            $admin_contact = $_REQUEST["admin_contact"];
            $admin_bdate = $_REQUEST["admin_bdate"];
            $admin_gender = $_REQUEST["admin_gender"];

            if ($admin_name == "" | $admin_email == "" | $admin_contact == "" | $admin_bdate == "" | $admin_gender == "") {
                $msg = urlencode('All Fields are Required!');
            } else {
                $strUp = "update tbladmin set admin_name='$admin_name', admin_email='$admin_email', admin_contact='$admin_contact', admin_bdate='$admin_bdate', admin_gender='$admin_gender' where admin_id={$_SESSION["admin_id"]}";
                mysqli_query($Cnn, $strUp);
                $msg = urlencode('Your Profile was Updated Successfully!');
                header("Location:admin_profile.php?msg=" . $msg);
            }
        }
        ?>
        <div class="col-sm-9 px-0">
            <?php include_once "_nav.php"; ?>
            <form method="post" enctype="multipart/form-data" class="mx-5 p-3 jumbotron bg-light">
                <div class="heading col-sm-8">
                    <span class="text-center">
                        <h1>MY PROFILE</h1>
                    </span>
                </div>
                <br />
                <?php

                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-8">' . $_GET["msg"] . '</div>';
                }
                ?>
                <div class="row col-sm-8">
                    <div class="form-group col-sm-6">
                        <label for="admin_name">Full Name :</label>
                        <input type="text" class="form-control" name="admin_name" value="<?php echo $records["admin_name"] ?>">
                    </div>
                    <br />
                    <div class="form-group col-sm-6">
                        <label for="admin_email">Email :</label>
                        <input type="email" class="form-control" name="admin_email" value="<?php if (isset($records)) echo $records['admin_email']; ?>">
                    </div>
                    <br />
                </div>
                <div class="row col-sm-8">
                    <div class="form-group col-sm-6">
                        <label for="admin_contact">Contact Number :</label>
                        <input type="text" class="form-control" name="admin_contact" value="<?php if (isset($records)) echo $records['admin_contact']; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="admin_bdate">Date of Birth :</label>
                        <input type="text" class="form-control" name="admin_bdate" value="<?php if (isset($records)) echo $records['admin_bdate']; ?>">
                    </div>
                    <br />
                </div>
                <div class="row col-sm-8">
                    <div class="form-group col-sm-6">
                        <label for="admin_gender">Gender :</label>
                        <input type="text" class="form-control" name="admin_gender" value="<?php if (isset($records)) echo $records['admin_gender']; ?>">
                    </div>
                    <br />
                </div>
                <br />
                <div class="row col-sm-8">
                    <div class="text-center">
                        <input type="submit" class="btn btn-danger" name="btnsave" value='SAVE' />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>