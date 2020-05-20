<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Degree Progress</h1>
<p><u>For a student to be properly cleared for graduation, all of the checkboxes must be filled in!</u><br /><br /></p>
<?php

	if(isset($_GET['id'])){
		$user = $_GET['id'];
		$info_query = "SELECT * FROM student WHERE user_id=" . $user;
		$run_info_query = mysqli_query($conn, $info_query);
		$result = mysqli_fetch_assoc($run_info_query);
		//begin by deciding their program to decide which audit to apply
		$prog = $result['program'];
		echo "<table>";
		if($prog == 1){
			//they are a master's student
			$reqs_met = 0;

			//TODO: GPA Calculation
			$credits = 0;
			$cr_query = "SELECT * FROM enrollment WHERE NOT grade='IP'";
			//with this need to count total number of courses completed
			//and then get total number of attempted credits and add
			//SELECT sum(course_credits) from enrollment where user_id=55555555 and not grade='ip';
			$cred_row = "<tr>";
			$cred_row .= "<td>Completed Credit Hours:</td>";
				$cred_query = "SELECT SUM(course_credits) as creds FROM enrollment where user_id=" . $user . " AND grade NOT IN ('F','IP')";
				$run_cred_query = mysqli_query($conn, $cred_query);
				$creds = mysqli_fetch_assoc($run_cred_query);
			$cred_row .="<td>{$creds['creds']}</td>";
			if($creds['creds'] >= 30){
				$cred_row .= "<td></td><td>30 Credit Minimum [X]</td>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .="<td></td><td>30 Credit Minimum [ ]</td>";
			}
			$cred_row .="</tr>";
				$non_cs = "SELECT count(*) as non_cs FROM enrollment where user_id=" . $user . " AND NOT course_dept='CSCI'";
				$run_non_cs = mysqli_query($conn, $non_cs);
				$non_cs_result = mysqli_fetch_assoc($run_non_cs);
			$cred_row .="<tr><td>Non Computer Science Courses:</td><td>{$non_cs_result['non_cs']}</td>";
			if($non_cs_result['non_cs'] < 4){
				$cred_row .= "<td></td><td>No More than 3 Non CS Courses [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>No More than 3 Non CS Courses [ ]</td></tr>";
			}
				$grades_sub_b = "SELECT count(*) as below_b FROM enrollment where user_id=" .$user. " AND grade IN ('C+','C','F')";
				$run_sub_b = mysqli_query($conn, $grades_sub_b);
				$blw_b_res = mysqli_fetch_assoc($run_sub_b);
			$cred_row .= "<tr><td>Grades Below B:</td><td>{$blw_b_res['below_b']}</td>";
			if($blw_b_res['below_b'] < 3){
				$cred_row .= "<td></td><td>No More than 2 Grades Below B [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>No More than 2 Grades Below B [ ]</td></tr>";
			}
				$core_query = "SELECT count(*) as core FROM enrollment WHERE user_id=" . $user . " AND course_dept='CSCI' AND course_num IN (6212,6221,6461) AND grade NOT IN ('F','IP')";
				$run_core = mysqli_query($conn, $core_query);
				$core_done = mysqli_fetch_assoc($run_core);
			$cred_row .= "<tr><td>Core Courses Passed:</td><td>{$core_done['core']}/3</td>";
			if($core_done['core'] == 3){
				$cred_row .= "<td></td><td>All Required Courses Passed [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>All Required Courses Passed [ ]</td></tr>";
			}

				$grades_query = "SELECT grade, course_credits  FROM enrollment WHERE user_id=" . $user;
				$run_grades = mysqli_query($conn, $grades_query);

				$grade_pts = 0.0;

				while($gr = mysqli_fetch_assoc($run_grades)){
					if($gr['grade'] == 'A'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 4.0);
					}
					else if($gr['grade'] == 'A-'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.7);
					}
					else if($gr['grade'] == 'B+'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.3);
					}
					else if($gr['grade'] == 'B'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.0);
					}
					else if($gr['grade'] == 'B-'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.7);
					}
					else if($gr['grade'] == 'C+'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.3);
					}
					else if($gr['grade'] == 'C'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.0);
					}
				}

				$att_cred = "SELECT SUM(course_credits) as creds FROM enrollment where user_id=" . $user . " AND grade NOT IN ('IP')";
				$run_att_cred = mysqli_query($conn, $att_cred);
				$res = mysqli_fetch_assoc($run_att_cred);
				$gpa = 0.0;
				$gpa = $grade_pts / $res['creds'];

			$cred_row .= "<tr><td>GPA:</td><td>$gpa</td>";
			if($gpa >= 3.0){
				$cred_row .= "<td></td><td>Minimum 3.0 GPA [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>Minimum 3.0 GPA [ ]</td></tr>";
			}

			if($reqs_met == 5){
				$cred_row .= "<tr></tr><tr><td></td><td></td><td>Eligible to Graduate [X]</td></tr>";
			}
			else{
				$cred_row .= "<tr></tr><tr><td></td><td></td><td>Eligible to Graduate [ ]</td></tr>";
			}

			echo $cred_row;

		}
		else if($prog == 2){
			//they are a phd student
			$min_gpa = 3.5;
			$min_credits = 36;
			$min_cs_credit = 30;
			$max_sub_b = 1;

			$reqs_met = 0;

			//TODO: GPA Calculation
			$credits = 0;
			$cr_query = "SELECT * FROM enrollment WHERE NOT grade='IP'";
			//with this need to count total number of courses completed
			//and then get total number of attempted credits and add
			//SELECT sum(course_credits) from enrollment where user_id=55555555 and not grade='ip';
			$cred_row = "<tr>";
			$cred_row .= "<td>Completed Credit Hours:</td>";
				$cred_query = "SELECT SUM(course_credits) as creds FROM enrollment where user_id=" . $user . " AND grade NOT IN ('F','IP')";
				$run_cred_query = mysqli_query($conn, $cred_query);
				$creds = mysqli_fetch_assoc($run_cred_query);
			$cred_row .="<td>{$creds['creds']}</td>";
			if($creds['creds'] >= 36){
				$cred_row .= "<td></td><td>36 Credit Minimum [X]</td>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .="<td></td><td>36 Credit Minimum [ ]</td>";
			}
			$cred_row .="</tr>";
				$non_cs = "SELECT sum(course_credits) as non_cs FROM enrollment where user_id=" . $user . " AND NOT course_dept='CSCI'";
				$run_non_cs = mysqli_query($conn, $non_cs);
				$non_cs_result = mysqli_fetch_assoc($run_non_cs);
				$cs_cred = $creds['creds'] - $non_cs_result['non_cs'];
			$cred_row .="<tr><td>Non Computer Science Credit:</td><td>{$non_cs_result['non_cs']}</td>";
			if($non_cs_result['non_cs'] > 29){
				$cred_row .= "<td></td><td>Minimum 30 CS Credits [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>Minimum 30 CS Credits [ ]</td></tr>";
			}
				$grades_sub_b = "SELECT count(*) as below_b FROM enrollment where user_id=" .$user. " AND grade IN ('C+','C','F')";
				$run_sub_b = mysqli_query($conn, $grades_sub_b);
				$blw_b_res = mysqli_fetch_assoc($run_sub_b);
			$cred_row .= "<tr><td>Grades Below B:</td><td>{$blw_b_res['below_b']}</td>";
			if($blw_b_res['below_b'] < 2){
				$cred_row .= "<td></td><td>No More than 1 Grade Below B [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>No More than 1 Grade Below B [ ]</td></tr>";
			}
				$grades_query = "SELECT grade, course_credits  FROM enrollment WHERE user_id=" . $user;
				$run_grades = mysqli_query($conn, $grades_query);

				$grade_pts = 0.0;

				while($gr = mysqli_fetch_assoc($run_grades)){
					if($gr['grade'] == 'A'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 4.0);
					}
					else if($gr['grade'] == 'A-'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.7);
					}
					else if($gr['grade'] == 'B+'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.3);
					}
					else if($gr['grade'] == 'B'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 3.0);
					}
					else if($gr['grade'] == 'B-'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.7);
					}
					else if($gr['grade'] == 'C+'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.3);
					}
					else if($gr['grade'] == 'C'){
						$grade_pts = $grade_pts + ($gr['course_credits'] * 2.0);
					}
				}

				$att_cred = "SELECT SUM(course_credits) as creds FROM enrollment where user_id=" . $user . " AND grade NOT IN ('IP')";
				$run_att_cred = mysqli_query($conn, $att_cred);
				$res = mysqli_fetch_assoc($run_att_cred);
				$gpa = 0.0;
				$gpa = $grade_pts / $res['creds'];

			$cred_row .= "<tr><td>GPA:</td><td>$gpa</td>";
			if($gpa >= 3.5){
				$cred_row .= "<td></td><td>Minimum 3.5 GPA [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<td></td><td>Minimum 3.5 GPA [ ]</td></tr>";
			}
			$thesis = $result['thesis'];
			if($thesis == 1){
				$cred_row .= "<tr><td></td>";
				$cred_row .= "<td></td><td>Thesis Defense Passed [X]</td></tr>";
				$reqs_met = $reqs_met + 1;
			}
			else{
				$cred_row .= "<tr><td></td>";
				$cred_row .= "<td></td><td>Thesis Defense Passed [ ]</td></tr>";
			}
			if($reqs_met == 5){
				$cred_row .= "<tr></tr><tr><td></td><td></td><td>Eligible to Graduate [X]</td></tr>";
			}
			else{
				$cred_row .= "<tr></tr><tr><td></td><td></td><td>Eligible to Graduate [ ]</td></tr>";
			}

			echo $cred_row;
		}
		if($result['app_to_grad'] == 1){
			echo "<tr></tr><tr><td></td><td></td><td>Applied to Graduate [X]</td></tr>";
		}
		else{
			echo "<tr></tr><tr><td></td><td></td><td>Applied to Graduate [ ]</td></tr>";
		}
		echo "</table>";
	}
