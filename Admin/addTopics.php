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

</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 px-0">
            <?php include_once "nav.php"; ?>
        </div>
        <?php

        if (isset($_REQUEST["btn_addTopic"])) {

            $topic_name = $_REQUEST["topic_name"];
            $topic_desc = $_REQUEST["topic_desc"];
            $topic_url = $_REQUEST["topic_url"];
            echo $course_id = filter_input(INPUT_POST, 'course_id');
            if ($topic_name == "" | $topic_desc == "" | $topic_url == "") {
                $msg = '<div class="alert alert-warning ml-5 mt-2 col-sm-12">All Fields Required!</div>';
            } else {
                $strIns = "insert into tbltopic values (null,'$topic_name','$topic_desc',$course_id,'$topic_url')";
                mysqli_query($Cnn, $strIns);
                $msg = '<div class="alert alert-success ml-5 mt-2 col-sm-12">Topic Added Successfully!</div>';
            }
        }
        ?>
        <div class="col-sm-9 px-0">
            <?php include_once "_nav.php"; ?>
            <form method="POST" enctype="multipart/form-data" class="mx-3 p-3 jumbotron bg-light">
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-info ml-5 mt-2 col-sm-12">' . $_GET['msg'] . '</div>';
                }
                ?>
                <div class="heading text-center">
                    <span>
                        <h1>Add Topic</h1>
                    </span>
                </div>
                <br />
                <div class="form-group">
                    <label for=" topic_name">Topic Name :</label>
                    <input type="text" class="form-control" name="topic_name" aria-describedby=" topicname" placeholder="Enter Name of Topic">
                </div>
                <br />
                <div class="form-group">
                    <label for=" topic_desc"> Topic Description :</label>
                    <textarea class="form-control" name="topic_desc" rows="3" placeholder="Enter Topic Description"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="course_id"> Select Course :</label>
                    <select class="form-control" name="course_id">
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
                <br />
                <div class="form-group">
                    <label for=" topic_url"> Topic URL :</label>
                    <input type="text" class="form-control" name="topic_url" placeholder="Enter URL">
                </div>
                <br />
                <div class="text-center">
                    <input type="submit" class="btn btn-danger" name="btn_addTopic" value="ADD TOPIC" />
                </div>


            </form>
        </div>
    </div>
</div>
</body>

</html>