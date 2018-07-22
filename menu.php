<html>
  <head>
    <link href="../css/menu_style.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <ul class="menu">
      <li class="menu"><a href="index.php">Home</a></li>
      <li class="menu"><a href="plan.php">Project Plan</a></li>
      <li class="menu"><a href="project_details.php">Project Details</a></li>
      <li class="menu"><div class="mydropdown">Logs
          <div class="mydropdown-content">
            <a href="aarons_log.php">Aaron's</a>
            <a href="andrews_log.php">Andrew's</a>
          </div>
        </div>
      </li>
      <li class="menu"><a href="about.php">About</a></li>
<?php
session_start();

if(isset($_SESSION['username']))
{
  echo '<li id="logout" class="menu"><a href="logout.php">Logout</a></li>';
}
else
{
  echo '<li id="login" class="menu"><a href="login.php">Login</a></li>';
}

?>

    </ul>
  </body>
</html>
