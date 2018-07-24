<?php
  require 'PDOMySQL.php';
  $PDOMySQL = new PDOMySQL();
  // get the q parameter from URL
  $q = intval($_GET['q']);
  // lookup all hints from array if $q is different from ""
  if ($q !== "") {
      $PDOMySQL->requestFloor($q);
  }



?>
