<?php
  require "header.php";
  if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $department = $_GET['dep'];
    $course = $_GET['num'];

    $rem = "DELETE FROM form1 WHERE user_id=" . $user_id ." AND course_dept='".$department."' AND course_id=".$course;
    $run_rem = mysqli_query($conn, $rem);
    header("Location: form1.php?remove=success");
    exit();
  }
  require "footer.php";
