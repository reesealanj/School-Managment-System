<?php
	require "header.php";
?>
<main>
<h1>Student Information</h1>
<?php
	if(isset($_GET['id'])){
		$course = $_GET['cid'];
		$user = $_GET['id'];
		$info_query = "SELECT * FROM student WHERE user_id=" . $user;
		$run_info_query = mysqli_query($conn, $info_query);
		echo "<table>";
		while($row = mysqli_fetch_assoc($run_info_query)){
			$tr = "<tr>";
			$tr .= "<td>Name:</td><td>{$row['fname']} {$row['lname']}</td>";
			$tr .= "</tr>";
			$tr .= "<tr>";
			$tr .= "<td>User ID:</td><td>{$row['user_id']}</td>";
			$tr .= "<td>Program:</td>";
			if($row['program'] == 1){
				$tr .= "<td>MS</td>";
			}
			else if($row['program'] == 2){
				$tr .= "<td>PhD</td>";
			}
			$tr .="</tr>";
			$tr .="<tr><td>Advisor:</td>";
			if($row['adv_id'] == NULL){
				$tr .="<td>None Assigned</td>";
			}
			else{
				$adv_query = "SELECT * FROM faculty WHERE user_id=" . $row['adv_id'];
				$run_adv_query = mysqli_query($conn, $adv_query);
				$result = mysqli_fetch_assoc($run_adv_query);

				$tr .= "<td>{$result['fname']} {$result['lname']}</td>";
			}
			echo $tr;
		}
		echo "</table><br /><a href='course_det.php?id=". $course. "'>Back to Course Page</a>";
	}
?>
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
			$out_row = "<form action='' method='post'><tr><th>Course Dept</th><th>Course Number</th></tr>";
			while($courses = mysqli_fetch_assoc($run_info_query)){
				$out_row .="<tr><td>{$courses['course_dept']}</td><td>{$courses['course_id']}</td></tr>\n";
			}
			$info_query_2 = "SELECT * FROM student WHERE user_id=" . $user;
			$run_info2 = mysqli_query($conn, $info_query_2);
			$result = mysqli_fetch_assoc($run_info2);
			if($result['form1'] == 1){
				$out_row .= "<tr><td></td><td></td><td>You have already approved this Form 1!</tr></td>\n";
			}
			else{
				$out_row .= "<tr><td></td><td colspan='2'><button type='submit' name='approve'>Approve Form 1</button></td></tr></table></form>\n";
			}
			echo $out_row;
		}

	}
?>
</table>
<?php
	if(isset($_POST['approve'])){
		$user_id = $_POST['user_id'];
		$approve = "UPDATE student SET form1=1 WHERE user_id=" . $user_id;
		$run_approve = mysqli_query($conn,$approve);
		header("Location: form1.php?id=" .$user_id);
	}
?>
<h1>Transcript</h1>
<h2>Courses In Progress</h2>
<?php
	if(isset($_GET['id'])){
		$user = $_GET['id'];


		$rows_out = "<table>";
		$rows_out .= "<tr>";
		$rows_out .= "<th>Department</th>";
		$rows_out .= "<th>Course #</th>";
		$rows_out .= "<th>Course Name</th>";
		$rows_out .= "<th>Credit Hours</th>";
		$rows_out .= "<th>Course Grade</th>";
		$rows_out .= "<th>Semester Taken</th>";
		$rows_out .= "<th>Year Taken</th>";
		$rows_out .= "</tr>\n";

		echo $rows_out;

		$select_ip = "SELECT * FROM enrollment WHERE user_id=". $user . " AND grade='IP'";
		$run_select = mysqli_query($conn, $select_ip);

		while($ip_row = mysqli_fetch_array($run_select)){
			$row = "<tr>";
			$row .= "<td>{$ip_row['course_dept']}</td>";
			$row .= "<td>{$ip_row['course_num']}</td>";
			$row .= "<td>{$ip_row['course_name']}</td>";
			$row .= "<td>{$ip_row['course_credits']}</td>";
			$row .= "<td>{$ip_row['grade']}</td>";
			$row .= "<td>{$ip_row['semester']}</td>";
			$row .= "<td>{$ip_row['year']}</td>";
			$row .= "</tr>\n";
			echo $row;
		}

		echo "</table>";
	}
?>
<h2>Courses Completed</h2>
<?php
	if(isset($_GET['id'])){
			$user = $_GET['id'];

			$rows_out = "<table>";
			$rows_out .= "<tr>";
			$rows_out .= "<th>Department</th>";
			$rows_out .= "<th>Course #</th>";
			$rows_out .= "<th>Course Name</th>";
			$rows_out .= "<th>Credit Hours</th>";
			$rows_out .= "<th>Course Grade</th>";
			$rows_out .= "<th>Semester Taken</th>";
			$rows_out .= "<th>Year Taken</th>";
			$rows_out .= "</tr>\n";

			echo $rows_out;

			$select_ip = "SELECT * FROM enrollment WHERE user_id=". $user . " AND grade IN ('A','A-','B+','B','B-','C+','C') ORDER BY year ASC, semester ASC";
			$run_select = mysqli_query($conn, $select_ip);

			while($ip_row = mysqli_fetch_array($run_select)){
				$row = "<tr>";
				$row .= "<td>{$ip_row['course_dept']}</td>";
				$row .= "<td>{$ip_row['course_num']}</td>";
				$row .= "<td>{$ip_row['course_name']}</td>";
				$row .= "<td>{$ip_row['course_credits']}</td>";
				$row .= "<td>{$ip_row['grade']}</td>";
				$row .= "<td>{$ip_row['semester']}</td>";
				$row .= "<td>{$ip_row['year']}</td>";
				$row .= "</tr>\n";
				echo $row;
			}

			echo "</table>";
	}
?>
<h2>Courses Not Counted (Failed)</h2>
<?php
	if(isset($_GET['id'])){
		$user = $_GET['id'];

		$rows_out = "<table>";
		$rows_out .= "<tr>";
		$rows_out .= "<th>Department</th>";
		$rows_out .= "<th>Course #</th>";
		$rows_out .= "<th>Course Name</th>";
		$rows_out .= "<th>Credit Hours</th>";
		$rows_out .= "<th>Course Grade</th>";
		$rows_out .= "<th>Semester Taken</th>";
		$rows_out .= "<th>Year Taken</th>";
		$rows_out .= "</tr>\n";

		echo $rows_out;

		$select_ip = "SELECT * FROM enrollment WHERE user_id=". $user . " AND grade='F'";
		$run_select = mysqli_query($conn, $select_ip);

		while($ip_row = mysqli_fetch_array($run_select)){
			$row = "<tr>";
			$row .= "<td>{$ip_row['course_dept']}</td>";
			$row .= "<td>{$ip_row['course_num']}</td>";
			$row .= "<td>{$ip_row['course_name']}</td>";
			$row .= "<td>{$ip_row['course_credits']}</td>";
			$row .= "<td>{$ip_row['grade']}</td>";
			$row .= "<td>{$ip_row['semester']}</td>";
			$row .= "<td>{$ip_row['year']}</td>";
			$row .= "</tr>\n";
			echo $row;
		}

		echo "</table>";
	}
?>
</main>
<?php
	require "footer.php";
?>
