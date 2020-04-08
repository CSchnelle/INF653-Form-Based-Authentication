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
// make sure the user is logged in as a valid administrator 
	if (!isset($_SESSION['is_valid_admin'])) { 
		header("Location: {$_SERVER['zua-login.php']};);
} 
?>
