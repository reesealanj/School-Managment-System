<?php
  include "header.php";
?>
<main>
<div class="change-tbl">
  <h1>My Schedule</h1>
<?php

  $user_query = "";
  if(isset($_SESSION['user_id'])){
    $sid = $_SESSION['user_id'];
    $courses1 = "SELECT course_num, courseID, course_dept, course_name, day, startTime, endTime, semester, course_credits, year, grade FROM enrollment WHERE grade = 'IP' AND user_id=" .$sid;
    $run_courses1 = mysqli_query($conn, $courses1);
    echo "<table>
            <tr>
              <th>Course Number</th>
              <th>CRN</th>
              <th>DEPT</th>
              <th>Course</th>
              <th>Day</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Semester</th>
              <th>Credits</th>
              <th>Year</th>
              <th>Grade</th>
            </tr>";
    while($row = mysqli_fetch_assoc($run_courses1))
    {
      echo "<tr>";
      echo "<td>" . $row['course_num'] . "</td>";
      echo "<td>" . $row['courseID'] . "</td>";
      echo "<td>" . $row['course_dept'] . "</td>";
      echo "<td>" . $row['course_name'] . "</td>";
      echo "<td>" . $row['day'] . "</td>";
      echo "<td>" . $row['startTime'] . "</td>";
      echo "<td>" . $row['endTime'] . "</td>";
      echo "<td>" . $row['semester'] . "</td>";
      echo "<td>" . $row['course_credits'] . "</td>";
      echo "<td>" . $row['year'] . "</td>";
      echo "<td>" . $row['grade'] . "</td>";
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
