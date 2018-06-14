<?php
session_start();

if(isset($_SESSION['username']))
{
  echo "we made it with the user name set as ".$_SESSION['username'];
}
?>
