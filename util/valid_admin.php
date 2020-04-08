 <?php
require_once('model/database.php'); 
require_once('model/admin_db.php');

$username = ''; 
$password = '';
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) { 
	$username = $_SERVER['PHP_AUTH_USER']; $password = $_SERVER['PHP_AUTH_PW'];
}
if (!is_valid_admin_login($username, $password)) { 
	header('WWW-Authenticate: Basic realm="Admin"'); 
	header('HTTP/1.0 401 Unauthorized'); 
	include('unauthorized.php'); 
	exit();
} 
?>


 <?php

// if is_valid_admin is not set, return to login page
	if (!isset($_SESSION['is_valid_admin'])) { 
		header("Location: zua-login.php");
} 
?>
