<?php
require 'html/menu.html';
require 'html/account.html';

  if(isset($_POST['logout']))
  {
    session_start();
    session_destroy();
    header("Location: login.php");
    die();
  }
?>