?>
<h2>Graduate Student</h2>
<p>Confirm the User ID of the Student you wish to graduate and click *Graduate.* <br />Note that clicking graduate only confirms graduation, and it is up to you to decide (based on the above information) if the student should graduate</p>
<form action="" method="post">
	<table>
		<tr>
			<td>User ID</td>
			<td><input type="text" name="user_id"></td>
		</tr>
		<tr>
			<td> </td>
			<td><button type="submit" name="grad">Graduate</button></td>
		</tr>
	</table>
</form>
<?php
	if(isset($_POST['grad'])){
		$user = $_POST['user_id'];
		$sel_user = "SELECT * FROM student WHERE user_id=" .$user;
		$run_sel_user = mysqli_query($conn, $sel_user);
		$data = mysqli_fetch_assoc($run_sel_user);
		$fname = $data['fname'];
		$lname = $data['lname'];
		$email = $data['email'];
		$pwd = $data['pwd'];
		$street = $data['street'];
		$city = $data['city'];
		$state = $data['state'];
		$country = $data['country'];
		$program = $data['program'];

		$queries = "DELETE from student WHERE user_id=" .$user. ";";
		$queries .= "DELETE FROM form1 WHERE user_id=" .$user . ";";
		$queries .= "UPDATE user SET user_role=6 WHERE user_id=" . $user . ";";
		$queries .= "INSERT INTO alumni(user_id, program, grad_year, fname, lname, email, street, city, state, country) VALUES ($user, $program, 2019, '$fname','$lname','$email','$street','$city','$state','$country');";
		mysqli_multi_query($conn, $queries);

		header("Location: students.php?graduate=success");
	}
?>
</div>
</main>
<?php
	require "footer.php";
?>
