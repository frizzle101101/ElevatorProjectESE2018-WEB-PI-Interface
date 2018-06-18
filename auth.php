<?php
	require 'PDOMySQL.php';
	$PDOMySQL = new PDOMySQL();
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username &&  $password)
	{
		$auth = FALSE;
		$rows = $PDOMySQL->queryList('SELECT * FROM eprojese2018db.users ORDER BY userid');
	  foreach ($rows as $row) {
	    if($username == $row[1] && $password == $row[2]) {
	      $auth = TRUE;
	    }
	  }
	  if($auth == TRUE)
	  {
	    $_SESSION['username'] = $_POST['username'];
			header("Location: account.php");
		  die();
	  }
		else
		{
			echo "<p>OOPS! Your username and password combination doews not exist!</p>";
			echo "<a href='login.php'>Back to Login</a>";
		}
	}








?>
