<?php
# This process inserts a record. There is no display.
# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$username = $_POST['username'];
$password = $_POST['password'];
$username = htmlspecialchars($username);
$password = htmlspecialchars($password);
$password_salt = MD5(microtime());
$password_hash = MD5($password+$password_salt);

//check to make sure username is not there
$sql="SELECT id FROM mes_person WHERE username = ?";
$query = $pdo->prepare($sql);
$query->execute(Array($username));
$result=$query->fetch(PDO::FETCH_ASSOC);

if ($result){
    echo "<p> Username '$username' already exist. Try again!</p><br>";
    echo "<a href='register.php'>Back to register page</a>";
}

else{
# 3. assign MySQL query code to a variable
$sql = "INSERT INTO mes_person (username, password_hash, salt) VALUES (?, ?, ?)";
$query =$pdo->prepare($sql);
$query->execute(Array($username,$password_hash,$password_salt));

# 4. insert the message into the database
$pdo->query($sql); # execute the query

echo "<p>Your info has been added. You can now log in</p><br>";
echo "<a href='login.php'>Back to login page</a>";
}