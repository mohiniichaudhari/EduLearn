<?php ob_start();
include_once "../Admin/connection.php";
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
    if (isset($_REQUEST["btnnext"])) {
        $txtusername = $_REQUEST["txtusername"];
        $security_que = $_REQUEST['security_que'];
        $security_ans = $_REQUEST['security_ans'];
        $new_pwd = $_REQUEST['new_pwd'];
        $con_pwd = $_REQUEST['confirm_pwd'];

        if ($txtusername == "" | $security_ans == "" | $security_que == "" | $new_pwd == "" | $con_pwd == "") {
            $msg = urlencode("All Fields are Compulsory.");
            header("Location:forgotPwd.php?msg=" . $msg);
        } else {
            $strUp = "select * from tblregister where email_id='$txtusername'";
            $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
            $rec = mysqli_fetch_array($rs);
            if (mysqli_num_rows($rs) != 1) {
                $msg = urlencode("Username Doesn't Exists.");
                header("Location:forgotPwd.php?msg=" . $msg);
            } else {
                if ($rec['security_question'] != $security_que | $rec['security_answer'] != $security_ans) {
                    $msg = urlencode('Invalid Security Question Or Answer.');
                    header("Location:forgotPwd.php?msg=" . $msg);
                } else {
                    if ($new_pwd != $con_pwd) {
                        $msg = urlencode('New Password and Confirm Password must be same.');
                        header("Location:forgotPwd.php?msg=" . $msg);
                    } else {
                        $strCh = "update tblregister set password='$new_pwd' where email_id='$txtusername'";
                        $rs = mysqli_query($Cnn, $strCh) or die(mysqli_error($Cnn));
                        header("Location:login.php");
                    }
                }
            }
        }
    }
    ?>
    <div class="row text-center">
        <div class="col-sm-12 px-0 mt-2">
            <form method="post" class="p-5 mx-auto mt-2 jumbotron" style="width:700px;background-color:#0f2d4e;color: #f5b819;">
                <h1 class="text-center "> Forgot Password ?</h1>
                <div class="form-group p-2">
                    <input type="text" class="form-control" name="txtusername" placeholder="Enter Email ">
                </div>
                <br />
                <div class="form-group p-2">
                    <select class="form-control" name="security_que">
                        <option disabled selected>-- Select Security Question --</option>
                        <option>What is the name of your pet?</option>
                        <option>Who is your best friend?</option>
                        <option>Which was your first school?</option>
                    </select>
                </div>
                <br />
                <div class="form-group p-2">
                    <input type="text" class="form-control" name="security_ans" placeholder="Enter Security Answer">
                </div>
                <br />
                <div class="form-group p-2">
                    <input type="password" class="form-control" name="new_pwd" placeholder="Enter New Password">
                </div>
                <br />
                <div class="form-group p-2">
                    <input type="password" class="form-control" name="confirm_pwd" placeholder="Enter Confirm Password">
                </div>
                <br />
                <div class="form-group text-center">
                    <input type="submit" class="btn px-5" name="btnnext" style="background-color:#f5b819;" value="CHANGE PASSWORD">
                </div>
                <!-- <center>
                    <br />
                    Not Registered Yet? <a href="registration.php" style="color: #f5b819;"><u>Register Here</u></a><br />
                    <a href="forgotPwd.php" style="color: #f5b819;">Forgot Password?</a>
                </center> -->
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