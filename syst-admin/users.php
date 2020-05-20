<?php
require "header.php";
?>
<main>
<div class="change-tbl">
<h1>User Search</h1>
<p>You can search by user id or using a Name</p>
<form action="" method="post">
	<table>
		<tr><td><input type="text" name="search_query"></td>
		<td><button type="submit" name="submit_search">Search</td>
		<td><button type="submit" name="show_all">Display All</td></tr>
	</table>
</form>
<?php
	$user_query = "";
	if(isset($_POST['submit_search'])){
		$user_query = $_POST['search_query'];

		$app = "SELECT * FROM applicant WHERE user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%'";
		$run_app = mysqli_query($conn, $app);
		if(mysqli_num_rows($run_app) > 0){
			echo "<h2>Applicants</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($app_row = mysqli_fetch_assoc($run_app)){
				$table_row = "<tr>";
				$table_row .="<td>{$app_row['user_id']}</td>";
				$table_row .="<td>{$app_row['last_name']}</td>";
				$table_row .="<td>{$app_row['first_name']}</td>";
				$table_row .="<td><a href=view-app.php?id={$app_row['user_id']}>Application</a></td>";
				$table_row .="</tr>\n";

				echo $table_row;
			}
			echo "</table>";
		}

		$stu = "SELECT * FROM student WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
		$run_stu = mysqli_query($conn, $stu);
		if(mysqli_num_rows($run_stu) > 0){
			echo "<h2>Students</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($stu_row = mysqli_fetch_assoc($run_stu)){
			$table_row = "<tr>";
			$table_row .="<td>{$stu_row['user_id']}</td>";
			$table_row .="<td>{$stu_row['lname']}</td>";
			$table_row .="<td>{$stu_row['fname']}</td>";
			$table_row .="<td><a href=view-stu.php?id={$stu_row['user_id']}>Details</a></td>";
			$table_row .="<td><a href=edit-stu.php?id={$stu_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
			}
			echo "</table>";
		}

	$alum = "SELECT * FROM alumni WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
	$run_alum = mysqli_query($conn, $alum);

	$check_alum = mysqli_num_rows($run_alum);
	if($check_alum > 0){

		echo "<div class='change-tbl'><h2>Alumni</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";

		while($alum_row = mysqli_fetch_assoc($run_alum)){
			$table_row = "<tr>";
			$table_row .="<td>{$alum_row['user_id']}</td>";
			$table_row .="<td>{$alum_row['lname']}</td>";
			$table_row .="<td>{$alum_row['fname']}</td>";
			$table_row .="<td><a href=view-alum.php?id={$alum_row['user_id']}>Details</a></td>";
			$table_row .="<td><a href=edit-alum.php?id={$alum_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
		}

		echo "</table>";
	}

	$fac = "SELECT * FROM faculty WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
	$run_fac = mysqli_query($conn, $fac);

	$check_fac = mysqli_num_rows($run_fac);
	if($check_fac > 0){
		echo "<div class='change-tbl'><h2>Faculty Members</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Roles</th></tr>";

		while($fac_row = mysqli_fetch_assoc($run_fac)){
			$table_row = "<tr>";
			$table_row .="<td>{$fac_row['user_id']}</td>";
			$table_row .="<td>{$fac_row['lname']}</td>";
			$table_row .="<td>{$fac_row['fname']}</td>";
				$role = "";
				if($fac_row['primary_role'] == 0){
					$role.="System Administrator";
				}
				else if($fac_row['primary_role'] == 1){
					$role.="Faculty Instructor";
				}
				else if($fac_row['primary_role'] == 2){
					$role .= "Faculty Reviewer";
				}
				else if($fac_row['primary_role'] == 3){
					$role .= "Faculty Advisor";
				}
				else if($fac_row['primary_role'] == 4){
					$role .= "Graduate Secretary";
				}
				else if($fac_row['primary_role'] == 8){
					$role .= "Chair of Admissions Committee";
				}
				if($fac_row['secondary_role'] != 0){
				 	if($fac_row['secondary_role'] == 1){
						$role.=", Faculty Instructor";
					}
					else if($fac_row['secondary_role'] == 2){
						$role .= ", Faculty Reviewer";
					}
					else if($fac_row['secondary_role'] == 3){
						$role .= ", Faculty Advisor";
					}
					else if($fac_row['secondary_role'] == 4){
						$role .= ", Graduate Secretary";
					}
					else if($fac_row['secondary_role'] == 8){
						$role .= ", Chair of Admissions Committee";
					}
				}
				if($fac_row['third_role'] != 0){
					if($fac_row['third_role'] == 1){
						$role.=", Faculty Instructor";
					}
					else if($fac_row['third_role'] == 2){
						$role .= ", Faculty Reviewer";
					}
					else if($fac_row['third_role'] == 3){
						$role .= ", Faculty Advisor";
					}
					else if($fac_row['third_role'] == 4){
						$role .= ", Graduate Secretary";
					}
					else if($fac_row['third_role'] == 8){
						$role .= ", Chair of Admissions Committee";
					}
				}
			$table_row .="<td>{$role}</td>";
			$table_row .="<td><a href=edit-fac.php?id={$fac_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
		}
	}
	}
	if(isset($_POST['show_all'])){
		$user_query = "";
		$app = "SELECT * FROM applicant WHERE user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%'";
		$run_app = mysqli_query($conn, $app);
		if(mysqli_num_rows($run_app) > 0){
			echo "<h2>Applicants</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($app_row = mysqli_fetch_assoc($run_app)){
				$table_row = "<tr>";
				$table_row .="<td>{$app_row['user_id']}</td>";
				$table_row .="<td>{$app_row['last_name']}</td>";
				$table_row .="<td>{$app_row['first_name']}</td>";
				$table_row .="<td><a href=view-app.php?id={$app_row['user_id']}>Application</a></td>";
				$table_row .="</tr>\n";

				echo $table_row;
			}
			echo "</table>";
		}

		$stu = "SELECT * FROM student WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
		$run_stu = mysqli_query($conn, $stu);
		if(mysqli_num_rows($run_stu) > 0){
			echo "<h2>Students</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($stu_row = mysqli_fetch_assoc($run_stu)){
			$table_row = "<tr>";
			$table_row .="<td>{$stu_row['user_id']}</td>";
			$table_row .="<td>{$stu_row['lname']}</td>";
			$table_row .="<td>{$stu_row['fname']}</td>";
			$table_row .="<td><a href=view-stu.php?id={$stu_row['user_id']}>Details</a></td>";
			$table_row .="<td><a href=edit-stu.php?id={$stu_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
			}
			echo "</table>";
		}

	$alum = "SELECT * FROM alumni WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
	$run_alum = mysqli_query($conn, $alum);

	$check_alum = mysqli_num_rows($run_alum);
	if($check_alum > 0){

		echo "<div class='change-tbl'><h2>Alumni</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";

		while($alum_row = mysqli_fetch_assoc($run_alum)){
			$table_row = "<tr>";
			$table_row .="<td>{$alum_row['user_id']}</td>";
			$table_row .="<td>{$alum_row['lname']}</td>";
			$table_row .="<td>{$alum_row['fname']}</td>";
			$table_row .="<td><a href=view-alum.php?id={$alum_row['user_id']}>Details</a></td>";
			$table_row .="<td><a href=edit-alum.php?id={$alum_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
		}

		echo "</table>";
	}

	$fac = "SELECT * FROM faculty WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
	$run_fac = mysqli_query($conn, $fac);

	$check_fac = mysqli_num_rows($run_fac);
	if($check_fac > 0){
		echo "<div class='change-tbl'><h2>Faculty Members</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Roles</th></tr>";

		while($fac_row = mysqli_fetch_assoc($run_fac)){
			$table_row = "<tr>";
			$table_row .="<td>{$fac_row['user_id']}</td>";
			$table_row .="<td>{$fac_row['lname']}</td>";
			$table_row .="<td>{$fac_row['fname']}</td>";
				$role = "";
				if($fac_row['primary_role'] == 0){
					$role.="System Administrator";
				}
				else if($fac_row['primary_role'] == 1){
					$role.="Faculty Instructor";
				}
				else if($fac_row['primary_role'] == 2){
					$role .= "Faculty Reviewer";
				}
				else if($fac_row['primary_role'] == 3){
					$role .= "Faculty Advisor";
				}
				else if($fac_row['primary_role'] == 4){
					$role .= "Graduate Secretary";
				}
				else if($fac_row['primary_role'] == 8){
					$role .= "Chair of Admissions Committee";
				}
				if($fac_row['secondary_role'] != 0){
				 	if($fac_row['secondary_role'] == 1){
						$role.=", Faculty Instructor";
					}
					else if($fac_row['secondary_role'] == 2){
						$role .= ", Faculty Reviewer";
					}
					else if($fac_row['secondary_role'] == 3){
						$role .= ", Faculty Advisor";
					}
					else if($fac_row['secondary_role'] == 4){
						$role .= ", Graduate Secretary";
					}
					else if($fac_row['secondary_role'] == 8){
						$role .= ", Chair of Admissions Committee";
					}
				}
				if($fac_row['third_role'] != 0){
					if($fac_row['third_role'] == 1){
						$role.=", Faculty Instructor";
					}
					else if($fac_row['third_role'] == 2){
						$role .= ", Faculty Reviewer";
					}
					else if($fac_row['third_role'] == 3){
						$role .= ", Faculty Advisor";
					}
					else if($fac_row['third_role'] == 4){
						$role .= ", Graduate Secretary";
					}
					else if($fac_row['third_role'] == 8){
						$role .= ", Chair of Admissions Committee";
					}
				}
			$table_row .="<td>{$role}</td>";
			$table_row .="<td><a href=edit-fac.php?id={$fac_row['user_id']}>Edit</a></td>";
			$table_row .="</tr>\n";

			echo $table_row;
		}
	}
	}
	echo "</table></div></main>";
	require "footer.php";
?>
