<?php 
	$submitted = !empty($_POST);
	if ($submitted == 1) 
	{//loging in for the first time
		$username = $_POST['username'];
		$password = $_POST['password'];
		setcookie('username', $username);
		setcookie('password', $password);
	}
	else
	{//After fisrt login use cookies
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
	}
	echo "<p>Form submitted sucessfully: ", ($submitted == 1 ? "true" : "false"), " </p>";
	echo "<p>Username posted: $username </p>";
	echo "<p>Password posted: $password </p>";
?>