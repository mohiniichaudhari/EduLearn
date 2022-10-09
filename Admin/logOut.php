<?php
unset($_SESSION['admin_email']);
unset($_SESSION['admin_id']);
unset($_SESSION['CourseID']);
session_destroy();
header("Location:../User/index.php");
?>