<?php
  require "header.php";
?>
<main>
<div class="change-tbl">
<?php
  if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $_POST['user_id'] = $user_id;
    $info = "SELECT * FROM student WHERE user_id=" . $user_id;
    $run_info = mysqli_query($conn, $info);
    $result = mysqli_fetch_assoc($run_info);
    $status = $result['thesis'];
    echo "<table>
        <tr><th colspan='2'>Student</th></tr>
        <tr><td>{$result['fname']} {$result['lname']}</td></tr>
    </table>";
    if($status != 1){
      echo "
      <h1>You have not approved their thesis defense</h1>
      <form action='' method='post'>
        <button type='submit' name='thesis_pass'>Approve Thesis Defense</button>
      </form>";
    }
    else{
      echo "<h1>You have approved their thesis defense</h1>";
    }
  }
?>
<?php

  if(isset($_POST['thesis_pass'])){
    $user_id = $_POST['user_id'];
    $upd = "UPDATE student SET thesis=1 WHERE user_id=" . $user_id;
    $run_upd = mysqli_query($conn, $upd);
    header("Location: thesis.php?id=".$user_id);
  }
?>
</div>
</main>
<?php
  require "footer.php";
?>
