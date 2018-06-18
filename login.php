<?php
require 'menu.php';

if(isset($_SESSION['username']))
{
  echo "You are loged in, will redirect you to account page";
  header("Location: account.php");
  die();
}
else
{
  require 'html/login.html';
}

?>
