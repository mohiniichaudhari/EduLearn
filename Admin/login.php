<?php ob_start();
include_once "connection.php";
unset($_SESSION['admin_id']);
unset($_SESSION['admin_email']);
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
    <?php
    if (isset($_REQUEST["btnlogin"])) {
        $txtusername = $_REQUEST["txtusername"];
        $txtpwd = $_REQUEST["txtpwd"];
        $strUp = "select * from tbladmin where admin_email='$txtusername' and admin_password='$txtpwd'";
        $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
        $rec = mysqli_fetch_array($rs);
        if (mysqli_num_rows($rs) == 1) {
            $_SESSION['admin_id'] = $rec['admin_id'];
            $_SESSION['admin_email'] = $rec['admin_email'];
            header("Location:dashboard.php");
        } else {
            $msg = urlencode('Invalid Login Credentials');
            header("Location:login.php?msg=" . $msg);
        }
    }
    ?>
    <div class="row text-center">
        <div class="col-sm-12 px-0">
            <form method="post" class="p-5 jumbotron bg-dark text-light" style="margin:auto;width:500px;margin-top:70px">

                <h1 class="text-center ">ADMIN LOGIN </h1>
                <div class="form-group p-2">
                    <input type="text" class="form-control" name="txtusername" aria-describedby="txtusername" placeholder="Enter Email ">
                </div>
                <br />
                <div class="form-group p-2">
                    <input type="password" class="form-control" name="txtpwd" aria-describedby="txtpwd" placeholder="Enter Password">
                </div>
                <br />
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-light px-5" name="btnlogin"  value="LOG IN">
                </div>
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
                }
                ?>
            </form>
        </div>
    </div>
</body>
<script src="../JS/script.js"></script>
<script src="../JS/jquery-3.1.1.min.js"></script>

</html>