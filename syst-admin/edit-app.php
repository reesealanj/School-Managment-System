<?php
  require "header.php";
?>
<main>
  <?php
    if(isset($_GET['id'])){
      $app = $_GET['id'];
      $applicant = "SELECT * FROM applicant WHERE user_id=" . $app;
      $application = "SELECT * FROM application WHERE uid=" . $app;
      $user = "SELECT * FROM user WHERE user_id=" . $app;
      $run_applicant =  mysqli_query($conn, $applicant);
      $applicant_data = mysqli_fetch_assoc($run_applicant);
      $run_application = mysqli_query($conn, $application);
      $application_data =  mysqli_fetch_assoc($run_application);
      $run_user = mysqli_query($conn, $user);
      $user_data = mysqli_fetch_assoc($run_user);
      $rows = "<table><tr><th></th><th>Current</th><th>Change To</th></tr>";
      $rows .= "<tr><td><b>First Name:</b></td><td>{$applicant_data['first_name']}</td><td><input type=text name='fname'></td></tr>";
  		$rows .= "<tr><td><b>Last Name:</b></td><td>{$applicant_data['last_name']}</td><td><input type=text name='lname'></td></tr>";
  		$rows .= "<tr><td><b>User ID Number:</b></td><td>{$applicant_data['user_id']}</td><td><input type=text name='user_id'></td></tr>";
      $rows .= "<tr><td><b>Email:</b></td><td>{$application_data['email']}</td><td><input type=text name='email'></td></tr>";
      $rows .= "<tr><td><b>Street:</b></td><td>{$application_data['street']}</td><td><input type=text name='street'></td></tr>";
      $rows .= "<tr><td><b>City:</b></td><td>{$application_data['city']}</td><td><input type=text name='city'></td></tr>";
      $rows .= "<tr><td><b>State:</b></td><td>{$application_data['state']}</td><td><input type=text name='state'></td></tr>";
      $rows .= "<tr><td><b>Country:</b></td><td>{$application_data['country']}</td><td><input type=text name='country'></td></tr>";
    }
  ?>
</main>
<?php
  require "footer.php";
?>
