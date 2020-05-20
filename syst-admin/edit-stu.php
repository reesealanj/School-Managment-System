<?php
	require 'header.php';
?>
<main>
<div class="change-tbl">
<h1>Update Personal Information</h1>
<form action="" method="post">
<table>
<tr>
<th></th>
<th>Current</th>
<th>Change To</th>
</tr>
<?php
	if(isset($_GET['id'])){
		$user_id = $_GET['id'];
		$_POST['id'] = $user_id;
		$user_get = "SELECT * FROM student WHERE user_id=" .$user_id;
		$run_user_get = mysqli_query($conn, $user_get);
		$data = mysqli_fetch_assoc($run_user_get);

		$rows = "<tr><td><b>First Name:</b></td><td>{$data['fname']}</td><td><input type=text name='fname'></td></tr>";
		$rows .= "<tr><td><b>Last Name:</b></td><td>{$data['lname']}</td><td><input type=text name='lname'></td></tr>";
		$rows .= "<tr><td><b>User ID Number:</b></td><td>{$data['user_id']}</td><td><input type=text name='user_id'></td></tr>";
		if($data['program'] == 1){
			$rows .= "<tr><td><b>Degree Program:</b></td><td>M.S.</td><td><select name='program'><option value='1'>M.S.</option><option value='2'>Ph.D.</option></select></td></tr>";
		}
		else{
			$rows .= "<tr><td><b>Degree Program:</b></td><td>Ph.D.</td><td><select name='program'><option value='2'>Ph.D.</option><option value='1'>M.S.</option></select></td></tr>";
		}
		$rows .="<tr><td><b>Advisor:</b></td>";
			if($data['adv_id'] == NULL){
				$rows .="<td>None Assigned</td>";
			}
			else{
				$adv_query = "SELECT * FROM faculty WHERE user_id=" . $data['adv_id'];
				$run_adv_query = mysqli_query($conn, $adv_query);
				$result = mysqli_fetch_assoc($run_adv_query);

				$rows .= "<td>{$result['fname']} {$result['lname']}</td>";
			}
		$rows .= "<td><select name='adv'>";
			$advs = "SELECT * FROM faculty WHERE primary_role=3 OR secondary_role=3 OR third_role=3";
			$run_advs = mysqli_query($conn, $advs);
			while($adv_opt = mysqli_fetch_assoc($run_advs)){
				$rows .= "<option value={$adv_opt['user_id']}>{$adv_opt['fname']} {$adv_opt['lname']}</option>\n";
			}
		$rows .= "</select></td>";
		$rows .= "<tr><td><b>Email:</b></td><td>{$data['email']}</td><td><input type=text name='email'></td></tr>";
		$rows .= "<tr><td><b>Street:</b></td><td>{$data['street']}</td><td><input type=text name='street'></td></tr>";
		$rows .= "<tr><td><b>City:</b></td><td>{$data['city']}</td><td><input type=text name='city'></td></tr>";
		$rows .= "<tr><td><b>State:</b></td><td>{$data['state']}</td><td><input type=text name='state'></td></tr>";
		$rows .= "<tr><td><b>Country:</b></td><td>{$data['country']}</td><td><input type=text name='country'></td></tr>";
		echo $rows;
	}
?>
<tr>
	<td colspan="2"></td><td><button type="submit" name="update-submit">Submit Changes</button></td>
</tr>
</table>
<form>
</div>
<?php
	if(isset($_POST['update-submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$orig_uid = $_POST['id'];
		$ch_uid = $_POST['user_id'];
		$prog = $_POST['program'];
		$adv = $_POST['adv'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$queries = "";

		if(!empty($fname)){
			$queries .= "UPDATE student SET fname='".$fname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($lname)){
			$queries .= "UPDATE student SET lname='".$lname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($email)){
			$queries .= "UPDATE student SET email='".$email."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($pwd)){
			$queries .= "UPDATE student SET pwd='".$pwd."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($street)){
			$queries .= "UPDATE student SET street='".$street."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($city)){
			$queries .= "UPDATE student SET city='".$city."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($state)){
			$queries .= "UPDATE student SET state='".$state."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($country)){
			$queries .= "UPDATE student SET country='".$country."' WHERE user_id=".$orig_uid.";";
		}

		$check = "SELECT * FROM student WHERE user_id=" . $orig_uid;
		$run_check = mysqli_query($conn, $check);
		$res = mysqli_fetch_assoc($run_check);
		if($res['adv_id'] != $adv){
			//then the advisor has been changed
			$queries .= "UPDATE student SET adv_id=".$adv." WHERE user_id=".$orig_uid.";";
		}
		if($res['program'] != $prog){
			if($prog == 1){
				$queries .= "UPDATE student SET program=1 WHERE user_id=".$orig_uid.";";
			}
			else{
				$queries .= "UPDATE student SET program=2 WHERE user_id=".$orig_uid.";";
			}
		}
		if(!empty($ch_uid)){
			$queries .= "UPDATE student SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE user SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE enrollment SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE form1 SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
		}

		$res = mysqli_multi_query($conn, $queries);
		if(!empty($ch_uid)){
			header("Location: edit-stu.php?id=" . $ch_uid);
		}
		else{
			header("Location: edit-stu.php?id=" . $orig_uid);
		}
	}
?>
</main>
<?php
	require 'footer.php';
?>
