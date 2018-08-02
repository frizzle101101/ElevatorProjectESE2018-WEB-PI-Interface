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
      echo "<th>nodeID</th>";
      echo "<th>date</th>";
      echo "<th>time</th>";
      echo "<th>status</th>";
      echo "<th>currentFloor</th>";
      echo "<th>requestedFloor</th>";
      echo "<th>source</th>";
      echo "</tr>";
      echo $PDOMySQL->getLatestReqs($q);
      echo "</table>";
  }





?>
