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
    body {
      background: url("../Admin/courseImages/aboutbg.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }

    div {
      color: #0f2d4e;
    }

    p {
      font-size: 30px;
      margin-top: 50px;
    }

    li {
      list-style-type: '\2713';
    }
  </style>
</head>

<body>
  <?php include_once "navbar.php"; ?>
  <div class="container-fluid">
    <div class="text-center">
    <h1 style="padding-top:50px; font-size:60px; font-weight:bolder;">About Us</h1>
    <br />
    <p>
      Video-based learning is the use of video to teach knowledge and skills. Chances are at some point in your life you have learned something from watching a video, whether it was in elementary school in science class or a youtube tutorial.
    </p>
    <br />
    <p>
      Now-a-days everyone uses Websites or Apps to learn something but with a condition that the process of learning should be fast enough so that their precious time is saved.
    </p><br />
    <p>
      Our website provides you a platform where you can learn coding for free in short time without searching for content on different platforms because our website contains everything at a single place. Our website collects all the important and simple youtube videos and put them together for users to learn easily.
    </p>

    </div>

    <div style="font-size: 30px; margin-top:50px; margin-left: 200px;">
      <h1>Our Goals :</h1>
      <p>
        <li>Enhance the quality of learning and teaching.</li>
        <li>Everything at a single platform.</li>
        <li>To make learning more interesting as videos are more persuasive than any other content type.</li>
        <li>To provide a simple and practical learning experience.</li>
        <li>Improve user-accessibility and time flexibility to engage learners in the learning process.</li>
        <li>Improve the efficiency and effectiveness.</li>

      </p>
    </div>
    <div class="row">
      <?php include_once "footer.php" ?>
    </div>
  </div>
</body>

</html>