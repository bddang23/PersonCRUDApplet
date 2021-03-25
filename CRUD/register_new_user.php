<?php
# This process inserts a record. There is no display.
# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$email = $_POST['email'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$address= $_POST['address'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip_code =$_POST['zip_code'];

//sanatize data
$email = htmlspecialchars($email);
$password = htmlspecialchars($password);
$fname= htmlspecialchars($fname);
$lname = htmlspecialchars($lname);
$phone=htmlspecialchars($phone);
$address=htmlspecialchars($address);
$address2= htmlspecialchars($address2);
$city = htmlspecialchars($city);
$state = htmlspecialchars($state);
$zip_code = htmlspecialchars($zip_code);

//salt and hash password
$password_salt = MD5(microtime());
$password_hash = MD5($password.$password_salt);

//check to make sure email is not there
$sql="SELECT id FROM persons WHERE email = ?";
$query = $pdo->prepare($sql);
$query->execute(Array($email));
$result=$query->fetch(PDO::FETCH_ASSOC);

if ($result){
    echo "<p> Email '$email' already exist. Try again!</p><br>";
    echo "<a href='register.php'>Back to register page</a>";
}

else{
# 3. assign MySQL query code to a variable
$sql = "INSERT INTO persons (email, password_hash, password_salt, fname, lname, phone, address, address2, city, state, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$query =$pdo->prepare($sql);
$query->execute(Array($email,$password_hash,$password_salt, $fname, $lname, $phone, $address, $address2, $city, $state, $zip_code));

# 4. insert the message into the database
$pdo->query($sql); # execute the query

echo "<p>Your info has been added. You can now log in</p><br>";
echo "<a href='login.php'>Back to login page</a>";
}