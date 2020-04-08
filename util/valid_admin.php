 <?php
require_once('model/database.php'); 
require_once('model/admin_db.php');

$username = ''; 
$password = '';
 <?php

// if is_valid_admin is not set, return to login page
	if (!isset($_SESSION['is_valid_admin'])) { 
		header("Location: zua-login.php");
} 
?>
