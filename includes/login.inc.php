<?php
  session_start();
  require "db-conn.inc.php";

  //check that you got to the page by submitting login form
  if(isset($_POST['login-submit'])){

    $username = $_POST['username'];
    $pass = $_POST['user_pwd'];

    //check both fields have data in them
    if(empty($username) || empty($pass)){
      header("Location: ../index.php?error=emptyfield");
      exit();
    }
    else{
      //First, find what role the user is logging in as
      $role_query = "SELECT * FROM user WHERE username='" . $username . "' AND pwd=" .  "'" . $pass . "'";
      $run_role = mysqli_query($conn, $role_query);
      $check = mysqli_num_rows($run_role);
      //if there was no matching entry
      if($check == 0){
        header("Location: ../index.php?error=bad_login");
        exit();
      }
      //else they exist, get their user information
      $role_info = mysqli_fetch_assoc($run_role);
      $role = $role_info['user_role'];
      $user_id = $role_info['user_id'];

      $_SESSION['role'] = $role;
      $_SESSION['user_id'] = $user_id;
      //Now Decide how to redirect based on role
      switch($role){
        //System Administrator
        case 0:
          header("Location: ../syst-admin/index.php");
          exit();
          break;
        //Faculty Instructor
        case 1:
          header("Location: ../faculty-instructor/index.php");
          exit();
          break;
        //Faculty Reviewer
        case 2:
          header("Location: ../faculty-reviewer/index.php");
          exit();
          break;
        //Faculty Advisor
        case 3:
          header("Location: ../faculty-advisor/index.php");
          exit();
          break;
        //Graduate Secretary
        case 4:
          header("Location: ../grad-secretary/index.php");
          exit();
          break;
        //Student
        case 5:
          header("Location: ../student/index.php");
          exit();
          break;
        //Alumni
        case 6:
          header("Location: ../alumni/index.php");
          exit();
          break;
        //Applicant
        case 7:
          header("Location: ../applicant/index.php");
          exit();
          break;
        //CAC
        case 8:
          header("Location: ../faculty-cac/index.php");
          exit();
          break;
      }
    }
  }
  //Else the user did not access this page legitimately
  else{
    header("Location: ../index.php");
    exit();
  }
?>
