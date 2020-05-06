 <?php 
    if (!isset($_SESSION['is_valid_admin'])) {
        header("Location: zua-login.php");
    }
?>
