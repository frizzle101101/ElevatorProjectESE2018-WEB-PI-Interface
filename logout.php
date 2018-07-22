<?php
  session_start();
  echo "You are loged in, Loging you out!";
  session_destroy();
  header("Location: login.php");
  die();
?>
