<?php
// Start the session
session_start();
//print_r($_SESSION);
echo "<br />";
?>
<?php
	require "header.php";
?>
<main>
<div class="change-tbl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Application</title>
</head>
<body>
  <h2>Apply by filling out this form</h2>

  <table>
  <form method="post" action="submit.php">
    <tr>
    <th> Personal Information: </th>
    </tr><tr>
    <th><label for="firstname">First name:</label></th>
    <td><input type="text" required = "required" name="firstname" maxlength = 15/></td>
    </tr><tr>
    <th><label for="lastname">Last name:</label></th>
    <td><input type="text" required = "required" name="lastname" maxlength = 15 /></td>
    </tr><tr>
    <th><label for="email">Email:</label></th>
    <td><input type="text" required = "required" name="email" /></td>
    </tr><tr>
    <th><label for="ssn">Social Security Number:</label></th>
    <td><input type="number" required = "required" name="ssn" maxlength = 15 /><br /></td>
    </tr><tr>
    <th>Select degree:</th>
    <td><select name = degree>
    <option value="MS"> MS</option>
    <option value="PHD"> PHD</option>
    </td>
    </tr><tr>
    <th>Admission date(term): </th>
    <td><select name = app_term>
    <option value="Fall"> Fall</option>
    <option value="Spring"> Spring</option>
    </td>
    </tr><tr>
    <th><label for="area_of_interest">Area of interest:</label></th>
    <td><input type="text" required = "required" name="area_of_interest"  maxlength = 25/></td>
    </tr><tr>
    <th> Address: </th>
    </tr><tr>
    <th><label for="city">City:</label></th>
    <td><input type="text" required = "required" name="city" maxlength = 15 /></td>
    </tr><tr>
    <th><label for="state">State:</label></th>
    <td><input type="text" required = "required" name="state" maxlength = 15 /></td>
    </tr><tr>
    <th><label for="street">Street:</label></th>
    <td><input type="text" required = "required" name="street" maxlength = 20 /></td>
    </tr><tr>
    <th><label for="zip">Zip:</label></th>
    <td><input type="text" required = "required" name="zip" /></td>
    </tr><tr>
    <th> Academics and work experience: </th>
    </tr><tr>
    <th><label for="bachelor_school">Where did you get your bachelor's degree?:</label></th>
    <td><input type="text" required = "required" name="bachelor_school" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="bachelor_degree">What is your bachelor's degree school?:</label></th>
    <td><input type="text" required = "required" name="bachelor_degree" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="bachelor_major">What was your bachelor's major?:</label></th>
    <td><input type="text" required = "required" name="bachelor_major" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="bachelor_year">What year did you get your bachelor's degree?:</label></th>
    <td><input type="number" required = "required" name="bachelor_year" /></td>
    </tr><tr>
    <th><label for="bachelor_gpa">What was your GPA for your bachelor's degree?:</label></th>
    <td><input type="number" step="0.01" required = "required" name="bachelor_gpa" /></td>
    <tr></tr>
    <th> Masters degree (if applicable): </th>
    </tr><tr>
    <th><label for="masters_school">Where did you get your master's degree school?:</label></th>
    <td><input type="text" name="masters_school" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="masters_degree">What is your master's degree?:</label></th>
    <td><input type="text" name="masters_degree" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="masters_major">What was your master's major?:</label></th>
    <td><input type="text" name="masters_major" maxlength = 25 /></td>
    </tr><tr>
    <th><label for="masters_year">What year did you get your master's degree?:</label></th>
    <td><input type="number" name="masters_year" /></td>
    </tr><tr>
    <th><label for="masters_gpa">What was your GPA for your master's degree?:</label></th>
    <td><input type="number" step="0.01" name="masters_gpa" /><br /></td>
    </tr><tr>
    <th> Work Experience (if applicable): </th>
    </tr><tr>
    <th><label for="work_experience">What work experience do you have?</label></th>
    <td><input type="text" name="work_experience" /></td>
    </tr><tr>
    <th> Test Scores: </th>
    </tr><tr>
    <th><label for="GRE_verbal">GRE verbal:</label></th>
    <td><input type="number"  required = "required" name="GRE_verbal" /></td>
    </tr><tr>
    <th><label for="GRE_quantitative">GRE quantitative:</label></th>
    <td><input type="number" name="GRE_quantitative" /></td>
    </tr><tr>
    <th><label for="GRE_year">GRE year:</label></th>
    <td><input type="number" name="GRE_year" /></td>
    </tr><tr>
    <th><label for="GRE_subject">GRE subject:</label></th>
    <td><input type="text" name="GRE_subject" maxlength = 10 /></td>
    </tr><tr>
    <th><label for="GRE_score">GRE score(for subject):</label></th>
    <td><input type="text" name="GRE_score" /></td>
    </tr><tr>
    <th><label for="TOEFL">TOEFL score:</label></th>
    <td><input type="number" name="TOEFL" /></td>
    </tr><tr>
    <th><label for="TOEFL_year">TOEFL year:</label></th>
    <td><input type="number" name="TOEFL_year" /></td>
    </tr><tr>
    <th> Recommendation Letters: </th>
    </tr><tr>
    <th>Recommender 1:</th>
    </tr><tr>
    <th><label for="rec_fname1">Recommender's first name:</label></th>
    <td><input type="text" name="rec_fname1" /></td>
    </tr><tr>
    <th><label for="rec_lname1">Recommender's last name:</label></th>
    <td><input type="text" name="rec_lname1" /></td>
    </tr><tr>
    <th><label for="rec_title1">Recommender's title:</label></th>
    <td><input type="text" name="rec_title1" /></td>
    </tr><tr>
    <th><label for="rec_email1">Recommender's email:</label></th>
    <td><input type="text" name="rec_email1" /></td>
    </tr><tr>
    <th>Recommender 2:</th>
    </tr><tr>
    <th><label for="rec_fname2">Recommender's first name:</label></th>
    <td><input type="text" name="rec_fname2" /></td>
    </tr><tr>
    <th><label for="rec_lname2">Recommender's last name:</label></th>
    <td><input type="text" name="rec_lname2" /></td>
    </tr><tr>
    <th><label for="rec_title2">Recommender's title:</label></th>
    <td><input type="text" name="rec_title2" /></td>
    </tr><tr>
    <th><label for="rec_email2">Recommender's email:</label></th>
    <td><input type="text" name="rec_email2" /></td>
    </tr><tr>
    <th>Recommender 3:</th>
    </tr><tr>
    <th><label for="rec_fname3">Recommender's first name:</label></th>
    <td><input type="text" name="rec_fname3" /></td>
    </tr><tr>
    <th><label for="rec_lname3">Recommender's last name:</label></th>
    <td><input type="text" name="rec_lname3" /></td>
    </tr><tr>
    <th><label for="rec_title3">Recommender's title:</label></th>
    <td><input type="text" name="rec_title3" /></td>
    </tr><tr>
    <th><label for="rec_email3">Recommender's email:</label></th>
    <td><input type="text" name="rec_email3" /></td>
    </tr><tr>
    <th> Transcript Submission: </th>
    </tr><tr>
    
    </tr><tr>
    <th><label for="reg_email">Registrar's email (If electronic submission):</label></th>
    <td><input type="text" name="reg_email" /></td>
    </tr>
    
    
    

    <th><input type="submit" value="Submit Application" name="submit" /></th>
    
  </form>
  </table>

</body>
</html>
  </div>
  </main>
<?php
	require "footer.php";
?>
