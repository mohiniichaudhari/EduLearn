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
        .backblue {
            background-color: #0f2d4e;
            color: #f5b819;
        }

        .backyellow {
            background-color: #f5b819;
            color: #0f2d4e;
        }
    </style>
</head>

<body>
    <?php include_once "navbar.php"; ?>
    <?php
    if (isset($_GET['course_id'])) {
        //echo "HI";
        if (isset($_SESSION['user_id'])) {
            //echo "HI";
            $user_id = $_SESSION['user_id'];
            $course_id = $_SESSION['course_id'];
            $strIns = "insert into tblenroll values(null,$user_id,". $_SESSION['course_id']. ")";
            mysqli_query($Cnn, $strIns) or die(mysqli_error($Cnn));
            $msg = urlencode("Course Enrolled Successfully. Happy Learning..~!");
            header("Location:courses.php?msg=" . $msg);
        }
    }
    ?>
    <div class="container-fluid backyellow">
        <h1 class=" p-2 text-center">Courses</h1>
        <?php
        if (isset($_GET['msg'])) {
            echo '<div class="alert alert-info mx-auto mt-2 col-sm-8">' . $_GET['msg'] . '</div>';
        }
        ?>
        <div class="row">

            <div class="card-deck" style="display:flex">
                <?php

                $str = "select * from tblcourse limit 3";
                $rs = mysqli_query($Cnn, $str);
                while ($rec = mysqli_fetch_array($rs)) {
                    $course_id = $rec['course_id'];
                    if (isset($_SESSION['user_id'])) {
                        $strIns = "select * from tblenroll where user_id=" .  $_SESSION['user_id'];
                        $result = mysqli_query($Cnn, $strIns) or die(mysqli_error($Cnn));
                        // print_r($courses = mysqli_fetch_array($result));
                    }
                ?>
                    <a href="
                     <?php
                        if (isset($_SESSION['user_id'])) {
                            echo  "topics.php?course_id=$course_id";
                        } else {
                            $msg = urlencode("You need to login first to view the content of course.");
                            echo "login.php?msg=$msg";
                        }
                        ?>" style="text-decoration: none;color: black;">
                        <div class="card col-sm-4 m-2" style="width:25rem;">
                            <img class="card-img-top" src="<?php echo '../Admin/' . $rec['course_img'] ?>">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $rec['course_name'] ?></h4>
                                <p class="card-text"><?php echo $rec['course_desc'] ?></p>
                                <div class="text-muted">Price : Free</div>
                                <a href="
                                <?php if (!isset($_SESSION['user_id'])) {
                                    $msg = urlencode("You need to login first to enroll the course.");
                                    echo "login.php?msg=$msg";
                                } else {
                                    $_SESSION['course_id'] = $rec['course_id'];
                                    echo "courses.php?course_id=" . $rec['course_id'];
                                } ?>" name="btnsubmit" style="margin-left:130px;background-color:#0f2d4e;" class="btn px-5">
                                    Enroll
                                </a>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <?php include_once "footer.php" ?>
        </div>
    </div>
</body>

</html>