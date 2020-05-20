<?php
  require "header.php";
?>
<main>
<div class="change-tbl">
<?php
  echo "<h1>Applicant Matriculation</h1>";
  echo "<p>Clicking 'Matriculate' will confirm the Student's Matriculation and copy their data over to the student section, and they will function as a student, not an applicant</p>";
  if(isset($_GET['id'])){
    $user = $_GET['id'];
    $applicant = "SELECT * FROM applicant WHERE user_id=" . $user;
    $application = "SELECT * FROM application WHERE uid=" . $user;
    $run_applicant = mysqli_query($conn, $applicant);
    $run_application = mysqli_query($conn, $application);
    $applicant_res = mysqli_fetch_assoc($run_applicant);
    $application_res = mysqli_fetch_assoc($run_application);
    $table = "<form method='post' action=''>";
    $table .= "<table><tr><th>Applicant: </th><td>{$applicant_res['first_name']} {$applicant_res['last_name']}</td></tr>";
    $table .="<tr><th>Assigned ID: </th><td>{$applicant_res['user_id']}</td></tr>";
    $table .="<tr><th colspan='2'><button type='submit' name='mat-submit'>Matriculate</button></th></tr>";
    echo $table;
  }
  if(isset($_GET['mat'])){
    echo "<h2 style='color:green'>Applicant Successfully Matriculated</h2>";
  }
  if(isset($_POST['mat-submit'])){
    $multi = "";
    $user = $_GET['id'];
    $applicant = "SELECT * FROM applicant WHERE user_id=" . $user;
    $application = "SELECT * FROM application WHERE uid=" . $user;
    $run_applicant = mysqli_query($conn, $applicant);
    $run_application = mysqli_query($conn, $application);
    $applicant_res = mysqli_fetch_assoc($run_applicant);
    $application_res = mysqli_fetch_assoc($run_application);
    $fname = $applicant_res['first_name'];
    $lname = $applicant_res['last_name'];
    $ssn = $application_res['ssn'];
    $street = $application_res['street'];
    $city = $application_res['city'];
    $state = $application_res['state'];
    $temp_prog = $application_res['degree_seeking'];
    $program = 0;
    if($temp_prog= "MS"){
      $program = 1;
    }
    else if($temp_prog="PHD"){
      $program = 2;
    }

    $multi .= "UPDATE user SET user_role=5 WHERE user_id=" . $user.";";
    $multi .= "INSERT INTO student(user_id, program, fname, lname, email, street, city, state, ssn, reg_hold) VALUES ('$user', '$program', '$fname', '$lname', '$email', '$street', '$city', '$state', '$ssn', 1);";
    $multi .= "DELETE FROM application WHERE uid=" . $user.";";
    $multi .= "DELETE FROM applicant WHERE user_id=" . $user.";";
    mysqli_multi_query($conn, $multi);
    header("Location: matriculate.php?mat=success");
    exit();
  }
?>
</div>
</main>
<?php
  require "footer.php";
?>
