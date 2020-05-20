<?php
  include "header.php";
?>
<main>
<div class="change-tbl">
  <h1>Course Catalog</h1>
  <p>You can search by any attribute of a course.</p>
  <form action="" method="post">
    <table>
      <tr>
        <td><input type="text" name="search_query"></td>
        <td><button type="submit" name="submit_search">Search</button></td>
        <td><button type="submit" name="show_all">Display All</button></td>
      </tr>
    </table>
  </form>

<?php

  $user_query = "";
  if(isset($_POST['submit_search'])){
    $user_query = $_POST['search_query'];
    $courses1 = "SELECT * FROM course_catalog WHERE courseID LIKE '%$user_query%' OR course_dept LIKE '%$user_query%' OR course_num LIKE '%$user_query%' OR course_name LIKE '%$user_query%' OR day LIKE '%$user_query%' or startTime LIKE '%$user_query%' or endTime LIKE '%$user_query%' or semester LIKE '%$user_query%' or instructor LIKE '%$user_query%' or instructor_id LIKE'%$user_query%'";
    $run_courses1 = mysqli_query($conn, $courses1);
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
  if(isset($_POST['show_all'])){
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
    $courses = "SELECT * FROM course_catalog";
    $run_courses = mysqli_query($conn, $courses);

    while($row = mysqli_fetch_assoc($run_courses))
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
