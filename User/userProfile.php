<?php ob_start();
include_once "../Admin/connection.php";
if (!isset($_SESSION['user_id'])) {
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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="../JS/jquery-3.1.1.min.js"></script>
    <style>
        .backblue {
            background-color: #0f2d4e;
            color: #f5b819;
        }

        .backyellow {
            background-color: #f5b819;
            color: #0f2d4e;
        }

        .btn:hover {
            font-weight: bold;
            color: #0f2d4e;
        }
    </style>
</head>

<body style="background-color:#f5b819;">
    <?php include_once "navbar.php";

    //GETTING VALUES IN TEXTBOX
    if (isset($_SESSION["user_id"])) {
        $strUp = "select * from tblregister where user_id={$_SESSION["user_id"]}";
        $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
        $records = mysqli_fetch_array($rs);
        // print_r($records);
    }
    //UPDATING PROFILE
    if (isset($_REQUEST["btnupdate"])) {
        $user_fname = $_REQUEST["user_fname"];
        $user_lname = $_REQUEST["user_lname"];
        $user_email = $_REQUEST["user_email"];
        $user_contact = $_REQUEST["user_contact"];
        $user_bdate = $_REQUEST["user_bdate"];
        $user_gender = $_REQUEST["user_gender"];

        if ($user_fname == "" | $user_lname == "" | $user_email == "" | $user_contact == "" | $user_bdate == "" | $user_gender == "") {
            $msg = urlencode('All Fields are Required!');
        } else {
            $strUp = "update tblregister set first_name='$user_fname', last_name='$user_lname',email_id='$user_email', contact_no='$user_contact', date_of_birth='$user_bdate', gender='$user_gender' where user_id={$_SESSION["user_id"]}";
            mysqli_query($Cnn, $strUp);
            $_SESSION['user_email'] = $user_email;
            $msg = urlencode('Your Profile was Updated Successfully!');
            header("Location:userProfile.php?msg=" . $msg);
        }
    }
    //CHANGING PASSWORD
    if (isset($_REQUEST["btn_change_pwd"])) {
        $current_pwd = $_REQUEST["current_pwd"];
        $new_pwd = $_REQUEST["new_pwd"];
        $confirm_pwd = $_REQUEST["confirm_pwd"];
        $str = "select * from tblregister where password='$current_pwd' and user_id=" . $_SESSION['user_id'];
        $result = mysqli_query($Cnn, $str) or die(mysqli_error($Cnn));
        if (mysqli_num_rows($result) == 1) {
            if ($new_pwd != $confirm_pwd) {
                $mesg = urlencode("New Password and Confirm Password must be same.");
                header("Location:userProfile.php?mesg=" . $mesg);
            } else {
                $strup = "update tblregister set password='$new_pwd' where user_id=" . $_SESSION['user_id'];
                $result = mysqli_query($Cnn, $strup) or die(mysqli_error($Cnn));
                $mesg = urlencode("Password Updated Successfully.");
                header("Location:userProfile.php?mesg=" . $mesg);
            }
        } else if ($current_pwd == "" | $confirm_pwd == "" | $new_pwd == "") {
            $mesg = urlencode('All Fields are Required!');
            header("Location:userProfile.php?mesg=" . $mesg);
        } else {
            $mesg = urlencode('Invalid Credentials!');
            header("Location:userProfile.php?mesg=" . $mesg);
        }
    }

    ?>
    <div class="container-fluid backyellow">
        <div class="row">
            <form method="post" class="mx-auto mt-3 p-3 jumbotron" style="width:800px;background-color:#0f2d4e;color: #f5b819;">
                <div class="heading col-sm-12">
                    <span class="text-center">
                        <h1>MY PROFILE</h1>
                    </span>
                </div>
                <br />
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET["msg"] . '</div>';
                }
                ?>
                <div class="row col-sm-12">
                    <div class="form-group col-sm-6">
                        <label for="user_fname">First Name :</label>
                        <input type="text" class="form-control" name="user_fname" value="<?php echo $records["first_name"] ?>">
                    </div>
                    <br />
                    <div class="form-group col-sm-6">
                        <label for="user_lname">Last Name :</label>
                        <input type="text" class="form-control" name="user_lname" value="<?php echo $records["last_name"] ?>">
                    </div>
                    <br />
                </div>
                <div class="row col-sm-12">
                    <div class="form-group col-sm-6">
                        <label for="user_email">Email ID :</label>
                        <input type="email" class="form-control" name="user_email" value="<?php if (isset($records)) echo $records['email_id']; ?>">
                    </div>
                    <br />
                    <div class="form-group col-sm-6">
                        <label for="user_contact">Contact Number :</label>
                        <input type="text" class="form-control" name="user_contact" value="<?php if (isset($records)) echo $records['contact_no']; ?>">
                    </div>
                </div>
                <div class="row col-sm-12">
                    <div class="form-group col-sm-6">
                        <label for="user_bdate">Date of Birth :</label>
                        <input type="text" class="form-control" name="user_bdate" value="<?php if (isset($records)) echo $records['date_of_birth']; ?>">
                    </div>
                    <br />
                    <div class="form-group col-sm-6">
                        <label for="user_gender">Gender :</label>
                        <input type="text" class="form-control" name="user_gender" value="<?php if (isset($records)) echo $records['gender']; ?>">
                    </div>
                    <br />
                </div>
                <br />
                <div class="row">
                    <div class="row col-sm-12">
                        <div class="text-center">
                            <input type="submit" class="btn px-5" style="background-color:#f5b819;" name="btnupdate" value='Update Profile' />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- END OF FIRST BLOCK I.E. EDIT PROFILE -->
        <div class="collapse row show" id="changePwd">
            <form method="post" class="mx-auto mt-3 p-5 jumbotron" style="width:550px;background-color:#0f2d4e;color: #f5b819;">
                <div class="heading col-sm-12">
                    <span class="text-center">
                        <h1>Change Password</h1>
                    </span>
                </div>
                <br />
                <?php
                if (isset($_GET['mesg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET["mesg"] . '</div>';
                }
                ?>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="current_pwd">Current Password :</label>
                        <input type="password" class="form-control" name="current_pwd">
                    </div>
                    <br />
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="new_pwd">New Password:</label>
                        <input type="password" class="form-control" name="new_pwd">
                    </div>
                    <br />
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="confirm_pwd">Confirm Password :</label>
                        <input type="password" class="form-control" name="confirm_pwd">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <input type="submit" class="btn mt-4 px-4" style="background-color:#f5b819;" name="btn_change_pwd" value='Change Password' />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- END OF CHANGE PASSWORD BLOCK -->
        <div class="row mb-3">
            <div class="mx-auto mt-3 p-2 jumbotron" style="width:fit-content;background-color:#0f2d4e;color: #f5b819;">
                <h1 class="text-center">My Courses</h1>
                <table class="text-center">
                    <tr>
                        <?php
                        $strjoin = "select c.* from tblcourse as c, tblenroll as e where c.course_id=e.course_id and e.user_id=" . $_SESSION['user_id'];
                        // $strjoin="select * from tblcourse where course_id in (select course_id from tblenroll where user_id={$_SESSION['user_id']})";
                        // $strjoin="select "
                        $result = mysqli_query($Cnn, $strjoin) or die(mysqli_error($Cnn));
                        if (mysqli_num_rows($result) > 0) {
                            while ($mycourses = mysqli_fetch_array($result)) {
                                $course_id = $mycourses["course_id"];
                        ?>
                                <td>
                                    <a href="<?php echo "topics.php?course_id=$course_id"; ?>" style="text-decoration: none;color: black;">
                                        <div class="card col-sm-4 m-2" style="width:26rem;">
                                            <img class="card-img-top" src="<?php echo '../Admin/' . $mycourses['course_img'] ?>">
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo $mycourses['course_name'] ?></h4>
                                                <p class="card-text"><?php echo $mycourses['course_desc'] ?></p>
                                                <input type="submit" name="btnView" style="margin-left:130px;background-color:#0f2d4e;color: #f5b819" class="btn px-5" value="View">
                                            </div>
                                        </div>
                                    </a>
                                </td>
                        <?php
                            }
                        } else {
                            echo "<tr><td><h1 class='mx-auto p-5'> You are currently not enrolled in any course.</h1></td></tr>";
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <?php include_once "footer.php" ?>
        </div>
    </div>
</body>

</html>