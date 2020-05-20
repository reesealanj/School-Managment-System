<?php
  require "header.php";
?>
<main>
  <div class="change-tbl">
  <h1>Grade Submission</h1>
  <?php
    if(isset($_GET['cid']) && isset($_GET['sid'])){
      $form = "<form action = '' method = 'post'><table>";
      $course = $_GET['cid'];
      $student = $_GET['sid'];
      $course_query = "SELECT * FROM course_catalog WHERE courseID=" . $course;
      $run_course_query = mysqli_query($conn, $course_query);
      $course_data = mysqli_fetch_assoc($run_course_query);

      $student_query = "SELECT * FROM student WHERE user_id=" . $student;
      $run_student_query = mysqli_query($conn, $student_query);
      $student_data = mysqli_fetch_assoc($run_student_query);

      $enroll_query = "SELECT grade FROM enrollment WHERE user_id=" . $student ." AND courseID=" . $course;
      $run_enroll_query = mysqli_query($conn, $enroll_query);
      $enrollment_data = mysqli_fetch_assoc($run_enroll_query);

      $form .= "<tr><th>Course: </th></tr><tr><td>{$course_data['course_dept']} {$course_data['course_num']},{$course_data['course_name']}</td></tr>";
      $form .= "<tr><th>Student: </th></tr><tr><td>{$student_data['fname']} {$student_data['lname']} (ID: {$student_data['user_id']})</td></tr><tr><td>Current Grade: {$enrollment_data['grade']}</td></tr>";
      $form .= "</table>";
      $form .= "<br /><br /><br /><br />";
      $form .= "<table><tr><th colspan=11>Select Final Grade</th></tr>";
      $form .= "<tr><td><input type='radio' name='grade' value='IP'>IP</td><td><input type='radio' name='grade' value='A'>A</td><td><input type='radio' name='grade' value='A-'>A-</td><td><input type='radio' name='grade' value='B+'>B+</td><td><input type='radio' name='grade' value='B'>B</td><td><input type='radio' name='grade' value='B-'>B-</td><td><input type='radio' name='grade' value='C+'>C+</td><td><input type='radio' name='grade' value='C'>C</td><td><input type='radio' name='grade' value='C-'>C-</td><td><input type='radio' name='grade' value='F'>F</td><td><input type='radio' name='grade' value='W'>W</td></tr>";
      $form .= "<tr><th colspan=11><button type='submit' name='grade-submit'>Submit</button></th></tr>";
      $form .= "</table></form>";
      echo $form;
    }
    else{
      header("Location: courses.php");
      exit();
    }
    if(isset($_POST['grade-submit'])){
      $grade = $_POST['grade'];
      $course = $_GET['cid'];
      $student = $_GET['sid'];

      $grade_query = "UPDATE enrollment SET grade='" . $grade . "' WHERE user_id=" . $student . " AND courseID=" . $course;
      $run_grade_query = mysqli_query($conn, $grade_query);
      header("Location: chgrade.php?cid=" . $course . "&sid=" . $student);
      exit();
    }

  ?>
</div>
</main>
<?php
  require "footer.php";
?>
