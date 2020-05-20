<?php
require "header.php";
?>
<main>
<div class="change-tbl">
<h1>Applicant Search</h1>
<p>You can search by user id or using a Name</p>
<form action="" method="post">
	<table>
		<tr><td><input type="text" name="search_query"></td>
		<td><button type="submit" name="submit_search">Search</td>
		<td><button type="submit" name="show_all">Display All</td></tr>
	</table>
</form>
<?php
	$user_query = "";
	if(isset($_POST['submit_search'])){
		$user_query = $_POST['search_query'];

		$app = "SELECT * FROM applicant WHERE decision= 0 AND (user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%')";
		$run_app = mysqli_query($conn, $app);
		if(mysqli_num_rows($run_app) > 0){
			echo "<h2>Applicants</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($app_row = mysqli_fetch_assoc($run_app)){
				$table_row = "<tr>";
				$table_row .="<td>{$app_row['user_id']}</td>";
				$table_row .="<td>{$app_row['last_name']}</td>";
				$table_row .="<td>{$app_row['first_name']}</td>";
				$table_row .="<td><a href=application.php?id={$app_row['user_id']}>Application</a></td>";
				$table_row .="<td><a href=review.php?id={$app_row['user_id']}>Review Form</a></td>";
				$table_row .="</tr>\n";

				echo $table_row;
			}
			echo "</table>";
		}
  }
  if(isset($_POST['show_all'])){
		$user_query = "";
		$app = "SELECT * FROM applicant WHERE decision=0 AND( user_id LIKE '%$user_query%' OR first_name LIKE '%$user_query%' OR last_name LIKE '%$user_query%')";
		$run_app = mysqli_query($conn, $app);
		if(mysqli_num_rows($run_app) > 0){
			echo "<h2>Applicants</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
			while($app_row = mysqli_fetch_assoc($run_app)){
				$table_row = "<tr>";
				$table_row .="<td>{$app_row['user_id']}</td>";
				$table_row .="<td>{$app_row['last_name']}</td>";
				$table_row .="<td>{$app_row['first_name']}</td>";
				$table_row .="<td><a href=application.php?id={$app_row['user_id']}>Application</a></td>";
				$table_row .="<td><a href=reviewing.php?id={$app_row['user_id']}>Review Form</a></td>";
				$table_row .="</tr>\n";

				echo $table_row;
			}
			echo "</table>";

		}
  }
  echo "</table></div></main>";
  require "footer.php";
?>
