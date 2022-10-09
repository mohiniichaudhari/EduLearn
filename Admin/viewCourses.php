<?php ob_start();
include_once "connection.php";
if (!isset($_SESSION['admin_id'])) {
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
        $str = "select * from tblcourse";
        $rs = mysqli_query($Cnn, $str);

        if (isset($_REQUEST["DelID"])) {
            // echo "ID= ".$_REQUEST["DelID"];
            $dstr = "select * from tbltopic where course_id={$_REQUEST["DelID"]}";
            $drs = mysqli_query($Cnn, $dstr);
            // echo mysqli_num_rows($drs);
            $strDel = "delete from tblcourse where course_id={$_REQUEST["DelID"]}";
            $del = mysqli_query($Cnn, $strDel);
            if (mysqli_num_rows($del) == 0) {
                $msg = urlencode('Course Deleted Successfully!');
                header("Location:viewCourses.php?msg=" . $msg);
            } else {
                $msg = urlencode('Empty Courses Can Only be deleted !');
                header("Location:viewCourses.php?msg=" . $msg);
            }
        } else if (isset($_REQUEST["CourseID"])) {
            $_SESSION["CourseID"] = $_REQUEST["CourseID"];
            header("location:addCourses.php?");
        } else {
            $msg = urlencode('Something went wrong!');
            // header("Location:viewCourses.php?msg=" . $msg);
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
                <h1 class="text-center p-4">View Courses</h1>
                <table class="table table-hover table-responsive ">
                    <thead class="table-dark">
                        <tr>
                            <td scope="col">Course_name</td>
                            <td scope="col">Course_desc</td>
                            <td scope="col">Course_img</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($rec = mysqli_fetch_array($rs)) {
                        ?>
                            <tr>
                                <td><?php echo $rec["course_name"]; ?></td>
                                <td><?php echo $rec["course_desc"]; ?></td>
                                <td><?php echo $rec["course_img"]; ?></td>
                                <td>
                                    <!-- update Button -->
                                    <a href="?CourseID=<?php echo $rec["course_id"]; ?>" class="btn btn-success mr-3" name="view" value="view">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <a href="?DelID=<?php echo $rec["course_id"]; ?>" class="btn btn-danger mr-3" name="delete" value="delete">
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
</div>
</body>

</html>