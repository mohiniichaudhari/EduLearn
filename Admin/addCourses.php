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

    if (isset($_SESSION["CourseID"])) {
      $strUp = "select * from tblcourse where course_id={$_SESSION["CourseID"]}";
      $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
      $records = mysqli_fetch_array($rs);
    }

    if (isset($_REQUEST["btn_addCourse"])) {
      $course_name = $_REQUEST["course_name"];
      $course_desc = $_REQUEST["course_desc"];
      $course_image = $_REQUEST["hdnImage"];

      if (!empty($_FILES["course_image"]["name"])) {

        $course_image = $_FILES["course_image"]["name"];
        $course_temp_name = $_FILES["course_image"]["tmp_name"];
        $img_folder = "courseImages/" . $course_image;
        move_uploaded_file($course_temp_name, $img_folder);
      }
      if ($course_name == "" | $course_desc == "") {
        $msg = urlencode('All Fields are Required!');
        header("Location:addCourses.php?msg=" . $msg);
      }
      //checking if the update id is set or not and if it is not set, let's insert 
      else if (!isset($_SESSION["CourseID"])) {
        $strIns = "insert into tblcourse values (null,'$course_name','$course_desc','$img_folder')";
        mysqli_query($Cnn, $strIns)  or die(mysqli_error($Cnn));
        $msg = urlencode('Course Added Successfully!');
        header("Location:addCourses.php?msg=" . $msg);
      } else {
        $strUp = "update tblcourse set course_name='$course_name', course_desc='$course_desc', course_img='$course_image' where course_id={$_SESSION["CourseID"]}";
        mysqli_query($Cnn, $strUp)  or die(mysqli_error($Cnn));
        $msg = urlencode('Course Updated Successfully!');
        unset($_SESSION["CourseID"]);
        header("Location:addCourses.php?msg=" . $msg);
      }
    }

    ?>

    <div class="col-sm-9 px-0">
      <?php include_once "_nav.php"; ?>
      <form method="post" enctype="multipart/form-data" class="mx-3 p-3 jumbotron bg-light">
        <div class="heading">
          <span class="text-center">
            <h1>
              <?php
              if (isset($_SESSION["CourseID"])) {
                // echo "ID : " . $_SESSION["CourseID"];
                echo "Update Course";
              } else {
                echo "Add Course";
              }
              ?>
            </h1>
          </span>
        </div>
        <br />
        <div class="form-group">
          <label for="course_name">Course Name :</label>
          <input type="text" class="form-control" name="course_name" value="<?php if (isset($records)) echo $records["course_name"]; ?>" aria-describedby="coursename" placeholder="Enter Name of Course">
        </div>
        <br />
        <div class="form-group">
          <label for="course_desc">Course Description :</label>
          <textarea class="form-control" name="course_desc" rows="3" placeholder="Enter Course Description"><?php if (isset($records)) echo $records["course_desc"]; ?></textarea>
        </div>
        <br />
        <div class="form-group">
          <label for="course_image">Course Image :</label>
          <input type="hidden" name="hdnImage" value="<?php if (isset($records)) echo $records["course_img"]; ?>">
          <?php if (isset($_SESSION["CourseID"])) { ?>
            <img height="150px" width="150px" src="
            <?php
            if (isset($records)) {
              echo $records["course_img"];
            }
            ?>" />
          <?php } ?>

          <input type="file" class="form-control" name="course_image" value="<?php if (isset($records)) {
                                                                                echo $records['course_img'];
                                                                              } ?>" placeholder="Enter Image for Course">
        </div>
        <br />
        <div class="text-center">
          <input type="submit" class="btn btn-danger" name="btn_addCourse" value='<?php if (isset($_SESSION["CourseID"])) {
                                                                                    echo "UPDATE COURSE";
                                                                                  } else {
                                                                                    echo "ADD COURSE";
                                                                                  } ?>' />

        </div>
        <?php
        if (isset($_GET['msg'])) {
          echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
        }
        ?>
      </form>
    </div>

  </div>
</div>

</body>

</html>