<?php
  require "header.php";
?>
<main>
  <div class="change-tbl">
    <h1>Current Students</h1>
    <p>You can search for a student by Name or by Student ID<br />Clicking "Show Graduation Queue" will display all students eligible to be graduated.</p>
    <form action="" method="post">
      <table>
        <tr>
          <td><input type="text" name="search"></td>
          <td><button type="submit" name="search_submit">Search</buttons></td>
          <td><button type="submit" name="display_all">Display All</button></td>
        </tr>
        <tr>
          <td><button type="submit" name="grad_queue">Show Graduation Queue</button></td>
        </tr>
      </table>
    </form>
    <br />
    <br />
    <?php
    	$user_query = "";
    	if(isset($_POST['search_submit'])){
    		$user_query = $_POST['search'];

    		$stu = "SELECT * FROM student WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
    		$run_stu = mysqli_query($conn, $stu);
    		if(mysqli_num_rows($run_stu) > 0){
    			echo "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
    			while($stu_row = mysqli_fetch_assoc($run_stu)){
    				$table_row = "<tr>";
    				$table_row .="<td>{$stu_row['user_id']}</td>";
    				$table_row .="<td>{$stu_row['lname']}</td>";
    				$table_row .="<td>{$stu_row['fname']}</td>";
    				$table_row .="<td><a href=view-stu.php?id={$stu_row['user_id']}>Details</a></td>";
    				$table_row .="<td><a href=edit-stu.php?id={$stu_row['user_id']}>Advisor</a></td>";
    				if($stu_row['form1'] == 1 && $stu_row['app_to_grad'] == 1){
    					$table_row.="<td><a href=graduate.php?id={$stu_row['user_id']}Graduate</a></td>";
    				}

    				$table_row .="</tr>\n";

    				echo $table_row;
    			}
    			echo "</table></div>";
    		}
    	}
    	if(isset($_POST['display_all'])){
    		$user_query = "";

    		$stu = "SELECT * FROM student WHERE user_id LIKE '%$user_query%' OR fname LIKE '%$user_query%' OR lname LIKE '%$user_query%'";
    		$run_stu = mysqli_query($conn, $stu);
    		if(mysqli_num_rows($run_stu) > 0){
    			echo "<table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
    			while($stu_row = mysqli_fetch_assoc($run_stu)){
    				$table_row = "<tr>";
    				$table_row .="<td>{$stu_row['user_id']}</td>";
    				$table_row .="<td>{$stu_row['lname']}</td>";
    				$table_row .="<td>{$stu_row['fname']}</td>";
    				$table_row .="<td><a href=view-stu.php?id={$stu_row['user_id']}>Details</a></td>";
    				$table_row .="<td><a href=edit-stu.php?id={$stu_row['user_id']}>Advisor</a></td>";
    				if($stu_row['form1'] == 1 && $stu_row['app_to_grad'] == 1){
    					$table_row.="<td><a href=graduate.php?id={$stu_row['user_id']}Graduate</a></td>";
    				}

    				$table_row .="</tr>\n";

    				echo $table_row;
    			}
    			echo "</table></div>";
    		}
    	}
    	if(isset($_POST['grad_queue'])){
    		$stu = "SELECT * FROM student WHERE app_to_grad=1 AND form1=1";
    		$run_stu = mysqli_query($conn, $stu);
    		if(mysqli_num_rows($run_stu) > 0){
    			echo "<h2>Students Who Are Eligible to Be Graduated</h2><table><tr><th>User ID</th><th>Last Name</th><th>First Name</th></tr>";
    			while($stu_row = mysqli_fetch_assoc($run_stu)){
    				$table_row = "<tr>";
    				$table_row .="<td>{$stu_row['user_id']}</td>";
    				$table_row .="<td>{$stu_row['lname']}</td>";
    				$table_row .="<td>{$stu_row['fname']}</td>";
    				$table_row .="<td><a href=view-stu.php?id={$stu_row['user_id']}>Details</a></td>";
    				$table_row .="<td><a href=edit-stu.php?id={$stu_row['user_id']}>Advisor</a></td>";
    				$table_row .="<td><a href=graduate.php?id={$stu_row['user_id']}>Graduate</a></td>";

    				$table_row .="</tr>\n";

    				echo $table_row;
    			}
    			echo "</table></div>";
    		}
    		else{
    			echo "<h2>No Students have applied and/or are eligible to graduate</h2>";
    		}
    	}
    ?>
  </div>
</main>
<?php
  require "footer.php";
?>
