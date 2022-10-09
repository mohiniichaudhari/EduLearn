<?php ob_start();
include_once "../Admin/connection.php";
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);

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
    <style>
        .btn:hover {
            font-weight: bold;
            color: #0f2d4e;
        }
    </style>
</head>

<body style="background-color: #f5b819;">
    <?php
    if (isset($_REQUEST["btnlogin"])) {
        $txtusername = $_REQUEST["txtusername"];
        $txtpwd = $_REQUEST["txtpwd"];
        $strUp = "select * from tblregister where email_id='$txtusername' and password='$txtpwd' and status=1";
        $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
        $rec = mysqli_fetch_array($rs);
        if (mysqli_num_rows($rs) == 1) {
            $_SESSION['user_id'] = $rec['user_id'];
            $_SESSION['user_email'] = $rec['email_id'];
            header("Location:userProfile.php");
        } else {
            $msg = urlencode('Invalid Login Credentials');
            header("Location:login.php?msg=" . $msg);
        }
    }
    ?>
    <div class="row text-center">
        <div class="col-sm-12 px-0 mt-5">
            <form method="post" class="p-5 mx-auto mt-5 jumbotron" style="width:400px;background-color:#0f2d4e;color: #f5b819;">
                <h1 class="text-center "> LOGIN </h1>
                <div class="form-group p-2">
                    <input type="text" class="form-control" name="txtusername" aria-describedby="txtusername" placeholder="Enter Email ">
                </div>
                <br />
                <div class="form-group p-2">
                    <input type="password" class="form-control" name="txtpwd" aria-describedby="txtpwd" placeholder="Enter Password">
                </div>
                <br />
                <div class="form-group text-center">
                    <input type="submit" class="btn px-5" name="btnlogin" style="background-color:#f5b819;" value="LOG IN">
                </div>
                <center>
                    <br />
                    Not Registered Yet? <a href="registration.php" style="color: #f5b819;"><u>Register Here</u></a><br />
                    <a href="forgotPwd.php" style="color: #f5b819;">Forgot Password?</a>
                </center>
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