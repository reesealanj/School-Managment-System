<?php
	require "header.php";
?>
<main>
<?php
// Start the session
session_start();
//print_r($_SESSION);
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Submit</title>
</head>
  <body>

    <?php
      $first_name = $_POST['firstname'];
      $last_name = $_POST['lastname'];
      $email = $_POST['email'];
      $ssn = $_POST['ssn'];
      $date_of_birth = $_POST['date_of_birth'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $street = $_POST['street'];
      $zip = $_POST['zip'];
      $degree = $_POST['degree'];
      $app_term = $_POST['app_term'];
      $area_of_interest = $_POST['area_of_interest'];
      $bachelor_school = $_POST['bachelor_school'];
      $bachelor_degree = $_POST['bachelor_degree'];
      $bachelor_major = $_POST['bachelor_major'];
      $bachelor_year = $_POST['bachelor_year'];
      $bachelor_gpa = $_POST['bachelor_gpa'];
      $masters_school = $POST['masters_school'];
      $masters_degree = $_POST['masters_degree'];
      $masters_major = $_POST['masters_major'];
      $masters_year = $_POST['masters_year'];
      $masters_gpa = $_POST['masters_gpa'];
      $work_experience = $_POST['work_experience'];
      $GRE_verbal = $_POST['GRE_verbal'];
      $GRE_quantitative = $_POST['GRE_quantitative'];
      $GRE_year = $_POST['GRE_year'];
      $GRE_subject = $_POST['GRE_subject'];
      $TOEFL = $_POST['TOEFL'];
	  $uid = $_SESSION["user_id"];
      $TOEFL_year = $_POST['TOEFL_year'];
      $GRE_score = $_POST['GRE_score'];
      $errCheck = 0;
      $inputErr = 0;
      
      // Input check

      
      if (!preg_match("/^[0-9]*$/",$ssn)) {
      echo "Only numbers allowed for ssn\n";
      $inputErr++; 
    }
    
    if (!preg_match("/^[0-9]*$/",$zip)) {
      echo "Only numbers allowed for zip\n";
      $inputErr++; 
    }
    
    if (!preg_match("/^[0-9]*$/",$bachelor_year)) {
      echo "Only numbers allowed for your bachelor year\n";
      $inputErr++; 
    }
    
    
    if (!preg_match("/^[0-9]*$/",$masters_year)) {
      echo "Only numbers allowed for your masters year\n";
      $inputErr++; 
    }
    
    
    if (!preg_match("/^[0-9]*$/",$GRE_score)) {
      echo "Only numbers allowed for your masters gpa\n";
      $inputErr++; 
    }
    
    
    if (!preg_match("/^[0-9]*$/",$GRE_verbal)) {
      echo "Only numbers allowed for your GRE verbal\n";
      $inputErr++; 
    }
    
    if (!preg_match("/^[0-9]*$/",$GRE_quantitative)) {
      echo "Only numbers allowed for your GRE quantitative\n";
      $inputErr++; 
    }
    
    if (!preg_match("/^[0-9]*$/",$GRE_year)) {
      echo "Only numbers allowed for your bachelor year\n";
      $inputErr++; 
    }
    
    if($TOEFL != ""){
    if (!preg_match("/^[0-9]*$/",$TOEFL)) {
      echo "Only numbers allowed for your TOEFL\n";
      $inputErr++; 
    }
    }
	
	 
      if($inputErr == 0){
      

      // Check connection
      
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
      else{
        //echo "Connection successful <br/>";
      }
      
      
      // Check if app was already completed
      
      $query = "SELECT * from applicant where user_id = $uid;";
      
      $result	=	mysqli_query($conn,$query);
      
      $num = mysqli_num_rows($result);
      
      if($num > 0){
        //<input type=button onClick="location.href='mainpage.php'" value='Back to home page'>"
      
      
      

      
  
      // define the sql_insert_query
      
      // Need to get uid from somewhere (PHP SESSION) using 4 for testing
      // Using 3 for rid (needs to change to auto increment)
      
      
      
      if(empty($_POST['GRE_score'])){
        $GRE_score = "NULL";
      }
      
      if(empty($_POST['masters_gpa'])){
        $masters_gpa = "NULL";
      }
      
      if(empty($_POST['masters_year'])){
        $masters_year = "NULL";
      }
      
      if(empty($_POST['TOEFL'])){
        $TOEFL = "NULL";
      }
      
      if(empty($_POST['TOEFL_year'])){
        $TOEFL_year = "NULL";
      }
      
        $query = "UPDATE application SET ssn = '$ssn',street = '$street',city = '$city',state = '$state',zip = '$zip',email = '$email',app_term = '$app_term',GRE_verbal = $GRE_verbal,GRE_quantitative = $GRE_quantitative,exam_year = $GRE_year,bachelor_school = '$bachelor_school',bachelor_degree = '$bachelor_degree',bachelor_major = '$bachelor_major',bachelor_year = $bachelor_year,bachelor_gpa = $bachelor_gpa,area_of_interest = '$area_of_interest', degree_seeking = '$degree', TOEFL_year = $TOEFL_year, TOEFL_score = $TOEFL,GRE_subject = '$GRE_subject',GRE_score = $GRE_score,masters_school = '$masters_school',masters_degree = '$masters_degree',masters_major = '$masters_major',masters_year = $masters_year,masters_gpa = $masters_gpa WHERE uid = $uid;";
      
      
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      
      
      $query = "UPDATE applicant SET first_name = '$first_name',last_name = '$last_name',app_status = 'pending' WHERE user_id = $uid;";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
	   echo '<br />Information updated successfully<br />';
      }
      else{
        echo "There was a problem updating your information, please try again or contact an administrator for assistance.\n" . $errCheck;
        //echo "Youre subject score is: " . $GRE_score;
      }

}
else{
echo "You have not sent an application.";
}

      //close connection
      mysqli_close($conn);

    ?>
    <br />
  <input type=button onClick="location.href='mainpage.php'" value='Back to home page'>
  </main>
  </body>
</html>