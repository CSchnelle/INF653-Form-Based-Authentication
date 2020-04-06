<?php
    $dsn = 'mysql:host=lg7j30weuqckmw07.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=pugvo3b5oeeq6nux';
    $username = 't4rk1a7232s3xee0';
    $password = 'pwg44gpsze39ruug';
 
try {
  $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  $error_message = $e->getMessage();
  include('database_error.php');
  exit();
}
?>
