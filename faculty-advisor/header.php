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

<header>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="advisees.php">Advisees</a>
				<a href="applicants.php">Applicants</a>
        <a href="../includes/logout.inc.php">Log Out</a>
    </div>
</header>
