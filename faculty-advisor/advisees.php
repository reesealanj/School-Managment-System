<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h2>Advisees</h2>
<p>Search for one of your advisees by name or by User ID</p>
<form action="" method="post">
	<table>
		<tr><td><input type="text" name="search"></td>
		<td><button type="submit" name="search_submit">Search</button></td>
		<td><button type="submit" name="display_all">Show All</button></td></tr>
	</table>
	<br />
	<br />
</form>
	<?php
	$user_query = "";

	if(isset($_POST['search_submit'])){
		echo "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
		$user_query = $_POST['search'];
		$stu = "SELECT * FROM student WHERE (user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%') AND adv_id=" . $_SESSION['user_id'];
		$run_stu = mysqli_query($conn, $stu);

		$check_stu = mysqli_num_rows($run_stu);
		if($check_stu < 1){
			echo "None in System";
		}

		while($stu_row = mysqli_fetch_assoc($run_stu)){
			$table_row = "<tr>";
			$table_row .="<td>{$stu_row['user_id']}</td>";
			$table_row .="<td>{$stu_row['lname']}</td>";
			$table_row .="<td>{$stu_row['fname']}</td>";
			$table_row .="<td><a href=transcript.php?id={$stu_row['user_id']}>Transcript</a></td>";
			$table_row .="<td><a href=form1.php?id={$stu_row['user_id']}>Form 1</a></td>";
					$thesis = "SELECT * FROM student WHERE user_id=" . $stu_row['user_id'];
					$run_thesis = mysqli_query($conn, $thesis);
					$thesis_res = mysqli_fetch_assoc($run_thesis);
					if($thesis_res['adv_form'] == 1){
						$table_row .="<td><a href=adv-form.php?id={$stu_row['user_id']}>Advising Form</a></td>";
					}
					if($thesis_res['program'] == 2){
						$table_row .="<td><a href=thesis.php?id={$stu_row['user_id']}>Thesis</a></td>";
					}
			$table_row .="</tr>\n";

			echo $table_row;
		}
		echo "</table></div>";
	}
	if(isset($_POST['display_all'])){
		echo "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
		$user_query = "";
		$stu = "SELECT * FROM student WHERE (user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%') AND adv_id=" . $_SESSION['user_id'];
		$run_stu = mysqli_query($conn, $stu);

		$check_stu = mysqli_num_rows($run_stu);
		if($check_stu < 1){
			echo "None in System";
		}

		while($stu_row = mysqli_fetch_assoc($run_stu)){
			$table_row = "<tr>";
			$table_row .="<td>{$stu_row['user_id']}</td>";
			$table_row .="<td>{$stu_row['lname']}</td>";
			$table_row .="<td>{$stu_row['fname']}</td>";
			$table_row .="<td><a href=transcript.php?id={$stu_row['user_id']}>Transcript</a></td>";
			$table_row .="<td><a href=form1.php?id={$stu_row['user_id']}>Form 1</a></td>";
				$thesis = "SELECT * FROM student WHERE user_id=" . $stu_row['user_id'];
				$run_thesis = mysqli_query($conn, $thesis);
				$thesis_res = mysqli_fetch_assoc($run_thesis);
				if($thesis_res['adv_form'] == 1){
					$table_row .="<td><a href=adv-form.php?id={$stu_row['user_id']}>Advising Form</a></td>";
				}
				if($thesis_res['program'] == 2){
					$table_row .="<td><a href=thesis.php?id={$stu_row['user_id']}>Thesis</a></td>";
				}
			$table_row .="</tr>\n";

			echo $table_row;
		}
		echo "</table></div>";
	}
?>
</table>

</div>
</main>
