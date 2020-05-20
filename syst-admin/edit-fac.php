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

			$user_get = "SELECT * FROM faculty WHERE user_id=" .$user_id;
			$run_user_get = mysqli_query($conn, $user_get);
			$data = mysqli_fetch_assoc($run_user_get);

			$rows = "<tr><td><b>First Name:</b></td><td>{$data['fname']}</td><td><input type=text name='fname'></td></tr>";
			$rows .= "<tr><td><b>Last Name:</b></td><td>{$data['lname']}</td><td><input type=text name='lname'></td></tr>";
			$rows .= "<tr><td><b>User ID Number:</b></td><td>{$data['user_id']}</td><td><input type=text name='user_id'></td></tr>";
			$rows .= "<tr><td><b>Primary Role:</b></td>";
				$role = " ";
				if($data['primary_role'] == 0){
					$role.="System Administrator";
				}
				else if($data['primary_role'] == 1){
					$role.="Faculty Instructor";
				}
				else if($data['primary_role'] == 2){
					$role .= "Faculty Reviewer";
				}
				else if($data['primary_role'] == 3){
					$role .= "Faculty Advisor";
				}
				else if($data['primary_role'] == 4){
					$role .= "Graduate Secretary";
				}
				else if($data['primary_role'] == 8){
					$role .= "Chair of Admissions Committee";
				}
			$rows .= "<td>" . $role . "</td>";
				if($data['primary_role'] == 0){
						$rows .= "<td><select name='role1'><option value='0'>System Administrator</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
				}
				else if($data['primary_role'] == 1){
					$rows .= "<td><select name='role1'><option value='1'>Faculty Instructor</option><option value='0'>System Administrator</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='8'>Chair of Admissions Committee</option></select></td>";
				}
				else if($data['primary_role'] == 2){
					$rows .= "<td><select name='role1'><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>System Administrator</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
				}
				else if($data['primary_role'] == 3){
					$rows .= "<td><select name='role1'><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>System Administrator</option><option value='4'>Graduate Secretary</option><option value='8'>Chair of Admissions Committee</option></select></td>";
				}
				else if($data['primary_role'] == 4){
					$rows .= "<td><select name='role1'><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>System Administrator</option><option value='8'>Chair of Admissions Committee</option></select></td>";
				}
				else if($data['primary_role'] == 8){
					$rows .= "<td><select name='role1'><option value='8'>Chair of Admissions Committee</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>System Administrator</option></select></td>";
				}
				$rows .= "<tr><td><b>Secondary Role:</b></td>";
					$role = " ";
					if($data['secondary_role'] == 0){
						$role.="None";
					}
					else if($data['secondary_role'] == 1){
						$role.="Faculty Instructor";
					}
					else if($data['secondary_role'] == 2){
						$role .= "Faculty Reviewer";
					}
					else if($data['secondary_role'] == 3){
						$role .= "Faculty Advisor";
					}
					else if($data['secondary_role'] == 4){
						$role .= "Graduate Secretary";
					}
					else if($data['secondary_role'] == 8){
						$role .= "Chair of Admissions Committee";
					}
				$rows .= "<td>" . $role . "</td>";
					if($data['secondary_role'] == 0){
							$rows .= "<td><select name='role2'><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
					}
					else if($data['secondary_role'] == 1){
						$rows .= "<td><select name='role2'><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='8'>Chair of Admissions Committee</option></select></td>";
					}
					else if($data['secondary_role'] == 2){
						$rows .= "<td><select name='role2'><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
					}
					else if($data['secondary_role'] == 3){
						$rows .= "<td><select name='role2'><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='8'>Chair of Admissions Committee</option></select></td>";
					}
					else if($data['secondary_role'] == 4){
						$rows .= "<td><select name='role2'><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='8'>Chair of Admissions Committee</option></select></td>";
					}
					else if($data['secondary_role'] == 8){
						$rows .= "<td><select name='role2'><option value='8'>Chair of Admissions Committee</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option></select></td>";
					}
					$rows .= "<tr><td><b>Third Role:</b></td>";
						$role = " ";
						if($data['third_role'] == 0){
							$role.="None";
						}
						else if($data['third_role'] == 1){
							$role.="Faculty Instructor";
						}
						else if($data['third_role'] == 2){
							$role .= "Faculty Reviewer";
						}
						else if($data['third_role'] == 3){
							$role .= "Faculty Advisor";
						}
						else if($data['third_role'] == 4){
							$role .= "Graduate Secretary";
						}
						else if($data['third_role'] == 8){
							$role .= "Chair of Admissions Committee";
						}
					$rows .= "<td>" . $role . "</td>";
						if($data['third_role'] == 0){
								$rows .= "<td><select name='role3'><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
						}
						else if($data['third_role'] == 1){
							$rows .= "<td><select name='role3'><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='8'>Chair of Admissions Committee</option></select></td>";
						}
						else if($data['third_role'] == 2){
							$rows .= "<td><select name='role3'><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='8'>Chair of Admissions Committee</option></select></td>";
						}
						else if($data['third_role'] == 3){
							$rows .= "<td><select name='role3'><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='4'>Graduate Secretary</option><option value='8'>Chair of Admissions Committee</option></select></td>";
						}
						else if($data['third_role'] == 4){
							$rows .= "<td><select name='role3'><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option><option value='8'>Chair of Admissions Committee</option></select></td>";
						}
						else if($data['third_role'] == 8){
							$rows .= "<td><select name='role3'><option value='8'>Chair of Admissions Committee</option><option value='4'>Graduate Secretary</option><option value='3'>Faculty Advisor</option><option value='2'>Faculty Reviewer</option><option value='1'>Faculty Instructor</option><option value='0'>None</option></select></td>";
						}
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
</form>
</div>
<?php
	if(isset($_POST['update-submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$orig_uid = $_POST['id'];
		$ch_uid = $_POST['user_id'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$role1 = $_POST['role1'];
		$role2 = $_POST['role2'];
		$role3 = $_POST['role3'];

		$queries = "";
		if($role1 != $data['primary_role']){
			$queries .= "UPDATE faculty SET primary_role=" . $role1 . " WHERE user_id=" . $orig_uid. ";";
			$queries .= "UPDATE user SET user_role=" . $role1 . " WHERE user_id=" . $orig_uid. ";";
		}
		if($role2 != $data['secondary_role']){
			//check that none of the roles are duplicated
			if(($role2 == $role1 && $role2 != 0) || ($role2 == $role3 && $role2 != 0)){
				header("Location: edit-fac.php?id=" . $orig_uid . "&error=duperole");
				exit();
			}
			$queries .= "UPDATE faculty SET secondary_role=" . $role2 . " WHERE user_id=" . $orig_uid. ";";
		}
		if($role3 != $data['third_role']){
			$queries .= "UPDATE faculty SET third_role=" . $role3 . " WHERE user_id=" . $orig_uid. ";";
		}
		if(!empty($fname)){
			$queries .= "UPDATE faculty SET fname='".$fname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($lname)){
			$queries .= "UPDATE faculty SET lname='".$lname."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($email)){
			$queries .= "UPDATE faculty SET email='".$email."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($street)){
			$queries .= "UPDATE faculty SET street='".$street."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($city)){
			$queries .= "UPDATE faculty SET city='".$city."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($state)){
			$queries .= "UPDATE faculty SET state='".$state."' WHERE user_id=".$orig_uid.";";
		}
		if(!empty($country)){
			$queries .= "UPDATE faculty SET country='".$country."' WHERE user_id=".$orig_uid.";";
		}

		if(!empty($ch_uid)){
			$queries .= "UPDATE user SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE faculty SET user_id=".$ch_uid." WHERE user_id=".$orig_uid.";";
			$queries .= "UPDATE student SET adv_id=".$ch_uid." WHERE adv_id=".$orig_uid.";";
		}


		$res = mysqli_multi_query($conn, $queries);

		if(!empty($ch_uid)){
			header("Location: edit-fac.php?id=" . $ch_uid);
		}
		else{
			header("Location: edit-fac.php?id=" . $orig_uid);
		}
	}
?>
</main>
<?php
	require 'footer.php';
?>
