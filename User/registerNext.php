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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="../JS/jquery-3.1.1.min.js"></script>
    <style>
        .btn:hover {
            font-weight: bold;
            color: #0f2d4e;
        }
    </style>
</head>

<body style="background-color:#f5b819;">
    <?php include_once "navbar.php"; ?>
    <?php
    $txtfname = $_SESSION['fname'];
    $txtlname = $_SESSION['lname'];
    $txtemail = $_SESSION['email'];
    $txtpwd = $_SESSION['pwd'];
    if (isset($_REQUEST['btnRegister'])) {
        $txtcontact = $_REQUEST['txtcontact'];
        $selGender = $_REQUEST['selGender'];
        $txtbdate = $_REQUEST['txtbdate'];
        $security_que = $_REQUEST['security_que'];
        $security_ans = $_REQUEST['security_ans'];
        if ($txtcontact == "" | $selGender == "" | $txtbdate == "" | $security_ans == "" | $security_que == "") {
            $msg = urlencode("All Fields are Compulsory.");
            header("Location:registerNext.php?msg=" . $msg);
        } else {
            $strIns = "insert into tblregister(email_id,password,contact_no,first_name,last_name,date_of_birth,gender,security_question,security_answer)values('$txtemail','$txtpwd','$txtcontact','$txtfname','$txtlname','$txtbdate','$selGender','$security_que','$security_ans') ";
            mysqli_query($Cnn, $strIns)  or die(mysqli_error($Cnn));
            $msg = urlencode('Registered Successfully!');
            header("Location:login.php?msg=" . $msg);
        }
    }
    ?>
    <div class="row text-center">
        <div class="col-sm-12 px-0 py-3 mt-3">
            <form method="post" class="p-5 mx-auto jumbotron" style="width:700px;background-color:#0f2d4e;color: #f5b819;">
                <h1 class="mx-auto text-center"> SIGN UP </h1>

                <div class="form-group">
                    <input type="text" class="form-control" name="txtcontact" placeholder="Contact No : XXXXX XXXXX" />
                </div>
                <br />
                <div class="form-group">
                    <select class="form-control" name="selGender">
                        <option value="" disabled selected>-- Select Gender --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <br />
                <div class="form-group">
                    <input type="text" placeholder="Enter Date of birth" class="form-control" name="txtbdate" onfocus="(this.type='date')">
                </div>
                <br />
                <div class="form-group">
                    <select class="form-control" name="security_que">
                        <option disabled selected>-- Select Security Question --</option>
                        <option>What is the name of your pet?</option>
                        <option>Who is your best friend?</option>
                        <option>Which was your first school?</option>
                    </select>
                </div>
                <br />
                <div class="form-group">
                    <input type="text" class="form-control" name="security_ans" placeholder="Enter Security Answer" />
                </div>
                <br />
                <center>
                    <a href="registration.php" class="btn px-5" style="color:#0f2d4e">BACK</a>
                    <input type="submit" class="btn px-5" style="background-color:#f5b819;color:#0f2d4e" name="btnRegister" value="REGISTER">
                </center>
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
                }
                ?>
            </form>
        </div>
    </div>
    <div class="row">
        <?php include_once "footer.php" ?>
    </div>
</body>

</html>