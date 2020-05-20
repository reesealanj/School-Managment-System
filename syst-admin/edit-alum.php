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
		$user_get = "SELECT * FROM alumni WHERE user_id=" .$user_id;
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
		$rows .= "<tr><td><b>Graduation Year:</b></td><td>{$data['grad_year']}</td><td><input type=text name='grad_year'></td></tr>";
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

<?php
	if(isset($_POST['update-submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$orig_uid = $_POST['id'];
		$ch_uid = $_POST['user_id'];
		$grad_year = $_POST['grad_year'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$queries = "";

		if(!empty($fname)){
			$queries .= "UPDATE alumni SET fname='".$fname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($lname)){
			$queries .= "UPDATE alumni SET lname='".$lname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($email)){
			$queries .= "UPDATE alumni SET email='".$email."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($street)){
			$queries .= "UPDATE alumni SET street='".$street."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($city)){
			$queries .= "UPDATE alumni SET city='".$city."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($state)){
			$queries .= "UPDATE alumni SET state='".$state."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($country)){
			$queries .= "UPDATE alumni SET country='".$country."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($grad_year)){
			$queries .= "UPDATE alumni SET grad_year='".$grad_year."' WHERE user_id=".$orig_uid.";";
		}

		if(!empty($ch_uid)){
			$queries .= "UPDATE alumni SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE user SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE enrollment SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
		}

		$res = mysqli_multi_query($conn, $queries);
		if(!empty($ch_uid)){
			header("Location: edit-alum.php?id=" . $ch_uid);
		}
		else{
			header("Location: edit-alum.php?id=" . $orig_uid);
		}
	}
?>
</div>
</main>
<?php
	require 'footer.php';
?>
