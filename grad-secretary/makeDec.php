<?php
	require "header.php";
?>
<main>
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['decision'])&& isset($_POST['decisionUID'])){
    $addingq=$_POST['decision'];
    $addingqUID=$_POST['decisionUID'];
    $aQuery = "UPDATE applicant A SET A.decision='$addingq', A.app_status='decisionMade' WHERE A.user_id='$addingqUID'";
    $check="SELECT * from applicant A WHERE A.user_id='$addingqUID'";
    $checkResult=$conn->query($check) or die("mysql error".$mysqli->error);
    if($checkResult->num_rows==0){
    echo "No Applicant Found";
    }else{
    $aResult = $conn->query($aQuery) or die("mysql error".$mysqli->error);
    if($aResult==TRUE) {
        echo "decision updated successfully";
    }else{
        echo "failed to make decision, please try again";
    }
}}
$conn->close();
?>

<!DOCTYPE html>
<html>
<body>
<br><br><br><br>
</main>
</body>
</html>
