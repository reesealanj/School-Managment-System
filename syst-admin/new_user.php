<?php
  require "../includes/db-conn.inc.php";

  if(isset($_POST['user_submit']) || isset($_POST['stu_submit']) || isset($_POST['alum_submit']) || isset($_POST['app_submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $role = $_POST['role'];
    $program = $_POST['program'];
    $ssn =  $_POST['ssn'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $grad_year = $_POST['grad_year'];

    if(isset($_POST['user_submit']) || isset($_POST['stu_submit']) || isset($_POST['alum_submit'])){
      if(empty($fname) || empty($lname) || empty($user_id) || empty($pwd) || empty($username)){
        header("Location: newuser.php?error=missingdata");
        exit();
      }
    }
    else if(isset($_POST['app_submit'])){
      if(empty($user_id) || empty($pwd) || empty($username)){
        header("Location: newuser.php?error=missingdata");
        exit();
      }
    }
    if($role < 0 || $role > 8){
      header("Location: newuser.php?error=badrole");
      exit();
    }
    else{
      $check_query = "SELECT * FROM user WHERE user_id=" . $user_id . " OR username='" . $username . "'";
      $run_check = mysqli_query($conn, $check_query);
      $run_check_rows = mysqli_num_rows($run_check);

      if($run_check_rows != 0){
        header("Location: newuser.php?error=usertaken");
        exit();
      }
      else{
        //now start adding information to DB
        //Add them to the user table
        $user_ins = "INSERT INTO user (username, pwd, user_role, user_id) VALUES ('$username', '$pwd', '$role', '$user_id')";
        $run_user_ins = mysqli_query($conn, $user_ins);
        //Roles 0->4 and 8 are faculty members in different capacities
        if(isset($_POST['user_submit'])){
          $fac_ins = "INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES ('$user_id', '$role', '$fname', '$lname', '$email', '$street', '$city', '$state', '$country')";
          $run_fac_ins = mysqli_query($conn, $fac_ins);
          header("Location: newuser.php?create=success1");
        }
        else if(isset($_POST['stu_submit'])){
          $stu_ins = "INSERT INTO student(user_id, program, fname, lname, ssn, email, street, city, state, country) VALUES ('$user_id', '$program', '$fname', '$lname', '$ssn', '$email', '$street', '$city', '$state', '$country')";
          $run_stu_ins = mysqli_query($conn, $stu_ins);
          header("Location: newuser.php?create=success");
          exit();
        }
        else if(isset($_POST['alum_submit'])){
          $alum_ins = "INSERT INTO alumni(user_id, program, grad_year, fname, lname, email, street, city, state, country) VALUES ('$user_id', '$program', '$grad_year', '$fname', '$lname', '$email', '$street', '$city', '$state', '$country')";
          $run_alum_ins = mysqli_query($conn, $alum_ins);
          header("Location: newuser.php?create=success2");
          exit();
        }
        else if(isset($_POST['app_submit'])){
          header("Location: newuser.php?create=applicant");
          exit();
        }
      }
    }
  }
