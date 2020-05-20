<?php
	require "header.php";
?>
<main>

<?php
$servername= "localhost";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   
 if(isset($_POST['goSelect'])){
    $selectq=$_POST['selection'];
     
    $oQuery= "SELECT * FROM applicant A, application B, recommendation C WHERE A.user_id=$selectq AND A.user_id=B.uid AND A.user_id=C.uid";
     
    $oResult= $conn->query($oQuery) or die($mysqli->error);
    
    while($oRow = $oResult->fetch_assoc()){
        
            echo "Name: ". $oRow["first_name"]." ".$oRow["last_name"]."<br>";
            echo "Student UID: ". $oRow["user_id"]."<br>";
            echo "Semester of Application: ". $oRow["app_term"]."<br>";
            echo "Applying for Degree: ".$oRow["degree_seeking"]."<br>";
            echo "Area of Interest: ". $oRow["area_of_interest"]."<br><br>";
            echo "Reviewer's Opinion"."<br>";
            echo "Rating: ".$oRow["app_rec"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comment: ".$oRow['app_rec_comment']."<br><br>";
            
            echo "Exams"."<br>";
            echo "GRE &nbsp;&nbsp;&nbsp;"."Verbal: ". $oRow["GRE_verbal"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Quantitative: ".$oRow["GRE_quantitative"]."<br>";
            echo "Year of Exam: ".$oRow["exam_year"]."<br>";
            echo "GRE Advanced &nbsp;&nbsp;&nbsp;"."Score: ".$oRow["GRE_score"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Subject: ".$oRow["GRE_subject"]."<br>";
            echo "TOEFL Score: ".$oRow["TOEFL_score"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year of Exam: ".$oRow["TOEFL_year"]."<br><br>";
           
            echo "Prior Degrees"."<br>";
                        echo "Bachelor Degree: ".$oRow["bachelor_degree"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GPA: ".$oRow["bachelor_gpa"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Major: ".$oRow["bachelor_major"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: ".$oRow["bachelor_year"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;University: ".$oRow["bachelor_school"]."<br>";
            echo "Master Degree: ".$oRow["masters_degree"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GPA: ".$oRow["masters_gpa"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Major: ".$oRow["masters_major"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: ".$oRow["masters_year"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;University: ".$oRow["masters_school"]."<br><br>";
    
            echo "Application Material"."<br>";
            echo "Transcript Received: ". $oRow["transcript_received"]."<br>";
            echo "Recommendation Letter Received: ". $oRow["rec_received"]."<br>";
            echo "Recommender: ".$oRow["rec_fname"]." ".$oRow["rec_lname"]."<br>";
            echo "Recommender Tittle: ".$oRow["rec_title"]."<br>";
            echo "Recommendation Letter Content: "."<br>";
            echo $oRow["rec_letter"];
        
       
    }
}else if(isset($_POST['goSearch'])){
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
       
        $sQuery = "SELECT * FROM applicant A, application B, recommendation C WHERE A.user_id=$searchq AND A.user_id=B.uid AND A.user_id=C.uid";
        $sResult = $conn->query($sQuery) or die("mysql error".$mysqli->error);
        if($sResult->num_rows==0)
        {
            echo "No Applicant Found";
        }else{
        while($sRow = $sResult->fetch_assoc()) {
            
            echo "Name: ". $sRow["first_name"]." ".$sRow["last_name"]."<br>";
            echo "Student UID: ". $sRow["user_id"]."<br>";
            echo "Semester of Application: ". $sRow["app_term"]."<br>";
            echo "Applying for Degree: ".$sRow["degree_seeking"]."<br>";
            echo "Area of Interest: ". $sRow["area_of_interest"]."<br><br>";
            echo "Reviewer's Opinion"."<br>";
            echo "Rating: ".$sRow["app_rec"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comment".$sRow['app_rec_comment']."<br><br>";
            echo "Exams"."<br>";
            echo "GRE &nbsp;&nbsp;&nbsp;"."Verbal: ". $sRow["GRE_verbal"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Quantitative: ".$sRow["GRE_quantitative"]."<br>";
            echo "Year of Exam: ".$sRow["exam_year"]."<br>";
            echo "GRE Advanced &nbsp;&nbsp;&nbsp;"."Score: ".$sRow["GRE_score"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Subject: ".$sRow["GRE_subject"]."<br>";
            echo "TOEFL Score: ".$sRow["TOEFL_score"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year of Exam: ".$sRow["TOEFL_year"]."<br><br>";
           
            echo "Prior Degrees"."<br>";
            echo "Bachelor Degree: ".$sRow["bachelor_degree"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GPA: ".$sRow["bachelor_gpa"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Major: ".$sRow["bachelor_major"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: ".$sRow["bachelor_year"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;University: ".$sRow["bachelor_school"]."<br>";
            echo "Master Degree: ".$sRow["masters_degree"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GPA: ".$sRow["masters_gpa"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Major: ".$sRow["masters_major"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: ".$sRow["masters_year"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;University: ".$sRow["masters_school"]."<br><br>";
            echo "Application Material"."<br>";
            echo "Transcript Received: ". $sRow["transcript_received"]."<br>";
            echo "Recommendation Letter Received: ". $sRow["rec_received"]."<br>";
            echo "Recommender: ".$sRow["rec_fname"]." ".$sRow["rec_lname"]."<br>";
            echo "Recommender Tittle: ".$sRow["rec_title"]."<br>";
            echo "Recommendation Letter Content: "."<br>";
            echo $sRow["rec_letter"];
        }}}
}
$conn->close();
?>


<!DOCTYPE html>
<html>
<body>
<h2 style="text-align:center;"> Now please update</h2>
<h3> Update Transcript Status</h3>
<form action="makeUpdate.php" method="post">
    Student UID: (please type in numbers) <input type="number" required="required" name="transcriptUpdateUID">
    Transcript Status: <select name="transcriptUpdate" required="required">
                        <option disabled selected value> -- select an option -- </option>
                        <option value="Yes">Transcript Received</option>
                        <option value="No">Transcript not received</option>
                       </select><br>
    <input type="submit" name="transcriptSubmit" value="Update" >
</form>
    
<h3> Update Final Decision</h3>
<form action="makeUpdate.php" method="post">
    Student UID: (please type in numbers) <input type="number" required="required" name="decisionUpdateUID">
    Final Decision: <select name="decisionUpdate" required="required">
                        <option disabled selected value> -- select an option -- </option>
                        <option value=1>admission with aid</option>
                        <option value=2>admission</option>
                        <option value=3>rejection</option>
                       </select><br>
    <input type="submit" name="decisionSubmit" value="Update" >
</form>
    
<h3> Update Application Status</h3>
<form action="makeUpdate.php" method="post">
    Student UID: (please type in numbers) <input type="number" required="required" name="statusUpdateUID">
    Application Status: <select name="statusUpdate" required="required">
                        <option disabled selected value> -- select an option -- </option>
                        <option value="pending">Pending:Missing required materials</option>
                        <option value="completed">Completed:All materials received, under reviewing</option>
                        <option value="reviewed">Reviewed:Reviewed by reviewer, waiting for final decision</option>
                        <option value="decisionMade">Decision Made:Final decision has been made</option>
                       </select><br>
    <input type="submit" name="statusSubmit" value="Update" >
    
    <br><br><br><br><br><br>
</form>
</main>
</body>
</html>





