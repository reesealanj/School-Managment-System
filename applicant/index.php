<?php
require "header.php";
?>

<main>
<div class="change-tbl">
<?php
	$user = $_SESSION['user_id'];
	$user_query = "SELECT * FROM application,applicant WHERE user_id=" .$user;
	$run_user_query = mysqli_query($conn, $user_query);
	$result = mysqli_fetch_assoc($run_user_query);
	$fname = $result['first_name'];
	$lname = $result['last_name'];
  $user_tbl = "SELECT * FROM user WHERE user_id=" . $user;
  $run_user_tbl = mysqli_query($conn, $user_tbl);
  $usr_data = mysqli_fetch_assoc($run_user_tbl);
	echo "<h1>Welcome, " . $fname . " "  . $lname . "</h1>";
	echo "<p>You can edit your personal information below, and submit changes by clicking *submit changes*</p>";
	$edit_table = "<form action='' method='post'><table><tr><th></th><th>Current</th><th>Change To</th>";
	$edit_table .= "<tr><td><b>First Name:</b></td><td>{$result['first_name']}</td><td></td></tr>";
	$edit_table .= "<tr><td><b>Last Name:</b></td><td>{$result['last_name']}</td><td></td></tr>";
	$edit_table .= "<tr><td><b>Email:</b></td><td>{$result['email']}</td><td><input type=text name='email'></td></tr>";
  $edit_table .= "<tr><td><b>Username:</b></td><td>{$usr_data['username']}</td><td><input type=text name='username'></td></tr>";
  $edit_table .= "<tr><td><b>Password:</b></td><td>{$usr_data['pwd']}</td><td><input type=text name='pwd'></td></tr>";
  $edit_table .= "<tr><td><b>Street:</b></td><td>{$result['street']}</td><td><input type=text name='street'></td></tr>";
	$edit_table .= "<tr><td><b>City:</b></td><td>{$result['city']}</td><td><input type=text name='city'></td></tr>";
	$edit_table .= "<tr><td><b>State:</b></td><td>{$result['state']}</td><td><input type=text name='state'></td></tr>";
	$edit_table .= "<tr><td><b>Zip:</b></td><td>{$result['zip']}</td><td><input type=text name='zip'></td></tr>";

	echo $edit_table;
?>
	<tr>
		<td colspan="2"></td><td><button type="submit" name="update-submit">Submit Changes</button></td>
	</tr>
	</table>
	
</form>
<?php
	if(isset($_POST['update-submit'])){

		$orig_uid = $_SESSION['user_id'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$username = $_POST['username'];
    $queries = "";


		if(!empty($email)){
			$queries .= "UPDATE application SET email='".$email."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($pwd)){
			$queries .= "UPDATE user SET pwd='".$pwd."' WHERE user_id=".$orig_uid.";";
		}
    if(!empty($username)){
      $queries .= "UPDATE user SET username='".$username."' WHERE user_id=".$orig_uid.";";
    }
		if(!empty($street)){
			$queries .= "UPDATE application SET street='".$street."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($city)){
			$queries .= "UPDATE application SET city='".$city."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($state)){
			$queries .= "UPDATE application SET state='".$state."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($country)){
			$queries .= "UPDATE application SET zip='".$zip."' WHERE user_id=".$orig_uid.";";
		}

		$res = mysqli_multi_query($conn, $queries);

		header("Location: index.php");
	}
?>
</div>
</main>

<?php
require "footer.php";
?>
