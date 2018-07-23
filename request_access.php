<?php
  // get the q parameter from URL
  $q = $_REQUEST["q"];


  if(isset($_SESSION['username']))
  {
    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $PDOMySQL = new PDOMySQL();
        $PDOMySQL->requestFloor((int)$q);
    }

  }



?>
