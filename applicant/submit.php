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
      $rec_fname1 = $_POST['rec_fname1'];
      $rec_lname1 = $_POST['rec_lname1'];
      $rec_title1 = $_POST['rec_title1'];
      $rec_email1 = $_POST['rec_email1'];
      $rec_fname2 = $_POST['rec_fname2'];
      $rec_lname2 = $_POST['rec_lname2'];
      $rec_title2 = $_POST['rec_title2'];
      $rec_email2 = $_POST['rec_email2'];
      $rec_fname3 = $_POST['rec_fname3'];
      $rec_lname3 = $_POST['rec_lname3'];
      $rec_title3 = $_POST['rec_title3'];
      $rec_email3 = $_POST['rec_email3'];
      $reg_email = $_POST['reg_email'];
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
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$email' is of an invalid format.<br />";
    $inputErr++;
}  
    if(!empty($_POST['rec_email1'])){
    if (!filter_var($rec_email1, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$rec_email1' is of an invalid format.<br />";
    $inputErr++;
}}

    if(!empty($_POST['rec_email2'])){ 
    if (!filter_var($rec_email2, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$rec_email2' is of an invalid format.<br />";
    $inputErr++;
}}

    if(!empty($_POST['rec_email3'])){ 
    if (!filter_var($rec_email3, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$rec_email3' is of an invalid format.<br />";
    $inputErr++;
}} 

    if(!empty($_POST['reg_email'])){ 
    if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$reg_email' is of an invalid format.<br />";
    $inputErr++;
}} 
    



      // End input check, continue if no errors
      
      
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
        die("You have already sent an application.");
        //<input type=button onClick="location.href='mainpage.php'" value='Back to home page'>"
      }
      
      

      
  
      // define the sql_insert_query
      
      // Need to get uid from somewhere (PHP SESSION) using 4 for testing
      // Using 3 for rid (needs to change to auto increment)
      
      if(!empty($_POST['rec_email1'])){
      $query = "INSERT INTO recommendation (rec_fname,rec_lname,rec_title,uid) VALUES ('$rec_fname1','$rec_lname1','$rec_title1',$uid);";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      $query = "SELECT max(rid) FROM recommendation;";
 
   $result = mysqli_query($conn,$query);
   if($result){

   $row = mysqli_fetch_array($result);
   $rid1 = $row['max(rid)'];
   
   }}
   
   if(!empty($_POST['rec_email2'])){
      $query = "INSERT INTO recommendation (rec_fname,rec_lname,rec_title,uid) VALUES ('$rec_fname2','$rec_lname2','$rec_title2',$uid);";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      $query = "SELECT max(rid) FROM recommendation;";
 
   $result = mysqli_query($conn,$query);
   if($result){

   $row = mysqli_fetch_array($result);
   $rid2 = $row['max(rid)'];
   
   }}
   
   if(!empty($_POST['rec_email3'])){
      $query = "INSERT INTO recommendation (rec_fname,rec_lname,rec_title,uid) VALUES ('$rec_fname3','$rec_lname3','$rec_title3',$uid);";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      $query = "SELECT max(rid) FROM recommendation;";
 
   $result = mysqli_query($conn,$query);
   if($result){

   $row = mysqli_fetch_array($result);
   $rid3 = $row['max(rid)'];
   
   }}
      
      
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
      
        $query = "INSERT INTO application (uid,ssn,street,city,state,zip,email,app_term,GRE_verbal,GRE_quantitative,exam_year,bachelor_school,bachelor_degree,bachelor_major,bachelor_year,bachelor_gpa,area_of_interest, degree_seeking, TOEFL_year, TOEFL_score,GRE_subject,GRE_score,masters_school,masters_degree,masters_major,masters_year,masters_gpa,date_received) VALUES ($uid, '$ssn', '$street', '$city', '$state', '$zip', '$email', '$app_term', $GRE_verbal, $GRE_quantitative, $GRE_year, '$bachelor_school', '$bachelor_degree', '$bachelor_major', $bachelor_year, $bachelor_gpa, '$area_of_interest', '$degree', $TOEFL_year, $TOEFL,'$GRE_subject',$GRE_score,'$masters_school','$masters_degree','$masters_major',$masters_year,$masters_gpa,NOW());";
      
      
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      
      
      $query = "INSERT INTO applicant (first_name,last_name,user_id,app_status,decision) VALUES ('$first_name','$last_name',$uid,'pending',0);";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        $errCheck++;
        //echo		"New	record	created	successfully	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }
      
      
      
      if($errCheck >= 3){
        
      	
    
      $msg1 = "Send a recommendation for " . $first_name . " " . $last_name . " by following the link below: \n" . "Id number is: " . $rid1 . " \n" . "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-TeamFifteen/Fifteen/fifteen/public_html/applicant/recommendation.html";

// use wordwrap() if lines are longer than 70 characters
$msg1 = wordwrap($msg1,70);

      $msg2 = "Send a recommendation for " . $first_name . " " . $last_name . " by following the link below: \n" . "Id number is: " . $rid2 . " \n" . "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-TeamFifteen/Fifteen/fifteen/public_html/applicant/recommendation.html";

// use wordwrap() if lines are longer than 70 characters
$msg2 = wordwrap($msg2,70);

      $msg3 = "Send a recommendation for " . $first_name . " " . $last_name . " by following the link below: \n" . "Id number is: " . $rid3 . " \n" . "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-TeamFifteen/Fifteen/fifteen/public_html/applicant/recommendation.html";

// use wordwrap() if lines are longer than 70 characters
$msg3 = wordwrap($msg3,70);

// send emails

if(!empty($_POST['rec_email1'])){
        mail($rec_email1,"Recommendation",$msg1); 
      }
      
if(!empty($_POST['rec_email2'])){
        mail($rec_email2,"Recommendation",$msg2); 
      }
      
if(!empty($_POST['rec_email3'])){
        mail($rec_email3,"Recommendation",$msg3); 
      }
      
      
$msg4 = "Send a transcript for " . $first_name . " " . $last_name . " by following the link below: \n" . "Id number is: " . $uid . " \n" . "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-TeamFifteen/Fifteen/fifteen/public_html/applicant/transcript.html";  

$msg4 = wordwrap($msg4,70);
    
if(!empty($_POST['reg_email'])){
        mail($reg_email,"Transcript",$msg4); 
      }



     
      echo '<br />Thanks for submitting the application <br />';
      }
      else{
        echo "There was a problem submiting your application, please try again or contact an administrator for assistance.\n";
        echo "Youre subject score is: " . $GRE_score;
      }

}

      //close connection
      mysqli_close($conn);

    ?>
    <br />
  </main>
  </body>
</html>
