<?php
  require 'PDOMySQL.php';
  $PDOMySQL = new PDOMySQL();
  // get the q parameter from URL
  $q = intval($_GET['q']);
  // lookup all hints from array if $q is different from ""
  $latestReqs = array();
  if ($q !== "") {
      echo "<table style=\"width:100%\" ><tr>";
      echo "<th>reqId</th>";
      echo "</tr>";
      echo $PDOMySQL->getQue($q);
      echo "</table>";
  }





?>
