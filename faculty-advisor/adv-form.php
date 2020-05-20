<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Student Form 1</h1>
<table>
<?php
	if(isset($_GET['id'])){
		$user = $_GET['id'];
		$_POST['user_id'] = $user;
		$info_query = "SELECT * FROM form1 WHERE user_id=" . $user;
		$run_info_query = mysqli_query($conn, $info_query);
		$rows = mysqli_num_rows($run_info_query);
    $usr = "SELECT * FROM student WHERE user_id=" .$user;
    $run_usr = mysqli_query($conn, $usr);
    $res = mysqli_fetch_assoc($run_usr);
    
    if($res['reg_hold'] == 0){
      echo "<h3>Student advising form has been approved!</h3>";
    }
		if($res['adv_form'] == 0){
			echo "<h3>Student has not submitted an Advising Form for Review!</h3>";
		}
		else{
			echo "<table><tr><th colspan=2>Submitted Advising Form</th></tr>";
			$form1 = "SELECT * FROM form1 WHERE user_id=" . $user;
			$run_form1 = mysqli_query($conn, $form1);
			while($row = mysqli_fetch_assoc($run_form1)){
				echo "<tr><td>{$row['course_dept']} {$row['course_id']}</td></tr>";
			}
			echo "</table><form action='' method='post'><table><tr><th><button type='submit' name='approve'>Approve Advising Form</button></th></tr></table></form>";
		}
	}
  if(isset($_POST['approve'])){
    $user = $_GET['id'];
    $query = "DELETE FROM form1 WHERE user_id=" . $user . ";";
    $query .= "UPDATE student SET reg_hold=0 WHERE user_id=" . $user . ";";
    mysqli_multi_query($conn, $query);

  }
?>
</table>
</div>
</main>
<?php
	require "footer.php";
?>
