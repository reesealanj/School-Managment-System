<?php
  $server = "localhost";
  $user = "TeamFifteen";
  $pass = "Fifteen15!";
  $dbname = "TeamFifteen";

  $conn = mysqli_connect($server, $user, $pass, $dbname);

  if(!$conn){
    die("Connection to Database Failed: ". mysqli_connect_error());
  }
?>
