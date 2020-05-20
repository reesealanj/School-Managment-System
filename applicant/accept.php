<?php
	require "header.php";
?>
<html>	
<body>	
<main>
<?php
$uid = $_SESSION["user_id"];
$query = "UPDATE applicant SET accept = 1 WHERE user_id = $uid;";
 
   $result = mysqli_query($conn,$query);
   if($result){
     echo "Thank you for deciding to attend GWU. Please send your admission fee by mail, the GS will matriculate you later.";
   }
   
   
      
   mysqli_close($conn);
   ?>
</main>
</body>
</html>