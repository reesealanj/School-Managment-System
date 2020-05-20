<?php
  include "header.php";
?>
<main>
<div class="change-tbl">
  <h1>My Course Catalog</h1>
<?php

  $user_query = "";
  if(isset($_SESSION['user_id'])){
    $inst_id = $_SESSION['user_id'];
    $courses1 = "SELECT * FROM course_catalog WHERE instructor_id=" .$inst_id;
    $run_courses1 = mysqli_query($conn, $courses1);
    $rows = mysqli_num_rows($run_courses1);
    if($rows == 0){
      echo "<h1>You are not listed as the instructor for any courses at this time.</h1>";
      exit();
    }
    echo "<table>
            <tr>
              <th>CRN</th>
              <th>DEPT</th>
              <th>Course</th>
              <th>Title</th>
              <th>Section</th>
              <th>Credits</th>
              <th>Semester</th>
              <th>Day</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Instructor</th>
              <th>Pre-requisite 1 Dept</th>
              <th>Pre-requisite 1 Num</th>
              <th>Pre-requisite 2 Dept</th>
              <th>Pre-requisite 2 Num</th>
            </tr>";
    while($row = mysqli_fetch_assoc($run_courses1))
    {
      echo "<tr>";
      echo "<td>" . $row['courseID'] . "</td>";
      echo "<td>" . $row['course_dept'] . "</td>";
      echo "<td>" . $row['course_num'] . "</td>";
      echo "<td>" . $row['course_name'] . "</td>";
      echo "<td>" . $row['sectionNum'] . "</td>";
      echo "<td>" . $row['course_credits'] . "</td>";
      echo "<td>" . $row['semester'] . "</td>";
      echo "<td>" . $row['day'] . "</td>";
      echo "<td>" . $row['startTime'] . "</td>";
      echo "<td>" . $row['endTime'] . "</td>";
      echo "<td>" . $row['instructor'] . "</td>";
      echo "<td>" . $row['preq1Dept'] . "</td>";
      echo "<td>" . $row['preq1Num'] . "</td>";
      echo "<td>" . $row['preq2Dept'] . "</td>";
      echo "<td>" . $row['preq2Num'] . "</td>";
      echo "<td><a href='course_det.php?id=" .$row['courseID']. "'>Details</a></td>";
      echo "</tr>";
    }
      echo "</table>";
  }
?>
</div>
</main>
<?php
  require "footer.php";
?>
