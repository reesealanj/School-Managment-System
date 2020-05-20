<?php
  require "header.php";
?>
<main>
  <div class="change-tbl">
    <h1>Current Applicants</h1>
    <p>You can search for an applicant by name or assigned ID.<br />Clicking "Show Admitted & Accepted" displays only applicants who have been admitted and have indicated that they intend to enroll at GW (Applicants who need to be matriculated to students)<br />Clicking "Show Accepted" generates a list of all admitted students who have not been matriculated.</p>
    <form action="" method="post">
      <table>
        <tr>
          <td><input type="text" name="search"></td>
          <td><button type="submit" name="search_submit">Search</button></td>
          <td><button type="submit" name="display_all">Display All</button></td>
        </tr>
        <tr>
          <td><button type="submit" name="ana">Show Admitted & Accepted</button></td>
          <td><button type="submit" name="acc">Show Accepted</button></td>
        </tr>
      </table>
    </form>
    <br />
    <br />
    <?php
      //Decision Pending - 0
      //Admit with Aid - 1
      //Admit without Aid - 2
      //Reject - 3
      $user_query = "";
      $table = "";
      if(isset($_POST['search_submit'])){
        $user_query = $_POST['search'];
        $app = "SELECT * FROM applicant WHERE user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%' ORDER BY decision ASC";
        $run_app = mysqli_query($conn, $app);
        $table = "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Program Seeking</th><th>Application Satus</th></tr>";
        while($app_data = mysqli_fetch_assoc($run_app)){
          $stu_id = $app_data['user_id'];
          $stu_query = "SELECT * FROM application WHERE uid=" . $stu_id;
          $run_stu_query = mysqli_query($conn, $stu_query);
          $stu_data = mysqli_fetch_assoc($run_stu_query);
          $table .= "<tr><td>{$app_data['user_id']}</td><td>{$app_data['last_name']}</td><td>{$app_data['first_name']}</td><td>{$stu_data['degree_seeking']}</td>";
          $status = "";
          if($app_data['decision'] == 0){
            $status = "Pending Review";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 0){
            $status = "Admit with Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 0){
            $status = "Admit without Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 1){
            $status = "Admit with Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 1){
            $status = "Admit without Aid, Applicant has Accepted";
          }
          else if($app_data['decision'] == 3){
            $status = "Rejected";
          }
          $table .= "<td>".$status."</td>";
          $table .= "<td><a href='app-status.php?id=" . $stu_id."'>Change Status</a></td>";
          $table .= "<td><a href='app-view.php?id=" . $stu_id."'>View Application</a></td>";
          if((($app_data['decision'] == 1) || ($app_data['decision'] == 2)) && ($app_data['accept']) == 1){
            $table .= "<td><a href='matriculate.php?id=" . $stu_id."'>Matriculate</a></td>";
          }
        }
        echo $table;
      }
      else if(isset($_POST['display_all'])){
        $user_query = "";
        $app = "SELECT * FROM applicant WHERE user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%' ORDER BY decision ASC";
        $run_app = mysqli_query($conn, $app);
        $table = "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Program Seeking</th><th>Application Satus</th></tr>";
        while($app_data = mysqli_fetch_assoc($run_app)){
          $stu_id = $app_data['user_id'];
          $stu_query = "SELECT * FROM application WHERE uid=" . $stu_id;
          $run_stu_query = mysqli_query($conn, $stu_query);
          $stu_data = mysqli_fetch_assoc($run_stu_query);
          $table .= "<tr><td>{$app_data['user_id']}</td><td>{$app_data['last_name']}</td><td>{$app_data['first_name']}</td><td>{$stu_data['degree_seeking']}</td>";
          $status = "";
          if($app_data['decision'] == 0){
            $status = "Pending Review";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 0){
            $status = "Admit with Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 0){
            $status = "Admit without Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 1){
            $status = "Admit with Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 1){
            $status = "Admit without Aid, Applicant has Accepted";
          }
          else if($app_data['decision'] == 3){
            $status = "Rejected";
          }
          $table .= "<td>".$status."</td>";
          $table .= "<td><a href='app-status.php?id=" . $stu_id."'>Change Status</a></td>";
          $table .= "<td><a href='app-view.php?id=" . $stu_id."'>View Application</a></td>";
          if((($app_data['decision'] == 1) || ($app_data['decision'] == 2)) && ($app_data['accept']) == 1){
            $table .= "<td><a href='matriculate.php?id=" . $stu_id."'>Matriculate</a></td>";
          }
        }
        echo $table;
      }
      else if(isset($_POST['ana'])){
        $app = "SELECT * FROM applicant WHERE (decision=2 OR decision=1) AND accept=1";
        $run_app = mysqli_query($conn, $app);
        if(mysqli_num_rows($run_app) == 0){
          echo "<h2>No Applicants are Currently Eligible for Matriculation</h2>";
          exit();
        }
        $table = "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Program Seeking</th><th>Application Satus</th></tr>";
        while($app_data = mysqli_fetch_assoc($run_app)){
          $stu_id = $app_data['user_id'];
          $stu_query = "SELECT * FROM application WHERE uid=" . $stu_id;
          $run_stu_query = mysqli_query($conn, $stu_query);
          $stu_data = mysqli_fetch_assoc($run_stu_query);
          $table .= "<tr><td>{$app_data['user_id']}</td><td>{$app_data['last_name']}</td><td>{$app_data['first_name']}</td><td>{$stu_data['degree_seeking']}</td>";
          $status = "";
          if(($app_data['decision'] == 1) && ($app_data['accept']) == 1){
            $status = "Admit with Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 0){
            $status = "Admit with Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 1){
            $status = "Admit without Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 0){
            $status = "Admit without Aid, Applicant has not Accepted";
          }
          else if($app_data['decision'] == 3){
            $status = "Rejected";
          }
          $table .= "<td>".$status."</td>";
          $table .= "<td><a href='app-status.php?id=" . $stu_id."'>Change Status</a></td>";
          $table .= "<td><a href='app-view.php?id=" . $stu_id."'>View Application</a></td>";
          if((($app_data['decision'] == 1) || ($app_data['decision'] == 2)) && ($app_data['accept']) == 1){
            $table .= "<td><a href='matriculate.php?id=" . $stu_id."'>Matriculate</a></td>";
          }
        }
        echo $table;
      }
      else if(isset($_POST['acc'])){
        $app = "SELECT * FROM applicant WHERE (decision=2 OR decision=1)";
        $run_app = mysqli_query($conn, $app);
        if(mysqli_num_rows($run_app) == 0){
          echo "<h2>No Applicants Have Been Admitted Currently</h2>";
          exit();
        }
        $table = "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Program Seeking</th><th>Application Satus</th></tr>";
        while($app_data = mysqli_fetch_assoc($run_app)){
          $stu_id = $app_data['user_id'];
          $stu_query = "SELECT * FROM application WHERE uid=" . $stu_id;
          $run_stu_query = mysqli_query($conn, $stu_query);
          $stu_data = mysqli_fetch_assoc($run_stu_query);
          $table .= "<tr><td>{$app_data['user_id']}</td><td>{$app_data['last_name']}</td><td>{$app_data['first_name']}</td><td>{$stu_data['degree_seeking']}</td>";
          $status = "";
          if(($app_data['decision'] == 1) && ($app_data['accept']) == 1){
            $status = "Admit with Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 1) && ($app_data['accept']) == 0){
            $status = "Admit with Aid, Applicant has not Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 1){
            $status = "Admit without Aid, Applicant has Accepted";
          }
          else if(($app_data['decision'] == 2) && ($app_data['accept']) == 0){
            $status = "Admit without Aid, Applicant has not Accepted";
          }
          else if($app_data['decision'] == 3){
            $status = "Rejected";
          }
          $table .= "<td>".$status."</td>";
          $table .= "<td><a href='app-status.php?id=" . $stu_id."'>Change Status</a></td>";
          $table .= "<td><a href='app-view.php?id=" . $stu_id."'>View Application</a></td>";
          if((($app_data['decision'] == 1) || ($app_data['decision'] == 2)) && ($app_data['accept']) == 1){
            $table .= "<td><a href='matriculate.php?id=" . $stu_id."'>Matriculate</a></td>";
          }
        }
        echo $table;
      }
    ?>
