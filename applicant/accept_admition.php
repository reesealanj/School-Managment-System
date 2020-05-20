<?php
	require "header.php";
?>
<html>	
<head>	
<main>
<?php
$uid = $_SESSION["user_id"];
$query = "SELECT * FROM applicant WHERE user_id = $uid;";
 
   $result = mysqli_query($conn,$query);
   
   
   $num = mysqli_num_rows($result);
          
            if($num==0)  
 {  
    die("Application has not been completed");
              }   

    

   $row = mysqli_fetch_array($result);  
   if($row['transcript_received'] == "No" || $row['rec_received1'] == "No"){
     echo "Your application has not been completed";
   }
   else{
     if($row['decision'] == 0)
       echo "<br />Your application has been completed and is under review";
     if($row['decision'] == 3){
       echo "<br />Your application has been denied<br>";
       
     }
     if($row['decision'] == 2 || $row['decision'] == 1){
       echo "<br />You have been accepted into GWU click " . "<a href=accept.php>here</a>" . " to accept your admission.";
     }
   }
      
   mysqli_close($conn);
   ?>
</main>
</body>
</html>