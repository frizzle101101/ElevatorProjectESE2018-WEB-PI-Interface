<?php
?>
<html>
	<head>
		<link href="/style.css" type="text/css" rel="stylesheet">
	</head>
	<title>Login</title>
	
		
	
	<body class="header">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="plan.php">Project Plan</a></li>
			<li><div class="dropdown">Logs
					<div class="dropdown-content">
						<a href="aarons_log.php">Aaron's</a>
						<a href="shawnas_log.php">Shawna's</a>
						<a href="andrews_log.php">Andrew's</a>
					</div>
				</div>
			</li>
			<li><a href="about.html">About</a></li>
			<li class="login"><a href="login.php">Login</a></li>
		</ul>
		<form action="auth.php" method="POST">
			Username: <input type="text" name="username" /><br/>
			Password: <input type="password" name="password" /><br/>
			<input type="submit" value="Log in" />
		</form>
	</body>
</html>