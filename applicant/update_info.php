<?php
	require "header.php";
?>
<main>
<?php
// Start the session
session_start();
//print_r($_SESSION);
echo "<br />";
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Application</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Update your information by filling out this form</h2>

  <form method="post" action="update.php">
    <p> Personal Information: </p>
    <label for="firstname">First name:</label>
    <input type="text" required = "required" name="firstname" maxlength = 15/><br />
    <label for="lastname">Last name:</label>
    <input type="text" required = "required" name="lastname" maxlength = 15 /><br />
    <label for="email">Email:</label>
    <input type="text" required = "required" name="email" /><br />
    <label for="ssn">Social Security Number:</label>
    <input type="number" required = "required" name="ssn" maxlength = 15 /><br />
    Seeking degree: <br />
    <input type="radio" required = "required" name="degree" value="MS"> MS<br>
    <input type="radio" name="degree" value="PHD"> PHD<br>
    Admission date(term): <br />
    <input type="radio" required = "required" name="app_term" value="Fall"> Fall<br>
    <input type="radio" name="app_term" value="Spring"> Spring<br>
    <label for="area_of_interest">Area of interest:</label>
    <input type="text" required = "required" name="area_of_interest"  maxlength = 25/><br />
    <p> Address: </p>
    <label for="city">City:</label>
    <input type="text" required = "required" name="city" maxlength = 15 /><br />
    <label for="state">State:</label>
    <input type="text" required = "required" name="state" maxlength = 15 /><br />
    <label for="street">Street:</label>
    <input type="text" required = "required" name="street" maxlength = 20 /><br />
    <label for="zip">Zip:</label>
    <input type="text" required = "required" name="zip" /><br />
    <p> Academics and work experience: </p>
    <label for="bachelor_school">Where did you get your bachelor's degree?:</label>
    <input type="text" required = "required" name="bachelor_school" maxlength = 25 /><br />
    <label for="bachelor_degree">What is your bachelor's degree school?:</label>
    <input type="text" required = "required" name="bachelor_degree" maxlength = 25 /><br />
    <label for="bachelor_major">What was your bachelor's major?:</label>
    <input type="text" required = "required" name="bachelor_major" maxlength = 25 /><br />
    <label for="bachelor_year">What year did you get your bachelor's degree?:</label>
    <input type="number" required = "required" name="bachelor_year" /><br />
    <label for="bachelor_gpa">What was your GPA for your bachelor's degree?:</label>
    <input type="number" step="0.01" required = "required" name="bachelor_gpa" /><br />
    <p> Masters degree (if applicable): </p>
    <label for="masters_school">Where did you get your master's degree school?:</label>
    <input type="text" name="masters_school" maxlength = 25 /><br />
    <label for="masters_degree">What is your master's degree?:</label>
    <input type="text" name="masters_degree" maxlength = 25 /><br />
    <label for="masters_major">What was your master's major?:</label>
    <input type="text" name="masters_major" maxlength = 25 /><br />
    <label for="masters_year">What year did you get your master's degree?:</label>
    <input type="number" name="masters_year" /><br />
    <label for="masters_gpa">What was your GPA for your master's degree?:</label>
    <input type="number" step="0.01" name="masters_gpa" /><br />
    <p> Work Experience (if applicable): </p>
    <label for="work_experience">What work experience do you have?</label>
    <input type="text" name="work_experience" /><br />
    <p> Test Scores: </p>
    <label for="GRE_verbal">GRE verbal:</label>
    <input type="number"  required = "required" name="GRE_verbal" /><br />
    <label for="GRE_quantitative">GRE quantitative:</label>
    <input type="number" name="GRE_quantitative" /><br />
    <label for="GRE_year">GRE year:</label>
    <input type="number" name="GRE_year" /><br />
    <label for="GRE_subject">GRE subject:</label>
    <input type="text" name="GRE_subject" maxlength = 10 /><br />
    <label for="GRE_score">GRE score(for subject):</label>
    <input type="text" name="GRE_score" /><br />
    <label for="TOEFL">TOEFL score:</label>
    <input type="number" name="TOEFL" /><br />
    <label for="TOEFL_year">TOEFL year:</label>
    <input type="number" name="TOEFL_year" /><br />
	
	<input type="submit" value="Update Information" name="submit" /><br/><br/>
  </form>
  </main>
</body>
</html>
