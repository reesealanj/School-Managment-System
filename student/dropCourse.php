<?php
	require "header.php";
	require "schedule.php";
?>
<main>
<div class="change-tbl">
<h1>Course Drop</h1>
<p>Drop a course you wish to drop</p>
<form method="post" action="?php echo htmlspecialchars($_SERVER["PHP_SELF"]);">

    <label for="searchbar">Enter course ID: </label> <br />

    <input type="text" name="searchbar" required>
    <br>

    <input type="submit" value="Drop" name="submit" />

  </form> <br/> <br/>


  <?php
  if(isset($_SESSION['user_id'])){
    $sid = $_SESSION['user_id'];

        $searchTerm = $_POST["searchbar"];

        if($_SERVER[REQUEST_METHOD] == "POST")
        {
          if($searchTerm > 0 && $searchTerm <= 22)
          {
            $sql = "SELECT * FROM enrollment WHERE courseID = '$searchTerm' AND user_id = '$sid'";
            $result = $conn->query($sql);
            if(mysqli_fetch_array($result)==0)
            {
            echo "Error: You are not currently enrolled in this course!";
            }
            else
            {
              $sql2 = "SELECT * FROM enrollment WHERE (courseID = '$searchTerm' AND user_id =" .$sid . " AND grade NOT IN ('IP'))";
              $result2 = $conn->query($sql2);

              if(mysqli_fetch_array($result2) != 0)
              {
                echo "Cannot drop a course you already completed!";
              }
              else
              {
                $sql = "DELETE FROM enrollment WHERE courseID = '$searchTerm' AND user_id = '$sid'";
                $result = $conn->query($sql);
                echo "Course dropped successfully";
								header("Location: dropCourse.php");
              }
            }
          }
          else
          {
            echo "Invalid course ID";
          }
        }
    }
        ?>


</div>
</main>




<?php
	require "footer.php";
?>
