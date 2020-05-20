<?php

	require "header.php";
?>

<main>
<div class="change-tbl">
<h1>Course Registration</h1>
<p>Register for a course you wish to register for</p>
<?php
	$user = $_SESSION['user_id'];
	$query = "SELECT reg_hold FROM student WHERE user_id=" . $user;
	$usr_query = mysqli_query($conn, $query);
	$result = mysqli_fetch_assoc($usr_query);
	if($result['reg_hold'] == 1){
		echo "<h2>You currently have a Registration Hold!</h2><h4>In order to register for courses you must submit an advising form and your advisor must approve it!</h4>";
		exit();
	}

	$courses = "SELECT * FROM course_catalog";
	$run_courses = mysqli_query($conn, $courses);
	$table = "<table><tr><th>CRN</th><th>Course Number</th><th>Course Name</th></tr>";
	while($row = mysqli_fetch_assoc($run_courses)){
		$table .= "<tr><td>{$row['courseID']}</td><td>{$row['course_dept']} {$row['course_num']}</td><td>{$row['course_name']}</td></tr>";
	}
	$table .= "</table>";
	echo $table;
?>
  <form method="post" action="?php echo htmlspecialchars($_SERVER["PHP_SELF"]);">

      <label for="searchbar">Enter course ID: </label> <br />

      <input type="text" name="searchbar" required>
      <br>

      <input type="submit" value="Register" name="submit" />

    </form> <br/> <br/>

  <?php
	if(isset($_SESSION['user_id'])){
		$sid = $_SESSION['user_id'];
    $searchTerm = $_POST["searchbar"];

      if($_SERVER[REQUEST_METHOD] == "POST")
      {
          $sql = "SELECT course_dept, course_num, course_name, semester, startTime, day, endTime, course_credits, preq1Dept, preq1Num, preq2Dept, preq2Num FROM course_catalog WHERE courseID = '$searchTerm' ";
          $result = $conn->query($sql);

          $check = "SELECT * FROM enrollment WHERE courseID = '$searchTerm' AND user_id = '$sid'";
          $checkRes = $conn->query($check);

          if($searchTerm > 0 && $searchTerm <= 22)
          {
            if(mysqli_fetch_array($checkRes)==0)
            {
              $row = mysqli_fetch_array($result);

              $time = "SELECT startTime FROM enrollment WHERE startTime = '$row[startTime]' AND day = '$row[day]' AND user_id = '$sid'";
              $checkTime = $conn->query($time);

              if(mysqli_fetch_array($checkTime)==0)
              {
                $pre1 = "SELECT * FROM course_catalog WHERE courseID = '$searchTerm' AND preq1Dept = 'None' AND preq2Dept = 'None'";
                $pre1Check = $conn->query($pre1);


                if(mysqli_fetch_array($pre1Check) != 0)
                {
                  $sql2 = "INSERT INTO enrollment VALUES ('$sid', '$row[course_num]', '$searchTerm', '$row[course_dept]', '$row[course_name]', '$row[startTime]', '$row[endTime]', '$row[day]', '$row[semester]', '$row[course_credits]', '2019', 'IP', NULL)";
                  $result2 = $conn->query($sql2);
                  echo "Successfully Registered";
                }

                else
                {
                  $pre2 = "SELECT * FROM course_catalog WHERE courseID = '$searchTerm' AND preq1Dept != 'None' AND preq2Dept = 'None'";
                  $pre2Check = $conn->query($pre2);

                  if(mysqli_fetch_array($pre2Check) != 0)
                  {
                    $pre3 = "SELECT * FROM enrollment WHERE user_id = '$sid' AND course_dept = '$row[preq1Dept]' AND course_num = '$row[preq1Num]' AND grade != 'IP'";
                    $pre3Check = $conn->query($pre3);
                    if(mysqli_fetch_array($pre3Check) != 0)
                      {
                        $sql2 = "INSERT INTO enrollment VALUES ('$sid', '$row[course_num]', '$searchTerm', '$row[course_dept]', '$row[course_name]', '$row[startTime]', '$row[endTime]', '$row[day]', '$row[semester]', '$row[course_credits]', '2019', 'IP', NULL)";

                        $result2 = $conn->query($sql2);

                        echo "Successfully Registered";
                      }
                      else
                      {
                        echo "You do not have the required prequisites!";
                      }
                  }
                  else
                  {
                    $pre4 = "SELECT * FROM enrollment WHERE user_id = '$sid' AND course_dept = '$row[preq1Dept]' AND course_num = '$row[preq1Num]' AND grade != 'IP'";
                    $pre4Check = $conn->query($pre4);

                    $pre5 = "SELECT * FROM enrollment WHERE user_id = '$sid' AND course_dept = '$row[preq2Dept]' AND course_num = '$row[preq2Num]' AND grade != 'IP'";
                    $pre5Check = $conn->query($pre5);

                      if(mysqli_fetch_array($pre4Check) != 0 && mysqli_fetch_array($pre5Check))
                      {
                        $sql2 = "INSERT INTO enrollment VALUES ('$sid', '$row[course_num]', '$searchTerm', '$row[course_dept]', '$row[course_name]', '$row[startTime]', '$row[endTime]', '$row[day]', '$row[semester]', '$row[course_credits]', '2019', 'IP', NULL)";

                        $result2 = $conn->query($sql2);

                        echo "Successfully Registered";
                      }
                      else
                      {
                        echo "You do not have the required prequisites!";
                      }
                  }
                }


              }
              else
              {
                echo "Already registered for a class at that time!";
              }

            }
            else
            {
              echo "Already Registered for that Course!";
            }
          }
          else
          {
            echo "Invalid Course ID";
          }

      }

}
  ?>

</body>
</html>
