<?php
  require "header.php";
  if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $department = $_GET['dep'];
    $course = $_GET['num'];

    $sel = "SELECT * FROM form1 WHERE user_id=" . $user_id . " AND course_dept='" . $department ."' AND course_id=" . $course;
    $run_sel = mysqli_query($conn, $sel);
    if(mysqli_num_rows($run_sel) > 0){
      header("Location: form1.php?error=duplicate");
      exit();
    }
    $add = "INSERT INTO form1(user_id, course_dept, course_id) VALUES (". $user_id .", '" . $department . "'," . $course .")";
    $run_rem = mysqli_query($conn, $add);
    header("Location: form1.php?add=success");
    exit();
  }
  require "footer.php";
