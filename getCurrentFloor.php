<?php
  require 'PDOMySQL.php';
  $PDOMySQL = new PDOMySQL();
  echo "Current Floor: ".$PDOMySQL->getCUrrentFloor();



?>
