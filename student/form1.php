<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Form 1</h1>
<?php
	if(isset($_GET['status'])){
		if($_GET['status'] == "clear"){
			echo "<h2 style='color:red'>Your Form 1 Has Been Cleared</h2>";
		}
		if($_GET['status'] == "accept"){
			echo "<h2 style='color:green'>Your Form 1 Has Been Accepted</h2>";
		}
	}
	$user = $_SESSION['user_id'];
	$user_query = "SELECT * FROM student WHERE user_id=" . $user;
	$run_user = mysqli_query($conn, $user_query);
	$result = mysqli_fetch_assoc($run_user);
	if($result['form1'] == 0){
		echo "<p>You may add up to 12 courses to your Form 1 by searching and clicking *add* below.<br /><b>Only courses which you have already taken are  eligible to be used on your form 1!</b><br /> Note that your Form 1 will NOT be submitted and checked until you add your courses to the form and click *submit*</p>
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
	else{
		echo "<h1>Submitted Form 1</h1>";
	}
?>

<?php
  if(isset($_POST['course-search'])){
    $user_query = $_POST['search_query'];
    $user = $_SESSION['user_id'];
    $courses1 = "SELECT * FROM enrollment WHERE user_id=" . $user. " AND grade NOT IN ('W', 'IP') AND (course_dept LIKE '%$user_query%' OR course_num LIKE '%$user_query%' OR course_name LIKE '%$user_query%')";
    $run_courses = mysqli_query($conn, $courses1);
    if(mysqli_num_rows($run_courses) > 0){
      $table = "<table><tr><th>Course Number</th><th>Course Title</th><th>Course Grade</th></tr>";
      while($course = mysqli_fetch_assoc($run_courses)){
        $table .= "<tr><td>{$course['course_dept']} {$course['course_num']}</td><td>{$course['course_name']}</td><td>{$course['grade']}</td><td><a href='addf1.php?id=". $user ."&dep=".$course['course_dept']."&num=".$course['course_num']."'>Add</a></td></tr>";
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
    $courses1 = "SELECT * FROM enrollment WHERE user_id=" . $user. " AND (course_dept LIKE '%$user_query%' OR course_num LIKE '%$user_query%' OR course_name LIKE '%$user_query%')";
    $run_courses = mysqli_query($conn, $courses1);
    if(mysqli_num_rows($run_courses) > 0){
      $table = "<table><tr><th>Course Number</th><th>Course Title</th><th>Course Grade</th></tr>";
      while($course = mysqli_fetch_assoc($run_courses)){
        $table .= "<tr><td>{$course['course_dept']} {$course['course_num']}</td><td>{$course['course_name']}</td><td>{$course['grade']}</td><td><a href='addf1.php?id=". $user ."&dep=".$course['course_dept']."&num=".$course['course_num']."'>Add</a></td></tr>";
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
			echo "<h2 style='color:green'>Course Added to Form 1!</h2>";
		}
	}
	if(isset($_GET['error'])){
		if($_GET['error'] == "duplicate"){
			echo "<h2 style='color:red'>That Course is Already On Your Form 1!</h2>";
		}
	}
?>
<?php
    $user_id = $_SESSION['user_id'];
    $form1 = "SELECT * FROM form1 WHERE user_id=" . $user_id;
    $run_form1 = mysqli_query($conn, $form1);
    $rows = mysqli_num_rows($run_form1);

    $table = "<br /><br /><br /><table><tr><th colspan = 2>Form 1</th></tr><tr><td  colspan=2>Current Entries: {$rows}</td></tr>";
    while($course = mysqli_fetch_assoc($run_form1)){
			$usersel = "SELECT form1 FROM student WHERE user_id=" . $user_id;
			$run_usersel = mysqli_query($conn, $usersel);
			$userres = mysqli_fetch_assoc($run_usersel);
			$status = $userres['form1'];
			if($status != 1){
				$table .= "<tr><td>{$course['course_dept']} {$course['course_id']}</td><td><a href='remf1.php?id=". $user_id ."&dep=".$course['course_dept']."&num=".$course['course_id']."'>Remove</a></td></tr>";
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
	echo "<form action='form1-submit.php' method='post'>
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
if(isset($_GET['error'])){
		if($_GET['error'] == 1){
				echo "<h2 style='color:red'>The Following Errors Exist With Your Form 1:</h2>";
			if($_GET['ncs'] == 1){
				echo "<h3 style='color:red'>Too Many Non CS Courses</h3>";
			}
			if($_GET['crd'] == 1){
				echo "<h3 style='color:red'>Not Enough Credits Applied</h3>";
			}
			if($_GET['cor'] == 1){
				echo "<h3 style='color:red'>You Did Not Apply All Required Core Courses</h3>";
			}
		}
	if($_GET['error'] == 2){
			echo "<h2 style='color:red'>The Following Errors Exist With Your Form 1:</h2>";
		if($_GET['csc'] == 1){
			echo "<h3 style='color:red'>Not Enough CS Credit Applied</h3>";
		}
		if($_GET['crd'] == 1){
			echo "<h3 style='color:red'>Not Enough Credits Applied</h3>";
		}
	}
}
?>
</div>
</main>

<?php
	require "footer.php";
?>
