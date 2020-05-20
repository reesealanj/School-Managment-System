<?php
  require "header.php";

  if(isset($_SESSION['role'])){
    //use to redirect to proper pages hehehe
  }
?>

<main>
<h1>Banweb ++</h1>

<form action="includes/login.inc.php" method="post">
  <div class="change-tbl">
    <table>
      <tr>
        <td>Username: </td>
        <td>
          <input type="text" name="username">
        </td>
      </tr>
      <tr>
        <td>Password: </td>
        <td>
          <input type="password" name="user_pwd">
        </td>
      </tr>
      <tr>
        <td><button type="submit" name="login-submit">Login</button></td>
      </tr>
    </table>
  </div>
</form>
<br />
<br />
<a href="includes/db-reset.inc.php">Reset DB State</a>

</main>
<?php
  require "footer.php";
?>
