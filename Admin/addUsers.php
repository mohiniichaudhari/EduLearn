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
    if (isset($_SESSION["UserID"])) {
      $strUp = "select * from tblregister where User_id={$_SESSION["UserID"]}";
      $rs = mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
      $req = mysqli_fetch_array($rs);
    }
    if (isset($_REQUEST["btn_addUser"])) {
      $first_name = $_REQUEST["first_name"];
      $last_name = $_REQUEST["last_name"];
      $email_id = $_REQUEST["email_id"];
      $password = $_REQUEST["password"];
      $contact = $_REQUEST["contact"];
      if ($first_name == "" | $email_id == "" | $password == "" | $contact == ""  | $last_name == "") {
        $msg = urlencode('All Fields are Required!');
        header("Location:addUsers.php?msg=" . $msg);
      }
      //checking if the update id is set or not and if it is not set, let's insert 
      else if (!isset($_SESSION["UserID"])) {
        $strIns = "insert into tblregister(first_name,last_name,email_id,password,contact_no,status) values ('$first_name','$last_name','$email_id','$password','$contact',1)";
        mysqli_query($Cnn, $strIns) or die(mysqli_error($Cnn));
        $msg = urlencode('User Added Successfully!');
        header("Location:addUsers.php?msg=" . $msg);
      } else {
        $strUp = "update tblregister set first_name='$first_name',last_name='$last_name',email_id='$email_id',password='$password',contact_no='$contact' where user_id={$_SESSION["UserID"]}";
        mysqli_query($Cnn, $strUp) or die(mysqli_error($Cnn));
        $msg = urlencode('User Updated Successfully!');
        header("Location:viewUsers.php?msg=" . $msg);
      }
    }

    ?>
    <div class="col-sm-9 px-0">
      <?php include_once "_nav.php"; ?>
      <form method="post" enctype="multipart/form-data" class="mx-3 p-3 jumbotron bg-light">
        <div class="heading">
          <span class="text-center">
            <h1>
              <?php if (isset($_SESSION["UserID"])) {
                echo "Update User";
              } else {
                echo "Add User";
              } ?></h1>
          </span>
        </div>
        <br />
        <div class="form-group">
          <label for="first_name">First Name :</label>
          <input type="text" class="form-control" name="first_name" value="<?php if (isset($req)) echo $req['first_name']; ?>" placeholder="Enter First Name of User">
        </div>
        <br />
        <div class="form-group">
          <label for="last_name">Last Name :</label>
          <input type="text" class="form-control" name="last_name" value="<?php if (isset($req)) echo $req['last_name']; ?>" placeholder="Enter last Name of User">
        </div>
        <br />
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" name="email_id" value="<?php if (isset($req)) echo $req['email_id']; ?>" aria-describedby="email" placeholder="Enter Email ID of User">
        </div>
        <br />
        <div class="form-group">
          <label for="password">Password :</label>
          <input type="password" class="form-control" name="password" value="<?php if (isset($req)) echo $req['password']; ?>" aria-describedby="password" placeholder="Enter Password of User">
        </div>
        <br />
        <div class="form-group">
          <label for="contact">Contact :</label>
          <input type="text" class="form-control" name="contact" value="<?php if (isset($req)) echo $req['contact_no']; ?>" aria-describedby="contact" placeholder="Enter Contact Number of User">
        </div>
        <br />

        <div class="text-center">
          <input type="submit" class="btn btn-danger" name="btn_addUser" value='<?php if (isset($_SESSION["UserID"])) {
                                                                                  echo "UPDATE USER";
                                                                                } else {
                                                                                  echo "ADD USER";
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