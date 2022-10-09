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
    .btn:hover {
      color: #0f2d4e;
    }

    .backyellow {
      background-color: #f5b819;
      color: #0f2d4e;
    }
  </style>
</head>

<body class="backyellow">
  <?php
  $str = "select * from tblregister where email_id='" . $_SESSION['user_email']."'";
  $rs = mysqli_query($Cnn, $str) or die(mysqli_error($Cnn));
  $record = mysqli_fetch_array($rs);
  if (isset($_REQUEST['btnSubmit'])) {
    $feedback = $_REQUEST['txtfeedback'];
    if ($feedback == "") {
      $msg = urlencode('Fill Required Fields!');
      header("Location:feedback.php?msg=" . $msg);
    } else {
      $id = $_SESSION['user_id'];
      $strIns = "insert into tblfeedback values(null,$id,'$feedback')";
      $rs = mysqli_query($Cnn, $strIns);
      $msg = urlencode('Thank you for your feedback!!!!');
      header("Location:feedback.php?msg=" . $msg);
    }
  }
  ?>
  <?php include_once "navbar.php"; ?>
  <div class="container-fluid ">
    <div class="row text-center">
      <div class="col-sm-12 px-0 mt-3">

        <form method="post" class="p-5 mb-3 mx-auto jumbotron" style="width:700px; background-color:#0f2d4e; color: #f5b819;">
          <h1 class="mx-auto text-center"> GIVE YOUR FEEDBACK </h1>

          <div class="form-group">
            <input type="text" class="form-control" name="txtemail" value="<?php if(isset($record)) echo $record['email_id']?>" readonly/>
          </div>
          <br />
          <div class="form-group">
            <textarea name="txtfeedback" class="form-control" id="" cols="80" rows="10" placeholder="Comments / Questions / Suggestions"></textarea>
          </div>
          <br />
          <center>
            <input type="submit" class="btn px-5" style="background-color:#f5b819; font-weight: bold;" value="SUBMIT" name="btnSubmit">
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