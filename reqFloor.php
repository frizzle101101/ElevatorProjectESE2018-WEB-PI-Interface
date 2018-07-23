<?php
  require 'PDOMySQL.php';
  // get the q parameter from URL
  $q = $_REQUEST["q"];
  // lookup all hints from array if $q is different from ""
  if ($q !== "") {
      $PDOMySQL = new PDOMySQL();
      $PDOMySQL->requestFloor((int)$q);
  }



?>
