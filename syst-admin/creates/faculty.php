
<div class="change-tbl">
<form action="new_user.php" method="post">
<table>
	<tr>
		<th colspan="2">Create User:</th>
	</tr>
	<tr>
		<td>First Name: </td>
		<td><input type="text" name="fname"></td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td><input type="text" name="lname"></td>
	</tr>
	<tr>
		<td>User ID: </td>
		<td><input type="text" name="user_id"></td>
	</tr>
  <tr>
    <td>Contact Email</td>
    <td><input type="text" name="email"></td>
  </tr>
  <tr>
    <td>Username:  </td>
    <td><input type="text" name="username"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="pwd"></td>
  </tr>
	<tr>
		<td>User Role</td>
		<td>
			<select name="role">
        <option value="4">Graduate Secretary</option>
        <option value="3">Faculty Advisor</option>
				<option value="2">Faculty Reviewer</option>
				<option value="1">Faculty Instructor</option>
				<option value="0">System Administrator</option>
			</select>
		<td>
	</tr>
	<tr>
		<td>Street</td>
		<td><input type="text" name="street"></td>
	</tr>
	<tr>
		<td>City</td>
		<td><input type="text" name="city"></td>
	</tr>
	<tr>
		<td>State</td>
		<td><input type="text" name="state"></td>
	</tr>
	<tr>
		<td>Country</td>
		<td><input type="text" name="country"></td>
	</tr>
	<tr>
		<td colspan="2"><button type="submit" name="user_submit">Submit</button></td>
	</tr>
<table>
</form>
