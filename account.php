<?php
  require 'menu.php';


  if(isset($_POST['logout']))
  {
    header("Location: logout.php");
    die();
  }

  if(isset($_SESSION['username']))
  {
    require 'html/account.html';
  }
  else
  {
    header("Location: login.php");
    die();
  }
?>
