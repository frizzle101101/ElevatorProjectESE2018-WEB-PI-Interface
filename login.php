<?php
require 'html/menu.html';

session_start();
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
