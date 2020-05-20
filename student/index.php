<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<?php
	$user = $_SESSION['user_id'];
	$user_query = "SELECT * FROM student WHERE user_id=" . $user;
	$run_user_query = mysqli_query($conn, $user_query);
	$result = mysqli_fetch_assoc($run_user_query);
	$fname = $result['fname'];
	$lname = $result['lname'];
  $user_tbl = "SELECT * FROM user WHERE user_id=" . $user;
  $run_user_tbl = mysqli_query($conn, $user_tbl);
  $usr_data = mysqli_fetch_assoc($run_user_tbl);
	echo "<h1>Welcome, " . $fname . " " . $lname . "</h1>";
	echo "<p>You can edit your personal information below, and submit changes by clicking *submit changes*</p>";
	$edit_table = "<form action='' method='post'><table><tr><th></th><th>Current</th><th>Change To</th>";
	$edit_table .= "<tr><td><b>First Name:</b></td><td>{$result['fname']}</td><td></td></tr>";
	$edit_table .= "<tr><td><b>Last Name:</b></td><td>{$result['lname']}</td><td></td></tr>";
	$edit_table .= "<tr><td><b>Email:</b></td><td>{$result['email']}</td><td><input type=text name='email'></td></tr>";
  $edit_table .= "<tr><td><b>Username:</b></td><td>{$usr_data['username']}</td><td><input type=text name='username'></td></tr>";
  $edit_table .= "<tr><td><b>Password:</b></td><td>{$usr_data['pwd']}</td><td><input type=text name='pwd'></td></tr>";
  $edit_table .= "<tr><td><b>Street:</b></td><td>{$result['street']}</td><td><input type=text name='street'></td></tr>";
	$edit_table .= "<tr><td><b>City:</b></td><td>{$result['city']}</td><td><input type=text name='city'></td></tr>";
	$edit_table .= "<tr><td><b>State:</b></td><td>{$result['state']}</td><td><input type=text name='state'></td></tr>";
	$edit_table .= "<tr><td><b>Country:</b></td><td>{$result['country']}</td><td><input type=text name='country'></td></tr>";

	echo $edit_table;
?>
	<tr>
		<td colspan="2"></td><td><button type="submit" name="update-submit">Submit Changes</button></td>
	</tr>
</table>
</form>
</div>
<?php
	if(isset($_POST['update-submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$orig_uid = $_SESSION['user_id'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
    $username = $_POST['username'];
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
			$queries .= "UPDATE user SET pwd='".$pwd."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($username)){
			$queries .= "UPDATE user SET username='".$username."' WHERE user_id=".$orig_uid.";";
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

		$res = mysqli_multi_query($conn, $queries);

		header("Location: index.php");
	}
?>
</main>

<?php
	require "footer.php";
?>
