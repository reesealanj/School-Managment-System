<?php
	require "header.php";
?>
<main>
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 if(isset($_POST['goSelect'])){
    $selectq=$_POST['selection'];
     
   $oQuery = "SELECT * FROM applicant A, application B, recommendation C WHERE A.user_id=$selectq AND A.user_id=B.uid AND A.user_id=C.uid AND A.app_status='reviewed'";

    $oResult= $conn->query($oQuery) or die($mysqli->error);
  
    while($oRow = $oResult->fetch_assoc()){
       
            echo "Name: ". $oRow["first_name"]." ".$oRow["last_name"]."<br>";
            echo "Student UID: ". $oRow["user_id"]."<br>";
            echo "Semester of Application: ". $oRow["app_term"]."<br>";
            echo "Applying for Degree: ".$oRow["degree_seeking"]."<br>";
            echo "Area of Interest: ". $oRow["area_of_interest"]."<br><br>";
            echo "Reviewer's Opinion"."<br>";
            echo "Average Rating: ".$oRow["app_rec"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comment: ".$oRow['app_rec_comment']."<br><br>";
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
            break;
            
    }
    $oResult= $conn->query($oQuery) or die($mysqli->error);
    while($oRow = $oResult->fetch_assoc()){
      echo "Recommender: ".$oRow["rec_fname"]." ".$oRow["rec_lname"]."<br>";
      echo "Recommender Tittle: ".$oRow["rec_title"]."<br>";
      echo "Recommendation Letter Content: "."<br>";
      echo $oRow["rec_letter"] . "<br><br>";
    }
    
}else if(isset($_POST['goSearch'])){
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
      
       $sQuery = "SELECT * FROM applicant A, application B, recommendation C WHERE A.user_id=$searchq AND A.user_id=B.uid AND A.user_id=C.uid AND A.app_status='reviewed'";
        $sResult = $conn->query($sQuery) or die("mysql error".$mysqli->error);
        if($sResult->num_rows==0)
        {
            echo "No Applicant Found or Applicant Not Being Reviewed Yet";
        }else{
        while($sRow = $sResult->fetch_assoc()) {
             echo "Name: ". $sRow["first_name"]." ".$sRow["last_name"]."<br>";
            echo "Student UID: ". $sRow["user_id"]."<br>";
            echo "Semester of Application: ". $sRow["app_term"]."<br>";
            echo "Applying for Degree: ".$sRow["degree_seeking"]."<br>";
            echo "Area of Interest: ". $sRow["area_of_interest"]."<br><br>";
            echo "Reviewer's Opinion"."<br>";
            echo "Rating: ".$sRow["app_rec"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comment: ".$sRow['app_rec_comment']."<br><br>";
            
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
            break;
            echo "Recommender: ".$sRow["rec_fname"]." ".$sRow["rec_lname"]."<br>";
            echo "Recommender Tittle: ".$sRow["rec_title"]."<br>";
            echo "Recommendation Letter Content: "."<br>";
            echo $sRow["rec_letter"];
            
        }
        
        $sQuery = "SELECT * FROM applicant A, application B, recommendation C WHERE A.user_id=$searchq AND A.user_id=B.uid AND A.user_id=C.uid AND A.app_status='reviewed'";
        $sResult= $conn->query($sQuery) or die($mysqli->error);
    while($sRow = $sResult->fetch_assoc()){
      echo "Recommender: ".$sRow["rec_fname"]." ".$sRow["rec_lname"]."<br>";
      echo "Recommender Tittle: ".$sRow["rec_title"]."<br>";
      echo "Recommendation Letter Content: "."<br>";
      echo $sRow["rec_letter"] . "<br><br>";
    }
        
        }}
}
$conn->close();
?>



<!DOCTYPE html>
<html>
<body>
<h2 style="text-align:center;"> Now please make a decision</h2>
<form style="text-align: center;" action="makeDec.php" method="post">
    Student UID: <input type="number" required="required" name="decisionUID"><br>
    Decision: Type 1 for admission with aid, 2 for admission, and 3 for rejection <br><input type="number" required="required" name="decision" min="1" max="4"><br>

    <input type="submit" value="submit" >
</form>
<br><br><br><br>


</main>
</body>
</html>
