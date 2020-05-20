<?php
  include "header.php";
?>
<main>
  <div class="change-tbl">
  <h1>Update Application Status</h1>
<?php
  if(isset($_GET['id'])){
    $stu = $_GET['id'];
    $stu_query = "SELECT * FROM applicant WHERE user_id=" . $stu;
    $run_stu_query = mysqli_query($conn, $stu_query);
    $data = mysqli_fetch_assoc($run_stu_query);
    $table = "<form action='' method='post'><table>";
    $table .= "<tr><th>Applicant</th></tr>";
    $table .= "<tr><td style='text-align:left'>Name: {$data['last_name']},{$data['first_name']}</td></tr>";
    $table .= "<tr><td style='text-align:left'>Assigned ID: {$data['user_id']}</td></tr>";
    $table .= "<tr><td style='text-align:left'>Current Application Status: ";
    $status = "";
    if($data['decision'] == 0){
      $status = "Pending Review";
    }
    else if(($data['decision'] == 1) && ($data['accept']) == 0){
      $status = "Admit with Aid, Student has not Accepted Yet";
    }
    else if(($data['decision'] == 2) && ($data['accept']) == 0){
      $status = "Admit without Aid, Student has not Accepted Yet";
    }
    else if(($data['decision'] == 2) && ($data['accept']) == 2){
      $status = "Admit without Aid, Student has Declined Offer";
    }
    else if(($data['decision'] == 1) && ($data['accept']) == 1){
      $status = "Admit with Aid, Student has Accepted";
    }
    else if(($data['decision'] == 2) && ($data['accept']) == 1){
      $status = "Admit without Aid, Student has Accepted";
    }
    else if(($data['decision'] == 1) && ($data['accept']) == 1){
      $status = "Admit with Aid, Student has Declined Offer";
    }
    else if($data['decision'] == 3){
      $status = "Rejected";
    }
    $table .= $status . "</td></tr></table><table><br /><br /><br /><br />";

    $table .= "<tr><th colspan= 4>Select New Application Status</th></tr>";
    $table .= "<tr><td><input type='radio' name='newstat' value='0'>Pending Review</td><td><input type='radio' name='newstat' value='1'>Admit With Aid</td><td><input type='radio' name='newstat' value='2'>Admit Without Aid</td><td><input type='radio' name='newstat' value='3'>Reject</td></tr>";
    $table .= "<tr><th colspan=4><button type='submit' name='submitchange'>Submit Change</button></th></tr>";
    $table .="</table></form>";
    echo $table;
  }
  if(isset($_POST['submitchange'])){
    $stu= $_GET['id'];
    $stat = $_POST['newstat'];

    $stuQuery = "SELECT * FROM applicant WHERE user_id=" . $stu;
    $run_stu = mysqli_query($conn, $stuQuery);
    $data = mysqli_fetch_assoc($run_stu);
    if($data['accept'] == 1){
      header("Location: app-status.php?id=" . $stu . "&error=toolate");
      exit();
    }
    else{
      $upd = "UPDATE applicant SET decision=" . $stat . " WHERE user_id=" . $stu;
      $run_upd = mysqli_query($conn, $upd);
      header("Location: app-status.php?id=" . $stu);
      exit();
    }
  }
?>
</main>
<?php
  include "footer.php";
?>
