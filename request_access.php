<?php
  require 'menu.php';
  require 'PDOMySQL.php';
  $PDOMySQL = new PDOMySQL();
  if(!empty($_POST))
  {
    foreach ($_POST['interest'] as $key => $value) {
      $interest = $interest. $value;
    }
    $PDOMySQL->insertUser(
      $_POST['username'],
      $_POST['password'],
      $_POST['first_name'],
      $_POST['last_name'],
      $_POST['email'],
      $_POST['website'],
      $_POST['birth_date'],
      $_POST['user_type'],
      $interest
    );
      $_SESSION['username'] = $_POST['username'];
  }

  if(isset($_SESSION['username']))
  {
    echo "You are loged in, will redirect you to account page";
    header("Location: account.php");
    die();
  }
  else
  {
    require 'html/request_access.html';
  }



?>
