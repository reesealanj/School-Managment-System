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

		if($rows == 0){
			echo "<h3>Student has not submitted a Form 1 for Review!</h3>";
		}
		else{
			echo "<table><tr><th colspan=2>Submitted Form 1</th></tr>";
			$form1 = "SELECT * FROM form1 WHERE user_id=" . $user;
			$run_form1 = mysqli_query($conn, $form1);
			while($row = mysqli_fetch_assoc($run_form1)){
				echo "<tr><td>{$row['course_dept']} {$row['course_id']}</td></tr>";
			}
			echo "</table>";
		}

	}
?>
</table>
</div>
</main>
<?php
	require "footer.php";
?>
