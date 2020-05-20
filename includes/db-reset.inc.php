<?php
  require "db-conn.inc.php";

  $source = file_get_contents("database.sql");
  $run_source = mysqli_multi_query($conn, $source);

  header("Location: ../index.php");

?>
