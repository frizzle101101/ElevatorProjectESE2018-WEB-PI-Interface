<?php
	require 'PDOMySQL.php';
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username &&  $password)
	{
		$_SESSION['username'] = $username;
	  header("Location: member.php");
	  die();
		//$PDOMySQL->queryList("",
	}


	echo "<p>Form submitted sucessfully: ", ($submitted == 1 ? "true" : "false"), " </p>";
	echo "<p>Username posted: $username </p>";
	echo "<p>Password posted: $password </p>";





?>
?>
