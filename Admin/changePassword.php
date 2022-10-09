<?php ob_start();
include_once "connection.php";
if(!isset($_SESSION['admin_id']))
{
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
  <?php
  if (isset($_REQUEST["btn_change_pwd"])) {
    $current_pwd = $_REQUEST["current_pwd"];
    $new_pwd = $_REQUEST["new_pwd"];
    $confirm_pwd = $_REQUEST["confirm_pwd"];
    $str = "select * from tbladmin where admin_password='$current_pwd' and admin_id=" . $_SESSION['admin_id'];
    $result = mysqli_query($Cnn, $str) or die(mysqli_error($Cnn));
    if (mysqli_num_rows($result) == 1) {
      if ($new_pwd != $confirm_pwd) {
        $mesg = urlencode("New Password and Confirm Password must be same.");
        header("Location:changePassword.php?mesg=" . $mesg);
      } else {
        $strup = "update tbladmin set admin_password='$new_pwd' where admin_id=" . $_SESSION['admin_id'];
        $result = mysqli_query($Cnn, $strup) or die(mysqli_error($Cnn));
        $mesg = urlencode("Password Updated Successfully.");
        header("Location:changePassword.php?mesg=" . $mesg);
      }
    } else if($current_pwd=="" | $confirm_pwd=="" | $new_pwd=="") {
      $mesg = urlencode('All Fields are Required!');
      header("Location:changePassword.php?mesg=" . $mesg);
    }
    else{
      $mesg = urlencode('Invalid Credentials!');
      header("Location:changePassword.php?mesg=" . $mesg);
    }
  }
  ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 px-0">
      <?php include_once "nav.php"; ?>
    </div>
    <div class="col-sm-9 px-0">
      <?php include_once "_nav.php"; ?>
      <form method="post" class="mx-3 p-3 jumbotron bg-light">
        <div class="heading">
          <span class="text-center">
            <h1>
              CHANGE PASSWORD
            </h1>
          </span>
        </div>
        <br />
        <br />
        <?php
        if (isset($_GET['mesg'])) {
          echo '<div class="alert alert-info ml-5 mt-2 col-sm-6">' . $_GET["mesg"] . '</div>';
        }
        ?>
        <br />
        <div class="form-group col-sm-5">
          <label for="current_pwd"> Current Password:</label>
          <input type="password" class="form-control" name="current_pwd">
        </div>
        <br />
        <div class="form-group col-sm-5">
          <label for="new_pwd"> New Password:</label>
          <input type="password" class="form-control" name="new_pwd">
        </div>
        <br />
        <div class="form-group col-sm-5">
          <label for="confirm_pwd"> Confirm Password:</label>
          <input type="password" class="form-control" name="confirm_pwd">
        </div>
        <br />
        <div class="form-group col-sm-5">
          <div class="text-center">
            <input type="submit" class="btn btn-danger" name="btn_change_pwd" value="Change Password" />
          </div>
        </div>
    </div>
  </div>
</div>
</body>

</html>
