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
    body{
      background:url("../Admin/courseImages/homebg.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }
    div{
      color:#f5b819;
    }
  </style>
</head>

<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <h1 class="mt-5" style="margin-left:500px; font-size:50px;">EduLearn</h1>
        <p style="font-size: 30px;" class="mt-5 text-center">
        Our website provides you a platform where you can learn coding <br/>
        for free in short time without searching for content on different platforms<br/>
        because our website contains everything at a single place. <br/>
        Our website collects all the important and simple youtube videos and put them together for users to learn easily.</p>

        <a href="courses.php" class="btn mr-3 my-4" style="margin-left:800px;font-size: 30px;background-color:#f5b819;color:#0f2d4e!important;">SHOW COURSES</a>
        <div class="row">
          <?php include_once "footer.php" ?>
        </div>
    </div>
    
</body>
</html>