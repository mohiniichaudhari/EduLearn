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
    a{
      color: #f5b819 !important;
      font-weight:bold !important;
    }
    li{
      padding: 10px !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-lg sticky-top" style="background-color:#0f2d4e;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" style="font-size:26px;margin-right:50px;">
        <img src="../Images/logo.png" width="50" height="50" class="d-inline-block">
        EduLearn
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link btn" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="courses.php">Courses</a>
          </li>
          <?php if(!isset($_SESSION['user_id'])){ ?>
          <li class="nav-item" style="width: 100px;">
            <a class="nav-link btn" href="registration.php">Sign Up</a>
          </li>
          <li class="nav-item" style="margin-left:500px;">
            <a class="nav-link btn" href="login.php">Sign In</a>
          </li>
          <?php 
          }else{ 
           ?>
          <li class="nav-item">
            <a class="nav-link btn" href="feedback.php">Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="logOut.php">Sign Out</a>
          </li>
          <li class="nav-item" style="margin-left:400px">
            <a class="nav-link btn" href="userProfile.php">My Profile</a>
          </li>
          <?php } ?>
          
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>