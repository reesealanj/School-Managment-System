<?php
	require "header.php";
?>
<main>
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['decisionRec'])&& isset($_POST['decisionRecUID'])){
    $addingq=$_POST['decisionRec'];
    $commentq=$_POST['decisionRecCom'];
    $defq=$_POST['decisionRecDef'];
    $recGenq=$_POST['recGen'];
    $recCreq=$_POST['recCre'];
    $recRatingq=$_POST['recRating'];
    $addingqUID=$_POST['decisionRecUID'];
    $rejReaq=$_POST['rejRea'];
        $recAdvq=$_POST['decisionRecAdv'];
    $aQuery = "UPDATE applicant A, recommendation B SET A.app_rec='$addingq',A.app_rec_advisor='$recAdvq', A.reason_for_reject='$rejReaq',A.app_rec_comment='$commentq', A.app_deficiency_courses='$defq', B.rec_rating='$recRatingq', B.rec_generic='$recGenq', B.rec_credible='$recCreq', A.app_status='reviewed' WHERE A.user_id=$addingqUID AND A.user_id=B.uid";
    $check="SELECT * from applicant A WHERE A.user_id='$addingqUID'";
    $checkResult=$conn->query($check) or die("mysql error".$mysqli->error);
    if($checkResult->num_rows==0){
    echo "No Applicant Found";
    }else{
    $aResult = $conn->query($aQuery) or die("mysql error".$mysqli->error);
    
    if($aResult==TRUE) {
        echo "decision recommendation updated successfully";
        //echo $aQuery;
    }else{
        echo "failed to make decision recommendation, please try again";
    }}
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<body>
<br><br><br><br>
</main>
</body>
</html>
