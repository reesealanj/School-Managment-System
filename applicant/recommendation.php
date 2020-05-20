<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Aliens Abducted Me - Report an Abduction</title>
</head>
  <body>

    <?php
      $id_num = $_POST['id_num'];
      $recommendation = $_POST['rec'];
      /*
      $servername = "localhost";
      $username = "davidealejos";
      $password = "Chucknorris123!";
      $dbname = "davidealejos";
      */
      
      require "../includes/db-conn.inc.php";

      // Check connection
      
      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }
      else{
        //echo "Connection successful <br/>";
      }
      
      

      // define the sql_insert_query
      
      $query = "UPDATE recommendation SET rec_letter = '$recommendation' WHERE rid = $id_num;";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        //echo		"Thank you for sending a recommendation letter, you can now close this tab.	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
      }	
      
      //echo $query;
      
      $query = "SELECT uid FROM recommendation WHERE rid = $id_num;";
      
      $result	=	mysqli_query($conn,$query);
      //echo mysqli_num_rows($result);
      
      $row = mysqli_fetch_array($result);
      
      $uid = $row['uid'];
      
      $query = "UPDATE applicant SET rec_received1 = 'Yes' WHERE user_id = $uid;";
      
      $result	=	mysqli_query($conn,$query);
      
      if	($result)	{	
        echo		"Thank you for sending a recommendation letter, you can now close this tab.	<br/>";	
      }	
      else	{	
        echo "Error:	"	.	$query	.	"<br/>"	.	mysqli_error($conn);	
        echo "The reccomendation could not be submitted";
      }	
      
      $query = "UPDATE applicant SET app_status = 'completed' WHERE user_id = $uid and transcript_received = 'Yes' and rec_received1 = 'Yes';";
      
      $result	=	mysqli_query($conn,$query);
      


      //close connection
      mysqli_close($conn);

    ?>

  </body>
</html>
