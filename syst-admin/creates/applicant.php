<form action="new_user.php" method="post">
  <table>
    <tr>
      <th colspan="2">Create User:</th>
    </tr>
    <tr>
      <td>User ID: </td>
      <td><input type="text" name="user_id"></td>
    </tr>
    <tr>
      <td>Username: </td>
      <td><input type="text" name="username"></td>
    </tr>
    <tr>
      <td>Password: </td>
      <td><input type="password" name="pwd"></td>
    </tr>
    <?php
      $_POST['role'] = 7;
    ?>
    <tr>
      <td colspan="2"><button type="submit" name="app_submit">Submit</button></td>
    </tr>
  <table>
</form>
