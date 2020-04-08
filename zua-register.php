
<?php
    //start a new session
     session_start();
    //include admin_db to use functions
     require_once('model/admin_db.php');
    //include database to store new admin
     require_once('model/database.php');
     //require_once('util/valid_admin.php');
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
            
            <div class="field-column">
                <label>Password</label>
                <div><input type="text" class="demo-input-box"
                    name="password" value=""></div>
            </div>
            <div class="field-column">
                <label>Confirm Password</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="confirm_password" value="">
                </div>
            </div>
                
                <input type="submit" value="Register" class="button blue">
            </form>
           <?php
                if(isset($_POST['submit'])) 
                { 
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                }
                                          ?>
        <?php } else { 

                $lifetime = 60 * 60 * 24 * 7; //one week
                session_set_cookie_params($lifetime, '/');
                session_start();
                $_SESSION['userid'] = $username;
        ?>
        
       <?php
        //error message variables (still need to work on)
        $error_username = "Please enter a valid username 6 characters in length.";
        $error_password = "Please enter a valid password; at least one uppercase letter, one lowercase letter, and one number. 8 characters in length.";
        $error_confirm_password = "Passwords do not match";
        
        //regexp checks
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
       // else if (empty ($_POST['password']))   //this produces an infinite loop of error messages
       //     echo $error_password;
        //checks if one uppercase, one lower case, one number, and password length at least 8 char
        else if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one lower case letter.';
        }else{
            echo $_POST['password'];        
        }
        ?>
        <?php
           // if(empty ($_POST['username']))
           //     echo $error_username;
           // else                              //this produces an infinite loop of error msgs.
            if(strlen($username) < 6) {
                echo $error_username;
            } else {
                echo $_POST['username'];
            }
        ?>
        <?php
    //checks if error variables are empty, if all three are empty then call add_admin function
            if(empty($error_username) && ($error_password) && ($error_confirm_password)) {
                add_admin($username, $password);
                echo "Admin Account Created.";
                //send user to admin page
                include ('zua-admin.php');
                //if not empty, return to register page
              } else { include('zua-register.php');
               }
          ?>
            <h1>Thank you for registering, <?php echo $username ?>!</h1>
            <p>
                <a href="index.php">Click here</a> to view our vehicle list.
            </p>
            <br>
        <?php } ?>
    </body>

<?php include('view/footer.php'); ?>
