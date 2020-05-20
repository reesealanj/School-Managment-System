<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Assigned Student Advisor</h1>
<?php
	if(isset($_GET['id'])){

		$user = $_GET['id'];
		$info_query = "SELECT * FROM student WHERE user_id=" . $user;
		$run_info_query = mysqli_query($conn, $info_query);
		echo "<table>";

		while($row = mysqli_fetch_assoc($run_info_query)){
			$tr="<tr><td>Student:</td><td>{$row['fname']} {$row['lname']}</td></tr>";
			$tr .="<tr><td>Advisor:</td>";
			if($row['adv_id'] == NULL){
				$tr .="<td>None Assigned</td></tr>";
			}
			else{
				$adv_query = "SELECT * FROM faculty WHERE user_id=" . $row['adv_id'];
				$run_adv_query = mysqli_query($conn, $adv_query);
				$result = mysqli_fetch_assoc($run_adv_query);

				$tr .= "<td>{$result['fname']} {$result['lname']}</td></tr>";
			}
			echo $tr;
		}
		echo "</table>";
	}
?>
<h2>Edit Advisor</h2>
<form action="" method="post">
<table>
	<tr>
		<th>Current</th>
		<th>Change To</th>
	</tr>
	<?php
		$user_id = $_GET['id'];
		$_POST['id'] = $user_id;
		$user_get = "SELECT * FROM student WHERE user_id=" .$user_id;
		$run_user_get = mysqli_query($conn, $user_get);
		$data = mysqli_fetch_assoc($run_user_get);

			if($data['adv_id'] == NULL){
				$rows ="<td>None Assigned</td>";
			}
			else{
				$adv_query = "SELECT * FROM faculty WHERE user_id=" . $data['adv_id'];
				$run_adv_query = mysqli_query($conn, $adv_query);
				$result = mysqli_fetch_assoc($run_adv_query);

				$rows = "<td>{$result['fname']} {$result['lname']}</td>";
			}
		$rows .= "<td><select name='adv'>";
			$advs = "SELECT * FROM faculty WHERE primary_role=3 OR secondary_role=3 OR third_role=3";
			$run_advs = mysqli_query($conn, $advs);
			while($adv_opt = mysqli_fetch_assoc($run_advs)){
				$rows .= "<option value={$adv_opt['user_id']}>{$adv_opt['fname']} {$adv_opt['lname']}</option>\n";
			}
		$rows .= "</select></td></tr>";

		echo $rows;
	?>
<tr>
	<td colspan="2"><button type="submit" name="update-submit">Submit Change</button></td>
</tr>
</table>
<form>
<?php
	if(isset($_POST['update-submit'])){
		$adv = $_POST['adv'];
		$orig_uid = $_POST['id'];
		$check = "SELECT * FROM student WHERE user_id=" . $orig_uid;
		$run_check = mysqli_query($conn, $check);
		$res = mysqli_fetch_assoc($run_check);
		if($res['adv_id'] != $adv){
			//then the advisor has been changed
			$queries = "UPDATE student SET adv_id=".$adv." WHERE user_id=".$orig_uid;
			$res=mysqli_query($conn, $queries);
		}

		header("Location: edit-stu.php?id=" . $orig_uid);
	}
?>
</div>
</main>
<?php
	require "footer.php";
?>
