<?php
	require "header.php";
?>
<main>
<!DOCTYPE html>
<html>
<body>
<h2 style="text-align:center;"> Welcome </h2>
<h3 style="text-align: center;"> Please Select an Applicant </h3>



<form style="text-align:center;" action="dataUpdating.php" method="post">
    <select name="selection" required="required">
        <option disabled selected value> -- select an option -- </option>
        <?php
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT user_id, first_name, last_name FROM applicant WHERE decision = 0 ORDER BY user_id";
        $result = $conn->query($query) or die("mysql error".$mysqli->error);
        
        while($row = mysqli_fetch_assoc($result)){
            $rowUid=$row['user_id'];
            echo "<option value=\"$rowUid\">"."UID: " .$rowUid." First Name: ". $row[first_name]. " Last Name: " .$row[last_name] . "</option>";
        }
        $conn->close();
        ?>
    </select>
    <br><br>
    <input type="submit" name="goSelect" value="select" />
</form>
<br><br><br><br><br>



</form>
</main>
</body>
</html>


