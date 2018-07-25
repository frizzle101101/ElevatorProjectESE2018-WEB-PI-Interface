<?php
  require 'PDOMySQL.php';
  $PDOMySQL = new PDOMySQL();
  // get the q parameter from URL
  $q = intval($_GET['q']);
  // lookup all hints from array if $q is different from ""
  $latestReqs = array();
  if ($q !== "") {
      $latestReqs = $PDOMySQL->getLatestReqs($q);
      echo "<table><tr>";
  		echo "<th>reqId</th>";
  		echo "<th>nodeID</th>";
  		echo "<th>date</th>";
  		echo "<th>time</th>";
  		echo "<th>status</th>";
  		echo "<th>currentFloor</th>";
  		echo "<th>requestedFloor</th>";
  		echo "<th>source</th>";
  		echo "</tr>";
      foreach($latestReqs as $latestReq)
      {
        echo "<tr>";
        echo "<td>". $latestReq['reqId'] ."</td>";
        echo "<td>". $latestReq['nodeID'] ."</td>";
        echo "<td>". $latestReq['date'] ."</td>";
        echo "<td>". $latestReq['time'] ."</td>";
        echo "<td>". $latestReq['status'] ."</td>";
        echo "<td>". $latestReq['currentFloor'] ."</td>";
        echo "<td>". $latestReq['requestedFloor'] ."</td>";
        echo "<td>". $latestReq['source'] ."</td>";
        echo "</tr>";
      }
      echo "</table>";
  }





?>
