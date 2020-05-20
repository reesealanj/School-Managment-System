<?php
	require "header.php";
?>
<main>
<h1>Student Information</h1>
<?php

		$user = $_SESSION['user_id'];
		$info_query = "SELECT * FROM alumni WHERE user_id=" . $user;
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
			echo $tr;
		}
		echo "</table>";
?>
<h1>Degree</h1>
<?php
		$user = $_SESSION['user_id'];
		$info_query = "SELECT * FROM alumni WHERE user_id=" . $user;
		$run_info_query = mysqli_query($conn, $info_query);
		$result = mysqli_fetch_assoc($run_info_query);
		//begin by deciding their program to decide which audit to apply
		echo "<table>";
		$cred_row = "<tr>";
			$cred_row .= "<td>Completed Credit Hours:</td>";
				$cred_query = "SELECT SUM(course_credits) as creds FROM enrollment where user_id=" . $user . " AND grade NOT IN ('F','IP')";
				$run_cred_query = mysqli_query($conn, $cred_query);
				$creds = mysqli_fetch_assoc($run_cred_query);
			$cred_row .="<td>{$creds['creds']}</td></tr>";

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

			$cred_row .= "<tr><td>GPA:</td><td>$gpa</td></tr>";
			$cred_row .= "<tr><td>Graduation Year</td><td>{$result['grad_year']}</td></tr>";

			echo $cred_row;
			echo "</table>";
?>
<h1>Transcript</h1>
<h2>Courses Completed</h2>
<?php

			$user = $_SESSION['user_id'];

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

?>
<h2>Courses Not Counted (Failed)</h2>
<?php
		$user = $_SESSION['user_id'];

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

?>
</main>
<?php
	require "footer.php";
?>
