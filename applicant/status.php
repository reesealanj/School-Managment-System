<?php
	require "header.php";
?>
<main>
 <?php
session_start();
//print_r($_SESSION);
?>
<html>	
<head>	
	<title>Status</title>	
</head>	
<body>	
	<h1>Application status:</h1>	
<?php		
   if(!$conn){
   die("Connection failed: " . mysqli_connect_error());
   }
   $uid = $_SESSION["user_id"];
  
   $query = "SELECT * FROM applicant WHERE user_id = $uid;";
 
   $result = mysqli_query($conn,$query);
   
   
   $num = mysqli_num_rows($result);
          
            if($num==0)  
 {  
    die("Application has not been completed");
              }   

   
   
   
   if($result){
   echo "<table style = width:30%>"; 

   $row = mysqli_fetch_array($result);   // Goes through results and displays them
   echo "<tr><td>" . "Application form status:" . "</td><td>" . "Transcript received:" . "</td><td>" . "Recommendation received:" . "</td></tr>";
   echo "<tr><td>" . "Completed" . "</td><td>" . $row['transcript_received'] . "</td><td>" . $row['rec_received1'] . "</td></tr>";  
   

   echo "</table>" . "<br />"; 
   }
   
   else {
   //echo "Error: " . $query . "<br>" . mysqli_error($conn);
   echo "There was an error getting your status, please log out and back in to your account";
   } 

   
   if($row['transcript_received'] == "No" || $row['rec_received1'] == "No"){
     echo "Your application has not been completed";
   }
   else{
     if($row['decision'] == 0)
       echo "<br />Your application has been completed and is under review";
     if($row['decision'] == 3){
       echo "<br />Your application has been denied<br>";
       
     }
     if($row['decision'] == 2){
       echo "<br />You have been accepted into GWU your acceptance letter will be mailed<br />";
       //echo "Your advisor will be: " . $row['app_rec_advisor'];
     }
     if($row['decision'] == 1){
       echo "<br />You have been accepted into GWU with aid your acceptance letter will be mailed<br />";
       //echo "Your advisor will be: " . $row['app_rec_advisor'];
     }
   }
   
   
   mysqli_close($conn);
?>
<br />

  </main>
</body>
</html>