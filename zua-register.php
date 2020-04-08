<?php 
    $firstname = filter_input(INPUT_GET, 'firstname');
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
        <?php 
        if (isset($_POST ['submit'])) 
        {
            $username = $_POST['username'];
            echo "You entered username: <b> $username </b>"
        }
        ?>
                
            <form method="post" id="register_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="field-column">
                <label>Username</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="username"
                        value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                </div>
            </div>
                <div class="field-column">
                <label>Password</label>
                <div><input type="password" class="demo-input-box"
                    name="password" value=""></div>
            </div>
            <div class="field-column">
                <label>Confirm Password</label>
                <div>
                    <input type="password" class="demo-input-box"
                        name="confirm_password" value="">
                </div>
            </div>
                
                <input type="submit" value="Register" class="button blue">
            </form>
        
        <p>
            Click here to sign in if you've already registered. <a href="zua-login.php">Sign in</a>
        </p>
        
      <!--password-checks-->
        
        <?php
       // $error_username
        $error_password = "Please enter a valid password; at least one uppercase letter, one lowercase letter, and one number. 8 characters in length.";
        $error_confirm_password = "Passwords do not match";
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        //checks if matches confirm password variable
        if ($_POST['password'] != $_POST['confirm_password'])
            echo $error_confirm_password;
        
        //posts password if match
        //else if ($_POST['password'] == $_POST['confirm_password'])
         //   echo $_POST['password'];
        
        //checks if empty
        else if (empty ($_POST['password']))
            echo $error_password;
        //checks if one uppercase, one lower case, one number, and password length at least 8 char
        else if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one lower case letter.';
        }else{
            echo $_POST['password'];        
        }
        ?>
        
       <!--username-checks--> 
        
        <?php
           
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
