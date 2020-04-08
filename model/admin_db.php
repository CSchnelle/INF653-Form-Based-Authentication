 <?php
function add_admin($username, $password) { 
 global $db;
 $hash = password_hash($password, PASSWORD_DEFAULT); 
 $query = 'INSERT INTO administrators (username, password) 
           VALUES (:username, :password)'; $statement = $db->prepare($query); 
 $statement->bindValue(':username', $username); 
 $statement->bindValue(':password', $hash); 
 $statement->execute(); $statement->closeCursor();
}

function is_valid_admin_login($username, $password) { 
 global $db;
 $query = 'SELECT password FROM administrators 
           WHERE username = :username'; 
 $statement = $db->prepare($query); 
 $statement->bindValue(':username', $username); 
 $statement->execute(); 
 $row = $statement->fetch(); 
 $statement->closeCursor(); 
 
 //check if null (ternary statement)
 if(isset($_POST['submit'])) {
  $username =  isset($_POST['username']) ? $_POST['username'] : null;
  $password = isset($_POST['password']) ? $_POST['password'] : null;
 } 
 return password_verify($password, $hash);  
}
?>

