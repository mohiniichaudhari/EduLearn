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


        $str = "select f.*,r.first_name,r.last_name from tblfeedback f ,tblregister r where f.user_id=r.user_id";
        $rs = mysqli_query($Cnn, $str) or die(mysqli_error($Cnn));

        if (isset($_REQUEST["delete"])) {
            $strDel = "delete from tblfeedback where feedback_id={$_REQUEST['id']}";
            //echo $strDel;
            if ($_REQUEST["id"] == 0) {
                $msg = urlencode('Something went wrong!');
            } else {
                mysqli_query($Cnn, $strDel);
                $msg = urlencode('Feedback Deleted Successfully!');
            }
            header("Location:viewFeedback.php?msg=" . $msg);
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
                <h1 class="text-center p-4">Feedbacks</h1>
                <table class="table table-hover table-responsive ">
                    <thead class="table-dark">
                        <tr>
                            <td scope="col">Username</td>
                            <td scope="col">Feedback</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rec = mysqli_fetch_array($rs)) {
                        ?>
                            <tr>
                                <td><?php echo $rec["first_name"]." ".$rec["last_name"]; ?></td>
                                <td><?php echo $rec["feedback_desc"]; ?></td>

                                <td>
                                    <!-- Delete Button -->
                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $rec["feedback_id"]; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete" value="delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
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