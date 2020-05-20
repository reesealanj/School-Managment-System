<?php
  require "header.php";
?>
<main>
<div class="change-tbl">
  <h1>Create a New Course</h1>
  <form method="post" action="">
      <table>
          <tr>
            <th>Course ID</th>
            <td><input type="text" name="courseID"></td>
          </tr>
          <tr>
            <th>Department Name</th>
            <td><input type="text" name="deptName"></td>
          </tr>
          <tr>
            <th>Course Number</th>
            <td><input type="text" name="courseNumber"></td>
          </tr>
          <tr>
            <th>Course Name</th>
            <td><input type=text name="courseName"></td>
          </tr>
          <tr>
            <th>Day (M, T, W, R)</th>
            <td><input type="text" name="day"></td>
          </tr>
          <tr>
            <th>Start Time: (4 digits, i.e. 6pm => 1800)</th>
            <td><input type="text" name="startTime"></td>
          </tr>
          <tr>
            <th>End Time: (4 digits, i.e. 6pm => 1800)</th>
            <td><input type="text" name="endTime"></td>
          </tr>
          <tr>
            <th>Semester: (1 Character, i.e. Spring -> S)</th>
            <td><input type="text" name="semester"></td>
          </tr>
          <tr>
            <th>Credit Hours: </th>
            <td><input type="text" name="creditHrs"></td>
          </tr>
          <tr>
            <th>Section Number: </th>
            <td><input type="text" name="sectionNum"></td>
          </tr>
          <tr>
            <th>Instructor</th>
            <td><input type="text" name="instructor"></td>
          </tr>
          <tr>
            <th>Pre-requisite 1 Department Name:</th>
            <td><input type="text" name="preq1Dept"></td>
          </tr>
          <tr>
            <th>Pre-requisite 1 Course Number:</th>
            <td><input type="text" name="preq1Num"></td>
          </tr>
          <tr>
            <th>Pre-requisite 2 Department Name:</th>
            <td><input type="text" name="preq2Dept"></td>
          </tr>
          <tr>
            <th>Pre-requisite 2 Course Number:</th>
            <td><input type="text" name="preq2Num"></td>
          </tr>
          <tr>
            <th colspan='2'><button type="submit" name="Submit">Submit</button></th>
          </tr>
    </form>
</div>
<?php
  if(isset($_POST['Submit'])){
    $courseID = $_POST['courseID'];
    $deptName = $_POST['deptName'];
    $courseNumber = $_POST['courseNumber'];
    $courseName = $_POST['courseName'];
    $day = $_POST['day'];
    $startTime = $_POST['startTime'];
    $endTime =  $_POST['endTime'];
    $semester = $_POST['semester'];
    $creditHrs = $_POST['creditHrs'];
    $sectionNum = $_POST['sectionNum'];
    $instructor = $_POST['instructor'];
    $preq1Dept = $_POST['preq1Dept'];
    $preq1Num = $_POST['preq1Num'];
    $preq2Dept = $_POST['preq2Dept'];
    $preq2Num = $_POST['preq2Num'];

    $sql = "INSERT INTO course_catalog VALUES ('$courseID', '$deptName', '$courseNumber', '$courseName', '$day', '$startTime', '$endTime', '$semester', '$creditHrs', '$sectionNum', '$instructor', '$preq1Dept', '$preq1Num', '$preq2Dept', '$preq2Num')";
    $result = mysqli_query($conn, $sql);
      header('Location: newcourse.php?create=success');
      exit();
  }
?>
</main>
<?php
  require "footer.php";
?>
