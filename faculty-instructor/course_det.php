<?php
  require "header.php";

  if(isset($_GET['id'])){
    $crn = $_GET['id'];
    $course = "SELECT * FROM course_catalog WHERE courseID=" . $crn;
    $run_course = mysqli_query($conn, $course);
    if(mysqli_num_rows($run_course) == 0){
      header("Location: courses.php?error=badlink");
    }
    $data = mysqli_fetch_assoc($run_course);
    echo "<main><div class='change-tbl'><h1>Course Information</h1>";
    $table = "<table>";
    $table .= "<tr><th>{$data['course_dept']} {$data['course_num']}, {$data['course_name']}</th></tr>";
    $table .= "<tr><td>Instructor: {$data['instructor']} (ID: {$data['instructor_id']})</td></tr>";
    $table .= "<tr><td>Credit Hours: {$data['course_credits']}</td></tr>";
    $table .= "<tr></tr>";
    $table .= "<tr><th>Meeting Information</th></tr>";
    $table .= "<tr><td>{$data['day']}: {$data['startTime']}-{$data['endTime']}</td></tr>";
    $table .= "<tr><td>Semester: {$data['semester']}</td></tr>";
    echo $table;
    echo "</table>";
    $roster = "SELECT * FROM enrollment WHERE courseID=" . $crn . " AND user_id NOT IN (SELECT user_id FROM alumni)";
    $run_roster = mysqli_query($conn, $roster);
    $stu_num = mysqli_num_rows($run_roster);
    echo "<h1>Course Roster</h1>";
    echo "<h3>Total Students Enrolled: " . $stu_num . "</h3>";
    echo"<table>";
    echo "<tr><th>Last Name</th><th>First Name</th><th>User ID</th><th>Grade</th></tr>";

    while($data = mysqli_fetch_assoc($run_roster)){
      $sid = $data['user_id'];
      $stu_name = "SELECT * FROM student WHERE user_id=" .$sid;
      $run_stu = mysqli_query($conn, $stu_name);
      $stu_data = mysqli_fetch_assoc($run_stu);
      $row = "<tr><td>{$stu_data['lname']}</td><td>{$stu_data['fname']}</td>";
      $row .= "<td>".$sid."</td>";
      $row .= "<td>{$data['grade']}</td>";
        if($data['grade'] == 'IP'){
          $row .= "<td><a href=chgrade.php?cid=" . $crn . "&sid=" . $sid .">Edit Grade</a></td>";
        }
      $row .= "<td><a href=view-stu.php?cid=" . $crn . "&id=" . $sid .">Transcript</a></td>";
      $row .= "</tr>";
      echo $row;
    }
    echo "</table></div></main>";
  }
  else{
    header("Location: courses.php");
    exit();
  }
