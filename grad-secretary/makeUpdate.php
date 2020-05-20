<?php
	require "header.php";
?>
<main>
<?php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['transcriptSubmit'])){
if(isset($_POST['transcriptUpdate'])&& isset($_POST['transcriptUpdateUID'])){
    $transcriptq=$_POST['transcriptUpdate'];
    $transcriptqUID=$_POST['transcriptUpdateUID'];
    $tQuery = "UPDATE applicant A SET A.transcript_received='$transcriptq' WHERE A.user_id='$transcriptqUID'";
    $check="SELECT * from applicant A WHERE A.user_id='$transcriptqUID'";
    $checkResult=$conn->query($check) or die("mysql error".$mysqli->error);
    if($checkResult->num_rows==0){
    echo "No Applicant Found";
    }else{
    $tResult = $conn->query($tQuery) or die("mysql error".$mysqli->error);
    if($tResult==TRUE) {
        echo "transcript status updated successfully";
    }else{
        echo "failed to make transcript status, please try again";
    }
}
}}
   
if(isset($_POST['decisionSubmit'])){
if(isset($_POST['decisionUpdate'])&& isset($_POST['decisionUpdateUID'])){
    $decisionq=$_POST['decisionUpdate'];
    $decisionqUID=$_POST['decisionUpdateUID'];
    $dQuery = "UPDATE applicant A SET A.decision='$decisionq', A.app_status='decisionMade' WHERE A.user_id=$decisionqUID";
    $check="SELECT * from applicant A WHERE A.user_id=$decisionqUID";
    $checkResult=$conn->query($check) or die("mysql error".$mysqli->error);
    if($checkResult->num_rows==0){
    echo "No Applicant Found";
    }else{
    $dResult = $conn->query($dQuery) or die("mysql error".$mysqli->error);
    if($dResult==TRUE) {
        echo "decision updated successfully";
    }else{
        echo "failed to update decision, please try again";
    }
}
}}
   
if(isset($_POST['statusSubmit'])){
if(isset($_POST['statusUpdate'])&& isset($_POST['statusUpdateUID'])){
    $statusq=$_POST['statusUpdate'];
    $statusqUID=$_POST['statusUpdateUID'];
    $sQuery = "UPDATE applicant A SET A.app_status='$statusq' WHERE A.user_id='$statusqUID'";
    $check="SELECT * from applicant A WHERE A.user_id='$statusqUID'";
    $checkResult=$conn->query($check) or die("mysql error".$mysqli->error);
    if($checkResult->num_rows==0){
    echo "No Applicant Found";
    }else{
    $sResult = $conn->query($sQuery) or die("mysql error".$mysqli->error);
    if($sResult==TRUE) {
        echo "application status updated successfully";
    }else{
        echo "failed to update application status, please try again";
    }
}
}}
$conn->close();
?>

<!DOCTYPE html>
<html>
<body>
<form style="text-align: center;" action="applicationFullList.php" method="post">
</form>
<br><br><br><br>
</main>
</body>
</html>

