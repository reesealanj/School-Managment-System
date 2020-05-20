<?php
  session_start();
  require "../includes/db-conn.inc.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Banweb++</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="nav">
      <a href="index.php">Home</a>
      <a href="users.php">Current Users</a>
      <a href="newuser.php">Create User</a>
      <a href="courses.php">Current Courses</a>
      <a href="newcourse.php">Create Course</a>
      <a href="../includes/logout.inc.php">Log Out</a>
    </div>
    
