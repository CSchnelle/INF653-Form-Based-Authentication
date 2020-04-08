<?php
//start a new session
session_start();
//assign variable as true
$_SESSION['is_valid_admin'] = True;
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="view/css/main.css" />
</head>

<!-- the body section -->
<body>
    <header>
        <div id="pageTitle">
            <h1>Zippy Used Autos</h1>
        </div>
        <div id="pageLinks">
            <p></p>
        </div>
    </header>

    <body>
            <?php if ($username == NULL) { ?>
                   
            <form method="post" id="register_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="field-column">
                <label>Username</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="username"
                        value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                </div>
            </div>
            <br>
            <div class="field-column">
                <label>Password</label>
                <div><input type="text" class="demo-input-box"
                    name="password" value=""></div>
            </div>
       
                <input type="submit" value="Login" class="button blue">
            </form>
                
        <?php } else { 

                $lifetime = 60 * 60 * 24 * 7; //one week
                session_set_cookie_params($lifetime, '/');
                session_start();
                $_SESSION['userid'] = $username;
                
        ?>
     
            <h1>Thank you for registering, <?php echo $username ?>!</h1>
            <p>
                <a href="index.php">Click here</a> to view our vehicle list.
            </p>
            <br>
        <?php } ?>
    </body>

<?php include('view/footer.php'); ?>
