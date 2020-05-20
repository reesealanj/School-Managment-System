<?php
	require "header.php";
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
		$user_id = $_SESSION['user_id'];
		$_POST['id'] = $user_id;
		$user_get = "SELECT * FROM alumni WHERE user_id=" .$user_id;
		$run_user_get = mysqli_query($conn, $user_get);
		$data = mysqli_fetch_assoc($run_user_get);
		$user_tbl = "SELECT * FROM user WHERE user_id=" . $user_id;
		$run_user_tbl = mysqli_query($conn, $user_tbl);
		$usr_data = mysqli_fetch_assoc($run_user_tbl);
		$rows = "<tr><td><b>First Name:</b></td><td>{$data['fname']}</td><td></td></tr>";
		$rows .= "<tr><td><b>Last Name:</b></td><td>{$data['lname']}</td><td></td></tr>";
		$rows .= "<tr><td><b>Email:</b></td><td>{$data['email']}</td><td><input type=text name='email'></td></tr>";
		$rows .= "<tr><td><b>Username:</b></td><td>{$usr_data['username']}</td><td><input type=text name='username'></td></tr>";
		$rows .= "<tr><td><b>Password:</b></td><td>{$usr_data['pwd']}</td><td><input type=text name='pwd'></td></tr>";
		$rows .= "<tr><td><b>Street:</b></td><td>{$data['street']}</td><td><input type=text name='street'></td></tr>";
		$rows .= "<tr><td><b>City:</b></td><td>{$data['city']}</td><td><input type=text name='city'></td></tr>";
		$rows .= "<tr><td><b>State:</b></td><td>{$data['state']}</td><td><input type=text name='state'></td></tr>";
		$rows .= "<tr><td><b>Country:</b></td><td>{$data['country']}</td><td><input type=text name='country'></td></tr>";
		echo $rows;
?>
<tr>
	<td colspan="2"></td><td><button type="submit" name="update-submit">Submit Changes</button></td>
</tr>
</table>
<form>

<?php
	if(isset($_POST['update-submit'])){
		$orig_uid = $_POST['id'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$username = $_POST['username'];
		$queries = "";

		if(!empty($email)){
			$queries .= "UPDATE alumni SET email='".$email."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($pwd)){
			$queries .= "UPDATE user SET pwd='".$pwd."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($username)){
			$queries .= "UPDATE user SET username='".$username."' WHERE user_id=".$orig_uid.";";
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
		header("Location: index.php");
	}
?>
</div>
</main>
<?php
	require "footer.php";
?>
