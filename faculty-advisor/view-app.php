<?php
  require "header.php";
?>
<main>
<?php
  if(isset($_GET['id'])){
    $sid = $_GET['id'];
    $applicant = "SELECT * FROM applicant WHERE user_id=" . $sid;
    $run_applicant = mysqli_query($conn, $applicant);
    $applicant_data = mysqli_fetch_assoc($run_applicant);

    $application = "SELECT * FROM application WHERE uid=" . $sid;
    $run_application = mysqli_query($conn, $application);
    $application_data = mysqli_fetch_assoc($run_application);

    $table = "<div class='change-tbl grid-container'><table class= 'grid-item'>";
    $table .= "<tr><th colspan = 3>Applicant Information</th></tr>";
    $table .= "<tr><th>Name: </th><td>{$applicant_data['first_name']} {$applicant_data['last_name']}</td></tr>";
    $table .= "<tr><th>Assigned ID: </th><td>{$applicant_data['user_id']}</td></tr>";
    $table .= "<tr><th>Semester of Application: </th><td>{$application_data['app_term']}</td></tr>";
    $table .= "<tr><th>Applying For: </th><td>{$application_data['degree_seeking']}</td></tr>";
    $table .= "<tr><th>Area of Interest</th><td>{$application_data['area_of_interest']}</td></tr>";
    $table .= "<tr><th>SSN: </th><td>{$application_data['ssn']}</td></tr>";
    $table .= "<tr><th>Email: </th><td>{$application_data['email']}</td></tr>";
    $table .= "<tr><th colspan=2>Applicant Address</th></tr>";
    $table .= "<tr><th>Street: </th><td>{$application_data['street']}</td></tr>";
    $table .= "<tr><th>City: </th><td>{$application_data['city']}</td></tr>";
    $table .= "<tr><th>State: </th><td>{$application_data['state']}</td></tr>";
    $table .= "</table>";
    echo $table;
    echo "<br /><br /><br />";
    $table = "<table class= 'grid-item'>";
    $table .= "<tr><th colspan = 3>Applicant Exams</th></tr><tr></tr>";
    $table .= "<tr><th colspan = 3>GRE</th></tr>";
    $table .= "<tr><th>Exam Year: </th><td>{$application_data['exam_year']}</td></tr>";
    $table .= "<tr><th>Verbal Score: </th><td>{$application_data['GRE_verbal']}</td></tr>";
    $table .= "<tr><th>Quantitative Score: </th><td>{$application_data['GRE_quantitative']}</td></tr>";
    $table .= "<tr><th colspan = 3>GRE Advanced</th></tr>";
    $table .= "<tr><th>Subject: </th><td>{$application_data['GRE_subject']}</td></tr>";
    $table .= "<tr><th>Score: </th><td>{$application_data['GRE_score']}</td></tr>";
    $table .= "<tr><th colspan = 3>TOEFL</th></tr>";
    $table .= "<tr><th>Exam Year: </th><td>{$application_data['TOEFL_year']}</td></tr>";
    $table .= "<tr><th>Score: </th><td>{$application_data['TOEFL_score']}</td></tr>";
    $table .="</table>";
    echo $table;
    echo "<br /><br /><br />";
    $table = "<table class= 'grid-item'>";
    $table .= "<tr><th colspan = 3>Education History</th></tr><tr></tr>";
    $table .= "<tr><th colspan = 3>B.S.</th></tr>";
    $table .= "<tr><th>School: </th><td>{$application_data['bachelor_school']}</td></tr>";
    $table .= "<tr><th>Graduation Year: </th><td>{$application_data['bachelor_year']}</td></tr>";
    $table .= "<tr><th>Ending GPA: </th><td>{$application_data['bachelor_gpa']}</td></tr>";
    $table .= "<tr><th>Major: </th><td>{$application_data['bachelor_major']}</td></tr>";
    $table .= "<tr><th colspan = 3>M.S.</th></tr>";
    $table .= "<tr><th>School: </th><td>{$application_data['masters_school']}</td></tr>";
    $table .= "<tr><th>Graduation Year: </th><td>{$application_data['masters_year']}</td></tr>";
    $table .= "<tr><th>Ending GPA: </th><td>{$application_data['masters_major']}</td></tr>";
    $table .= "<tr><th>Area Of Focus: </th><td>{$application_data['masters_degree']}</td></tr>";
    $table .= "</table>";
    echo $table;
    echo "<br /><br /><br />";
    $table = "<table class= 'grid-item'>";
    $table .= "<tr><th colspan = 3>Application Materials</th></tr>";
    $table .= "<tr><th>Transcript Recieved: </th><td>{$applicant_data['transcript_received']}</td></tr>";
    $table .= "<tr><th>Recommendation Letter 1 Recieved: </th><td>{$applicant_data['rec_received1']}</td></tr>";
    $table .= "<tr><th>Recommendation Letter 2 Recieved: </th><td>{$applicant_data['rec_received2']}</td></tr>";
    $table .= "<tr><th>Recommendation Letter 3 Recieved: </th><td>{$applicant_data['rec_received3']}</td></tr>";
      $recommendation = "SELECT * FROM recommendation WHERE uid=" . $sid;
      $run_recommendation = mysqli_query($conn, $recommendation);
      while($recommendation_data = mysqli_fetch_assoc($run_recommendation)){
        $table .= "<tr><th>Recommender</th><td>{$recommendation_data['rec_fname']} {$recommendation_data['rec_lname']}, {$recommendation_data['rec_title']}</td></tr>";
        $table .= "<tr><th>Recommendation Content: </th><td>{$recommendation_data['rec_letter']}</td></tr>";
      }

    $table .= "</table>";
    echo $table;
  }
  else{
    header("Location: users.php");
  }
?>
</div>
</main>
<?php
  require "footer.php";
?>
