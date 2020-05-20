<?php
  require "header.php";
  if(isset($_POST['clear-f1'])){
    $user_id = $_SESSION['user_id'];

    $remove = "DELETE FROM form1 WHERE user_id=" . $user_id;
    $run_remove = mysqli_query($conn, $remove);
    header("Location: form1.php?status=clear");
    exit();
  }
  //Don't check their information in the form1 until they have asked for it to be checked
  if(isset($_POST['submit-f1'])){
    $user = $_SESSION['user_id'];
    $get_prog = "SELECT * FROM student WHERE user_id=" . $user;
    $run_get_prog = mysqli_query($conn, $get_prog);
    $result = mysqli_fetch_assoc($run_get_prog);
    $program = $result['program'];
    if($program == 1){
      $reqs_met = 0;
      $cred_error = 0;
      $core_error = 0;
      $noncs_error = 0;
      //they are a master's student
      //Need 30 Credits
      $form1 = "SELECT * FROM form1 WHERE user_id=" . $user;
      $run_form1 = mysqli_query($conn, $form1);
      $credits = 0;
      while($row = mysqli_fetch_assoc($run_form1)){
        $dept = $row['course_dept'];
        $num = $row['course_id'];
        $cred = "SELECT course_credits FROM course_catalog WHERE course_dept='" . $dept ."' AND course_num=" . $num;
        $run_cred = mysqli_query($conn, $cred);
        $cred_res = mysqli_fetch_assoc($run_cred);
        $course_credit = $cred_res['course_credits'];
        $credits = $credits + $course_credit;
      }
      if($credits < 30){
        $cred_error = 1;
      }
      else{
        $reqs_met++;
      }
      //Need 3 Core Corses
      $core = "SELECT count(*) as core FROM form1 WHERE user_id=" . $user . " AND course_dept='CSCI' AND course_id IN (6212,6221,6461)";
      $run_core = mysqli_query($conn, $core);
      $core_result = mysqli_fetch_assoc($run_core);
      if($core_result['core'] < 3){
        $core_error = 1;
      }
      else{
        $reqs_met++;
      }
      //Can only have 3 Non-CS Courses
      $non_cs = "SELECT count(*) as non_cs FROM form1 where user_id=" . $user . " AND NOT course_dept='CSCI'";
      $run_non_cs = mysqli_query($conn, $non_cs);
      $non_cs_result = mysqli_fetch_assoc($run_non_cs);
      if($non_cs_result['non_cs'] > 3){
        $noncs_error = 1;
      }
      else{
        $reqs_met++;
      }
      if($reqs_met == 3){
        $update = "UPDATE student SET form1=1 WHERE user_id=" . $user;
        $run_update = mysqli_query($conn, $update);
        header("Location: form1.php?status=accept");
        exit();
      }
      else{
        header("Location: form1.php?error=1&ncs=".$noncs_error."&crd=".$cred_error."&cor=".$core_error);
        exit();
      }

    }
    else if($program == 2){
      $reqs_met = 0;
      $totalcred_error = 0;
      $cscred_error = 0;


      $form1 = "SELECT * FROM form1 WHERE user_id=" . $user;
      $run_form1 = mysqli_query($conn, $form1);
      $credits = 0;
      while($row = mysqli_fetch_assoc($run_form1)){
        $dept = $row['course_dept'];
        $num = $row['course_id'];
        $cred = "SELECT course_credits FROM course_catalog WHERE course_dept='" . $dept ."' AND course_num=" . $num;
        $run_cred = mysqli_query($conn, $cred);
        $cred_res = mysqli_fetch_assoc($run_cred);
        $course_credit = $cred_res['course_credits'];
        $credits = $credits + $course_credit;
      }
      if($credits < 36){
        $totalcred_error = 1;
      }
      else{
        $reqs_met++;
      }
      $form1 = "SELECT * FROM form1 WHERE course_dept='CSCI' AND user_id=" . $user;
      $run_form1 = mysqli_query($conn, $form1);
      $credits = 0;
      while($row = mysqli_fetch_assoc($run_form1)){
        $dept = $row['course_dept'];
        $num = $row['course_id'];
        $cred = "SELECT course_credits FROM course_catalog WHERE course_dept='" . $dept ."' AND course_num=" . $num;
        $run_cred = mysqli_query($conn, $cred);
        $cred_res = mysqli_fetch_assoc($run_cred);
        $course_credit = $cred_res['course_credits'];
        $credits = $credits + $course_credit;
      }
      if($credits < 30){
        $cscred_error = 1;
      }
      else{
        $reqs_met++;
      }

      if($reqs_met == 2){
        $update = "UPDATE student SET form1=1 WHERE user_id=" . $user;
        $run_update = mysqli_query($conn, $update);
        header("Location: form1.php?status=accept");
        exit();
      }
      else{
        header("Location: form1.php?error=2&csc=".$cscred_error."&crd=".$totalcred_error);
        exit();
      }

    }
  }
  require "footer.php";
?>
