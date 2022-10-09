<?php
ob_start();
include_once "connection.php";
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
      <div class="col-sm-3 p-0">
        <?php
        include_once "nav.php";
        ?>
      </div>
      <?php
      if (isset($_GET['DelID'])) {
        // echo "Hii";
        $strDel = "delete from tbltopic where topic_id=" . $_GET['DelID'];
        mysqli_query($Cnn, $strDel) or die(mysqli_error($Cnn));
        $msg = urlencode("Record Deleted Successfully.");
        header("Location:viewTopics.php?msg=" . $msg);
      }
      ?>
      <div class="col-sm-9 px-0">
        <?php
        include_once "_nav.php";
        ?>
        <div class="container-fluid  mt-5 pe-5">
          <div class="heading text-center">
            <span>
              <h1>View Topic</h1>
            </span>
          </div>
          <form action="" method="post" enctype="multipart/form-data" class="form-inline">
            <div class="row">
              <div class="col-sm-3">
                <label for="course_id"> Select Course :</label>
                <select class="form-control" name="fetchTopic" id="fetchTopic">
                  <option selected disabled>Select Course</option>
                  <?php
                  $str = "Select * from tblcourse";
                  $res = mysqli_query($Cnn, $str);
                  if (mysqli_num_rows($res) > 0) {
                    while ($rec = mysqli_fetch_array($res)) {

                  ?>
                      <option value="<?php echo $rec["course_id"] ?>"><?php echo $rec["course_name"]; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </form>
          <br />
          <div class="container" id="viewtopic">
            <?php
            if (isset($_GET['msg'])) {
              echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
            }
            ?>
            <table class="table table-hover table-responsive caption-top">
              <caption class="text-center">
                <!-- <h3>table name</h3> -->
              </caption>
              <thead class="table-dark">
                <tr>
                  <td scope="col">Topic_name</td>
                  <td scope="col">Topic_desc</td>
                  <td scope="col">Topic_url</td>
                  <td scope="col">Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $str = "select * from tbltopic";
                $res = mysqli_query($Cnn, $str);
                while ($rec = mysqli_fetch_array($res)) {
                  // $str="select * from tbltopic";
                ?>
                  <tr>
                    <td><?php echo $rec['topic_name'] ?></td>
                    <td><?php echo $rec['topic_desc'] ?></td>
                    <td><?php echo $rec['topic_url'] ?></td>
                    <td>
                      <!-- update Button -->
                      <a href="?TopicID=<?php echo $rec["topic_id"]; ?>" class="btn btn-success mr-3" name="view" value="view">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <!-- Delete Button -->
                      <a href="?DelID=<?php echo $rec["topic_id"]; ?>" class="btn btn-danger mr-3" name="delete" value="delete">
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
<script>
  $(document).ready(function() {
    $("#fetchTopic").on('change', function() {
      var value = $(this).val();
      //alert(value);
      $.ajax({
        url: "view.php",
        type: "POST",
        data: "request=" + value,
        // beforeSend: function() {
        //     $(".container").html("<span>Working....</span>");
        // },
        success: function(data) {
          $("#viewtopic").html(data);
        }

      });
    });
  });
</script>

</html>