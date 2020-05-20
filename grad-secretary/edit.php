<?php
  require "header.php";
?>
<main>
  <div class="change-tbl">
  <h1>Update Application Details</h1>
  <?php
    if(isset($_GET['id'])){

    }
    else{
      header("Location: applicants.php");
      exit();
    }
  ?>
</main>
<?php
  require "footer.php";
?>
