<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Advising Form</h1>
<?php
	if(isset($_GET['status'])){
		if($_GET['status'] == "clear"){
			echo "<h2 style='color:red'>Your Advising Form Has Been Cleared</h2>";
		}
    if($_GET['status'] == "submitted"){
      echo "<h2 style='color:green'>Your Advising Form Has Been Submitted</h2>";
    }
	}
	$user = $_SESSION['user_id'];
	$user_query = "SELECT * FROM student WHERE user_id=" . $user;
	$run_user = mysqli_query($conn, $user_query);
	$result = mysqli_fetch_assoc($run_user);
	if($result['form1'] == 0){
		echo "<p>You may add up to 12 courses to your Advising Form by searching and clicking *add* below. <br />Note that your Form 1 will NOT be submitted and checked until you add your courses to the form and click *submit*</p>
		<form action='' method='post'>
			<table>
				<tr>
					<td><input type='text' name='search_query'></td>
					<td><button type='submit' name='course-search'>Search Courses</button></td>
					<td><button type='submit' name='show-all'>Display All</button></td>
				</tr>
			</table>
		</form>";
	}
  else if($result['reg_hold'] == 0){
    echo "<h2 style='color:green'>Your Advising Form Has Been Accepted</h2>";
		exit();
  }
?>

<?php
  if(isset($_POST['course-search'])){
    $user_query = $_POST['search_query'];
    $user = $_SESSION['user_id'];
    $courses1 = "SELECT * FROM course_catalog WHERE course_dept LIKE '%$user_query%' OR course_num LIKE '%$user_query%' OR course_name LIKE '%$user_query%'";
    $run_courses = mysqli_query($conn, $courses1);
    if(mysqli_num_rows($run_courses) > 0){
      $table = "<table><tr><th>Course Number</th><th>Course Title</th><th>Course Grade</th></tr>";
      while($course = mysqli_fetch_assoc($run_courses)){
        $table .= "<tr><td>{$course['course_dept']} {$course['course_num']}</td><td>{$course['course_name']}</td><td><a href='adda.php?id=". $user ."&dep=".$course['course_dept']."&num=".$course['course_num']."'>Add</a></td></tr>";
      }
      $table .= "</table>";
      echo $table;
    }
    else{
      echo "<h1>You have not completed any courses matching that search</h1>";
    }
  }
  if(isset($_POST['show-all'])){
    $user_query = "";
    $user = $_SESSION['user_id'];
    $courses1 = "SELECT * FROM course_catalog WHERE course_dept LIKE '%$user_query%' OR course_num LIKE '%$user_query%' OR course_name LIKE '%$user_query%'";
    $run_courses = mysqli_query($conn, $courses1);
    if(mysqli_num_rows($run_courses) > 0){
      $table = "<table><tr><th>Course Number</th><th>Course Title</th><th>Course Grade</th></tr>";
      while($course = mysqli_fetch_assoc($run_courses)){
        $table .= "<tr><td>{$course['course_dept']} {$course['course_num']}</td><td>{$course['course_name']}</td><td><a href='adda.php?id=". $user ."&dep=".$course['course_dept']."&num=".$course['course_num']."'>Add</a></td></tr>";
      }
      $table .= "</table>";
      echo $table;
    }
    else{
      echo "<h1>You have not completed any courses matching that search</h1>";
    }
  }
?>
<?php
	if(isset($_GET['add'])){
		if($_GET['add'] == "success"){
			echo "<h2 style='color:green'>Course Added your Advising Form!</h2>";
		}
	}
	if(isset($_GET['error'])){
		if($_GET['error'] == "duplicate"){
			echo "<h2 style='color:red'>That Course is Already On Your Advising Form!</h2>";
		}
	}
?>
<?php
    $user_id = $_SESSION['user_id'];
    $form1 = "SELECT * FROM form1 WHERE user_id=" . $user_id;
    $run_form1 = mysqli_query($conn, $form1);
    $rows = mysqli_num_rows($run_form1);

    $table = "<br /><br /><br /><table><tr><th colspan = 2>Advising Form</th></tr><tr><td  colspan=2>Current Entries: {$rows}</td></tr>";
    while($course = mysqli_fetch_assoc($run_form1)){
			$usersel = "SELECT form1 FROM student WHERE user_id=" . $user_id;
			$run_usersel = mysqli_query($conn, $usersel);
			$userres = mysqli_fetch_assoc($run_usersel);
			$status = $userres['form1'];
			if($status != 1){
				$table .= "<tr><td>{$course['course_dept']} {$course['course_id']}</td><td><a href='rema.php?id=". $user_id ."&dep=".$course['course_dept']."&num=".$course['course_id']."'>Remove</a></td></tr>";
			}
			else{
				$table .= "<tr><td>{$course['course_dept']} {$course['course_id']}</td><td></td></tr>";
			}
    }
    $table .= "</table>";
    echo $table;
?>
<br />
<br />
<br />
<?php
$user = $_SESSION['user_id'];
$user_query = "SELECT * FROM student WHERE user_id=" . $user;
$run_user = mysqli_query($conn, $user_query);
$result = mysqli_fetch_assoc($run_user);
if($result['form1'] == 0){
	echo "<form action='' method='post'>
		<table>
			<tr>
				<td><button type='submit' name='clear-f1'>Clear Form</button></td>
			</tr>
			<tr>
				<td><button type='submit' name='submit-f1'>Submit Form</button></td>
			</tr>
		</table>
	</form>";
}
if(isset($_POST['submit-f1'])){
  $user = $_SESSION['user_id'];
  $qry = "UPDATE student SET adv_form=1 WHERE user_id=" . $user;
  $run = mysqli_query($conn, $qry);
  header("Location: adv-form.php?status=submitted");
  exit();
}
?>
</div>
</main>

<?php
	require "footer.php";
?>
